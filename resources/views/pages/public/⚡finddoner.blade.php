<?php

use Livewire\Component;
use App\Models\Blood;
new class extends Component {
    public $Bloods;
    public function mount()
    {
        $this->Bloods = Blood::all();
    }
};
?>

<div class="w-full max-w-[1200px] mt-5">
    <div class="mb-8">
        <h1 class="text-gray-900 dark:text-white text-4xl font-black leading-tight tracking-tight">Find
            Blood Users</h1>
        <p class="text-gray-600 dark:text-gray-400 text-base mt-2">Filter and connect with life-savers
            or people in urgent need.</p>
    </div>
    <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <label class="flex flex-col">
                <span class="text-gray-700 dark:text-gray-300 text-xs font-bold uppercase tracking-wider mb-2">Blood
                    Group</span>
                <select
                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white h-12">
                    <option value="o+">O+</option>
                    <option value="o-">O-</option>
                    <option value="a+">A+</option>
                    <option value="a-">A-</option>
                    <option value="b+">B+</option>
                    <option value="b-">B-</option>
                    <option value="ab+">AB+</option>
                    <option value="ab-">AB-</option>
                </select>
            </label>
            <div class="flex flex-col">
                <span class="text-gray-700 dark:text-gray-300 text-xs font-bold uppercase tracking-wider mb-2">User
                    Type</span>
                <div class="flex h-12 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-800 p-1">
                    <label
                        class="flex flex-1 cursor-pointer h-full items-center justify-center rounded-lg px-2 has-[:checked]:bg-white dark:has-[:checked]:bg-gray-700 has-[:checked]:shadow-sm text-gray-600 dark:text-gray-400 has-[:checked]:text-primary text-sm font-semibold transition-all">
                        <input checked="" class="hidden" name="user-type" type="radio" value="Donors" />
                        <span>Donors</span>
                    </label>
                    <label
                        class="flex flex-1 cursor-pointer h-full items-center justify-center rounded-lg px-2 has-[:checked]:bg-white dark:has-[:checked]:bg-gray-700 has-[:checked]:shadow-sm text-gray-600 dark:text-gray-400 has-[:checked]:text-primary text-sm font-semibold transition-all">
                        <input class="hidden" name="user-type" type="radio" value="Requesters" />
                        <span>Requests</span>
                    </label>
                </div>
            </div>
            <label class="flex flex-col">
                <span
                    class="text-gray-700 dark:text-gray-300 text-xs font-bold uppercase tracking-wider mb-2">Location</span>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">location_on</span>
                    <input
                        class="form-input w-full pl-10 rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white h-12"
                        placeholder="City or Zip" type="text" />
                </div>
            </label>
            <label class="flex flex-col">
                <span
                    class="text-gray-700 dark:text-gray-300 text-xs font-bold uppercase tracking-wider mb-2">Availability
                    / Urgency</span>
                <select
                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white h-12">
                    <option>Immediate / Emergency</option>
                    <option>Available Now</option>
                    <option>Next 24 Hours</option>
                    <option>Planned (Scheduled)</option>
                </select>
            </label>
            <div class="flex flex-col justify-end">
                <button
                    class="w-full bg-primary hover:bg-red-700 text-white font-bold h-12 rounded-lg flex items-center justify-center gap-2 transition-colors">
                    <span class="material-symbols-outlined">search</span>
                    Find Users
                </button>
            </div>
        </div>
    </div>
    <!-- <div class="flex items-center justify-between px-4 py-3 bg-primary/5 border border-primary/10 rounded-lg mb-8">
        <p class="text-primary font-medium flex items-center gap-2">
            <span class="material-symbols-outlined">info</span>
            Showing results for <span class="font-bold">O+ blood group</span> – <span class="font-bold">12 users</span>
            found
        </p>
        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
            Sorted by: <span class="font-semibold text-gray-900 dark:text-white">Emergency First</span>
        </div>
    </div> -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($Bloods as $Blood)

            <div
                class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-5 flex flex-col hover:shadow-md transition-shadow">
                <div class="flex gap-4 items-start mb-4">
                    <div
                        class="size-16 rounded-lg bg-green-500/10 flex items-center justify-center text-green-600 dark:text-green-500 font-black text-2xl border border-green-500/20 shrink-0">
                        {{ $Blood->blood_group }}
                    </div>
                    <div class="flex-1">
                        <h3 class="text-gray-900 dark:text-white font-bold text-lg">{{ $Blood->patient_name }}</h3>
                        <span
                            class="inline-block px-2 py-0.5 rounded bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-[10px] font-bold uppercase mt-1">Donor</span>
                        <p class="text-gray-500 dark:text-gray-400 text-xs flex items-center gap-1 mt-2 leading-none">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            {{ $Blood->city }}, {{ $Blood->state }}
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-5 py-3 border-y border-gray-100 dark:border-gray-800">
                    
                    <div class="flex flex-col">
                        <span class="text-[10px] text-gray-400 uppercase font-bold">Availability</span>
                        <span class="text-green-600 font-bold">Available Now</span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button
                        class="flex-1 bg-gray-900 dark:bg-white dark:text-gray-900 text-white font-bold py-2.5 rounded-lg text-sm hover:opacity-90 transition-opacity">Request
                        Blood</button>
                    <a href="tel:{{ $Blood->phone }}" class="p-2.5 inline-flex rounded-lg border border-gray-200 dark:border-gray-700
              text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800">
                        <span class="material-symbols-outlined">call</span>
                    </a>

                    
                </div>
            </div>
        @endforeach

    </div>
    <!-- <div class="mt-12 flex justify-center">
        <nav class="flex items-center gap-1">
            <button
                class="size-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button
                class="size-10 flex items-center justify-center rounded-lg bg-primary text-white font-bold">1</button>
            <button
                class="size-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800">2</button>
            <button
                class="size-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800">3</button>
            <span class="px-2 text-gray-400">...</span>
            <button
                class="size-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </nav>
    </div> -->
</div>