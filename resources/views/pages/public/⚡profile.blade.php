<?php

use Livewire\Component;
use App\Models\Blood;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $donations;
    public $requests;
    public $tab = 'donations';

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->donations = Blood::where('user_id', Auth::id())
            ->where('type', 'donor')
            ->latest()
            ->get();

        $this->requests = Blood::where('user_id', Auth::id())
            ->where('type', 'receiver')
            ->latest()
            ->get();
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
    }

    public function toggleStatus($id)
    {
        $blood = Blood::where('user_id', Auth::id())->find($id);

        if ($blood && $blood->type === 'donor') {
            $blood->is_active = !$blood->is_active;
            $blood->save();
            $this->loadData(); // Refresh list

            $status = $blood->is_active ? 'Active (Visible to others)' : 'Inactive (Hidden)';
            session()->flash('message', "Status updated to: $status");
        }
    }

    public function delete($id)
    {
        $blood = Blood::where('user_id', Auth::id())->find($id);

        if ($blood) {
            $blood->delete();
            $this->loadData(); // Refresh list
            session()->flash('message', 'Record deleted successfully.');
        }
    }
};
?>

<div class="layout-content-container flex flex-col w-full max-w-[960px] px-4 py-10">

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div
            class="fixed top-20 right-4 z-50 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transition-all animate-bounce">
            {{ session('message') }}
        </div>
    @endif

    <!-- Profile Header -->
    <div class="flex flex-col @container">
        <div
            class="flex w-full flex-col gap-6 @[520px]:flex-row @[520px]:justify-between @[520px]:items-start bg-white dark:bg-[#2d1616] p-6 rounded-xl shadow-sm">
            <div class="flex flex-col @[480px]:flex-row gap-6">
                <div class="relative">
                    <div
                        class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-32 border-4 border-white dark:border-[#3d2020] bg-gray-200 flex items-center justify-center text-4xl text-gray-400">
                        @if(Auth::user()->profile_photo_url)
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                                class="w-full h-full rounded-full object-cover">
                        @else
                            {{ substr(Auth::user()->name, 0, 1) }}
                        @endif
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <div class="flex items-center gap-3">
                        <h1 class="text-[#1b0d0d] dark:text-white text-3xl font-bold tracking-tight">
                            {{ Auth::user()->name }}
                        </h1>
                    </div>

                    <div class="flex items-center gap-2 mt-2">
                        <span class="material-symbols-outlined text-gray-500 text-sm">email</span>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-3 w-full @[480px]:w-auto min-w-[200px]">
                <a href="{{ route('donateblood') }}"
                    class="flex items-center justify-center rounded-lg h-11 px-6 bg-primary text-white text-sm font-bold tracking-[0.015em] hover:bg-red-700 transition-colors w-full">
                    <span class="material-symbols-outlined mr-2 text-lg">add_circle</span>
                    Register as Donor
                </a>
                <a href="{{ route('requestform') }}"
                    class="flex items-center justify-center rounded-lg h-11 px-6 border-2 border-primary text-primary dark:text-red-400 text-sm font-bold tracking-[0.015em] hover:bg-primary/10 transition-colors w-full">
                    <span class="material-symbols-outlined mr-2 text-lg">emergency</span>
                    Request Blood
                </a>
            </div>
        </div>
    </div>

    <!-- Tabs Interface -->
    <div class="mt-8">
        <div class="border-b border-[#e7cfcf] dark:border-[#3d2020] px-4 flex gap-8">
            <button wire:click="setTab('donations')"
                class="flex flex-col items-center justify-center pb-3 pt-4 border-b-[3px] transition-colors {{ $tab === 'donations' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                <p class="text-sm font-bold tracking-[0.015em]">My Donor Registrations</p>
            </button>
            <button wire:click="setTab('requests')"
                class="flex flex-col items-center justify-center pb-3 pt-4 border-b-[3px] transition-colors {{ $tab === 'requests' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                <p class="text-sm font-bold tracking-[0.015em]">My Blood Requests</p>
            </button>
        </div>
    </div>

    <!-- Content List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-8">

        @if($tab === 'donations')
            @forelse ($donations as $donation)
                <div class="flex flex-col @container">
                    <div
                        class="flex items-stretch justify-between gap-4 rounded-xl bg-white dark:bg-[#2d1616] p-5 shadow-sm border border-[#f3e7e7] dark:border-[#3d2020]">

                        <!-- Left Data -->
                        <div class="flex flex-[2_2_0px] flex-col justify-between">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="size-2 rounded-full {{ $donation->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                    <p
                                        class="{{ $donation->is_active ? 'text-green-600' : 'text-gray-500' }} dark:text-green-400 text-xs font-bold uppercase transition-colors">
                                        {{ $donation->is_active ? 'Active' : 'Inactive' }}
                                    </p>
                                </div>
                                <h3 class="text-[#1b0d0d] dark:text-white text-xl font-bold">
                                    {{ $donation->blood_group }}
                                </h3>
                                <p class="text-[#9a4c4c] dark:text-[#cc8e8e] text-sm font-medium flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">location_on</span>
                                    {{ $donation->city }}, {{ $donation->state }}
                                </p>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2 mt-4">
                                <button wire:click="toggleStatus({{ $donation->id }})" class="flex items-center px-3 py-1.5 rounded-lg text-xs font-bold border transition-colors
                                            {{ $donation->is_active
                    ? 'border-yellow-500 text-yellow-600 bg-yellow-50 hover:bg-yellow-100'
                    : 'border-green-500 text-green-600 bg-green-50 hover:bg-green-100' }}">
                                    <span class="material-symbols-outlined text-sm mr-1">
                                        {{ $donation->is_active ? 'visibility_off' : 'visibility' }}
                                    </span>
                                    {{ $donation->is_active ? 'Go Inactive' : 'Go Active' }}
                                </button>

                                <button wire:click="delete({{ $donation->id }})"
                                    wire:confirm="Are you sure you want to remove this record permanently?"
                                    class="flex items-center px-3 py-1.5 rounded-lg text-xs font-bold border border-red-500 text-red-600 bg-red-50 hover:bg-red-100 transition-colors">
                                    <span class="material-symbols-outlined text-sm mr-1">delete</span>
                                    Delete
                                </button>
                            </div>
                        </div>

                        <!-- Right Icon -->
                        <div class="flex flex-col items-end justify-between">
                            <div
                                class="flex items-center justify-center bg-red-50 dark:bg-red-900/10 rounded-lg p-2 w-16 h-16 text-red-600 font-black text-2xl border border-red-100">
                                {{ $donation->blood_group }}
                            </div>
                            <span class="text-[10px] text-gray-400">{{ $donation->created_at->format('d M') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 text-gray-500">
                    <p>You haven't registered as a donor yet.</p>
                </div>
            @endforelse

        @elseif($tab === 'requests')
            @forelse ($requests as $request)
                <div class="flex flex-col @container">
                    <div
                        class="flex items-stretch justify-between gap-4 rounded-xl bg-white dark:bg-[#2d1616] p-5 shadow-sm border border-[#f3e7e7] dark:border-[#3d2020]">
                        <div class="flex flex-[2_2_0px] flex-col justify-between">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="size-2 rounded-full {{ $request->urgency === 'emergency' ? 'bg-red-500' : 'bg-blue-500' }}"></span>
                                    <p
                                        class="{{ $request->urgency === 'emergency' ? 'text-red-600' : 'text-blue-600' }} text-xs font-bold uppercase">
                                        {{ ucfirst($request->urgency) }} Request
                                    </p>
                                </div>
                                <h3 class="text-[#1b0d0d] dark:text-white text-lg font-bold">
                                    {{ $request->patient_name }}
                                </h3>
                                <p class="text-sm font-medium">
                                    Needed: {{ $request->blood_group }} ({{ $request->units }} Units)
                                </p>
                                <p class="text-[#9a4c4c] dark:text-[#cc8e8e] text-sm font-medium flex items-center gap-1 mt-1">
                                    <span class="material-symbols-outlined text-sm">local_hospital</span>
                                    {{ $request->hospital_name }}
                                </p>
                            </div>
                            <!-- Request Actions (Delete only for now) -->
                            <div class="mt-4">
                                <button wire:click="delete({{ $request->id }})" wire:confirm="Remove this request?"
                                    class="text-red-500 text-xs font-bold hover:underline">
                                    Remove Request
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-col items-end justify-between">
                            <div class="text-right">
                                <span class="text-xs text-gray-400">Date</span>
                                <p class="text-xs font-bold">{{ $request->created_at->format('d M') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-10 text-gray-500">
                    <p>You haven't made any blood requests yet.</p>
                </div>
            @endforelse
        @endif
    </div>
</div>