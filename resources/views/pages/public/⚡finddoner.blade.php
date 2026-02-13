<?php

use Livewire\Component;
use App\Models\Blood;

new class extends Component {

    public $blood_group = '';
    public $type = 'donor'; // Default to Donors, but allow switching if needed (or remove switch if only for donors)
    public $location = '';
    public $urgency = '';

    public function render()
    {
        $query = Blood::query();

        // 1. Filter by Type (Donor or Receiver)
        // The original UI had a toggle. Let's keep it working.
        if ($this->type === 'donor') {
            $query->where('type', 'donor');
        } elseif ($this->type === 'receiver') {
            $query->where('type', 'receiver');
        }

        // 2. Filter by Blood Group
        if (!empty($this->blood_group)) {
            $query->where('blood_group', $this->blood_group);
        }

        // 3. Filter by Location (City, District, or State)
        if (!empty($this->location)) {
            $query->where(function ($q) {
                $q->where('city', 'like', '%' . $this->location . '%')
                    ->orWhere('district', 'like', '%' . $this->location . '%')
                    ->orWhere('state', 'like', '%' . $this->location . '%')
                    ->orWhere('preferred_area', 'like', '%' . $this->location . '%');
            });
        }

        // 4. Urgency (Only if applicable, usually for requests)
        // If searching for donors, urgency might not be a filter, but let's keep it if users want to see "Emergency" requests
        if (!empty($this->urgency) && $this->type === 'receiver') {
            $query->where('urgency', $this->urgency);
        }

        $bloods = $query->latest()->get();

        return view('pages.public.⚡finddoner', ['bloods' => $bloods]);
    }
};
?>

<div class="w-full max-w-[1200px] mt-5">
    <div class="mb-8">
        <h1 class="text-gray-900 dark:text-white text-4xl font-black leading-tight tracking-tight">
            Find Blood {{ ucfirst($type) }}s
        </h1>
        <p class="text-gray-600 dark:text-gray-400 text-base mt-2">
            Filter and connect with life-savers or people in urgent need.
        </p>
    </div>

    <!-- Search / Filter Section -->
    <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- Type Toggle -->
            <div class="flex flex-col">
                <span class="text-gray-700 dark:text-gray-300 text-xs font-bold uppercase tracking-wider mb-2">
                    Looking For
                </span>
                <div class="flex h-12 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800 p-1">
                    <button wire:click="$set('type', 'donor')"
                        class="flex-1 h-full rounded-lg text-sm font-semibold transition-all
                        {{ $type === 'donor' ? 'bg-white dark:bg-gray-700 shadow-sm text-primary' : 'text-gray-600 dark:text-gray-400' }}">
                        Donors
                    </button>
                    <button wire:click="$set('type', 'receiver')"
                        class="flex-1 h-full rounded-lg text-sm font-semibold transition-all
                        {{ $type === 'receiver' ? 'bg-white dark:bg-gray-700 shadow-sm text-primary' : 'text-gray-600 dark:text-gray-400' }}">
                        Requests
                    </button>
                </div>
            </div>

            <!-- Blood Group -->
            <label class="flex flex-col">
                <span class="text-gray-700 dark:text-gray-300 text-xs font-bold uppercase tracking-wider mb-2">
                    Blood Group
                </span>
                <select wire:model.live="blood_group"
                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white h-12">
                    <option value="">All Groups</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </label>

            <!-- Location -->
            <label class="flex flex-col">
                <span class="text-gray-700 dark:text-gray-300 text-xs font-bold uppercase tracking-wider mb-2">
                    Location
                </span>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">location_on</span>
                    <input wire:model.live.debounce.300ms="location"
                        class="form-input w-full pl-10 rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white h-12"
                        placeholder="City, District or State" type="text" />
                </div>
            </label>

            <!-- Urgency (Only visible for receivers) -->
            @if($type === 'receiver')
                <label class="flex flex-col">
                    <span class="text-gray-700 dark:text-gray-300 text-xs font-bold uppercase tracking-wider mb-2">
                        Urgency
                    </span>
                    <select wire:model.live="urgency"
                        class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white h-12">
                        <option value="">All Levels</option>
                        <option value="emergency">Emergency</option>
                        <option value="normal">Normal</option>
                    </select>
                </label>
            @else
                <!-- Spacer for alignment when urgency is hidden -->
                <div class="hidden lg:block"></div>
            @endif

        </div>
    </div>

    <!-- Results Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($bloods as $blood)
            <div
                class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-5 flex flex-col hover:shadow-md transition-shadow">

                <div class="flex gap-4 items-start mb-4">
                    <!-- Blood Group Icon -->
                    <div
                        class="size-16 rounded-lg bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-red-600 dark:text-red-500 font-black text-2xl border border-red-100 dark:border-red-800 shrink-0">
                        {{ $blood->blood_group }}
                    </div>

                    <div class="flex-1">
                        <h3 class="text-gray-900 dark:text-white font-bold text-lg">
                            {{ $blood->type === 'donor' ? $blood->donor_name : $blood->patient_name }}
                        </h3>

                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase mt-1
                                {{ $blood->type === 'donor'
            ? 'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400'
            : 'bg-orange-100 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400' }}">
                            {{ ucfirst($blood->type) }}
                        </span>

                        <p class="text-gray-500 dark:text-gray-400 text-xs flex items-center gap-1 mt-2 leading-none">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            {{ $blood->city ?? $blood->district }}, {{ $blood->state }}
                        </p>
                    </div>
                </div>

                <!-- Details Section -->
                <div class="grid grid-cols-2 gap-3 mb-5 py-3 border-y border-gray-100 dark:border-gray-800">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-gray-400 uppercase font-bold">Contact</span>
                        <span class="text-gray-700 dark:text-gray-300 font-medium text-sm truncate">
                            {{ $blood->phone }}
                        </span>
                    </div>

                    <div class="flex flex-col">
                        <span class="text-[10px] text-gray-400 uppercase font-bold">
                            {{ $blood->type === 'donor' ? 'Registered' : 'Urgency' }}
                        </span>
                        @if($blood->type === 'donor')
                            <span class="text-gray-500 text-sm">{{ $blood->created_at->diffForHumans() }}</span>
                        @else
                            <span
                                class="{{ $blood->urgency === 'emergency' ? 'text-red-600 font-bold' : 'text-green-600' }} text-sm capitalize">
                                {{ $blood->urgency }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-2 mt-auto">
                    <a href="tel:{{ $blood->phone }}"
                        class="flex-1 bg-gray-900 dark:bg-white dark:text-gray-900 text-white font-bold py-2.5 rounded-lg text-sm hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg">call</span>
                        Call Now
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-gray-500 dark:text-gray-400">
                <span class="material-symbols-outlined text-4xl mb-2 opacity-50">search_off</span>
                <p>No {{ $type }}s found matching your criteria.</p>
            </div>
        @endforelse
    </div>
</div>