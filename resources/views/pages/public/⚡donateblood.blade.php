<?php

use Livewire\Component;
use App\Models\Blood;
use Illuminate\Support\Facades\Auth;

new class extends Component {

    public $blood_group;
    public $donor_name;
    public $weight;
    public $age;

    // Address
    public $state;
    public $district;
    public $city;
    public $preferred_area;

    // Contact
    public $phone;
    public $email;
    public $notes;

    protected $rules = [
        'donor_name' => 'required|min:3|string',
        'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
        'age' => 'required|integer|min:18|max:65',
        'weight' => 'required|integer|min:45',
        'state' => 'required|min:2|string',
        'district' => 'required|min:2|string',
        'city' => 'required|min:2|string',
        'phone' => ['required', 'regex:/^[6-9]\d{9}$/'], // Indian Phone Format
        'email' => 'nullable|email',
        'notes' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'phone.regex' => 'Please enter a valid 10-digit Indian mobile number.',
        'weight.min' => 'Minimum weight required for donation is 45kg.',
        'age.min' => 'You must be at least 18 years old to donate.',
        'age.max' => 'Maximum age limit for donation is 65 years.',
    ];

    public function mount()
    {
        if (Auth::check()) {
            $this->donor_name = Auth::user()->name;
            $this->email = Auth::user()->email;
            $this->phone = Auth::user()->phone; // Assuming user has a phone column, if not leave blank or remove
        }
    }

    public function submit()
    {
        $this->validate();

        Blood::create([
            'type' => 'donor',
            'user_id' => Auth::id(),
            'blood_group' => $this->blood_group,
            'age' => $this->age,
            'weight' => $this->weight,

            // Donor Specific
            'donor_name' => $this->donor_name,
            'is_active' => true,

            // Address
            'country' => 'India',
            'state' => $this->state,
            'district' => $this->district,
            'city' => $this->city,
            'preferred_area' => $this->preferred_area,

            // Contact
            'phone' => $this->phone,
            'email' => $this->email,
            'notes' => $this->notes,

            // Defaults
            'urgency' => 'standard',
        ]);

        session()->flash('success', 'Thank you! You are now a registered hero. 🩸');

        $this->reset(['blood_group', 'age', 'weight', 'state', 'district', 'city', 'preferred_area', 'phone', 'notes']);
    }
};
?>

<div class="w-full flex justify-center py-10 px-4">
    <div class="max-w-4xl w-full">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-4 tracking-tight">
                Become a <span class="text-primary">Life Saver</span>
            </h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                Join our community of heroes. Your single donation can save up to 3 lives.
                Register today and make a difference.
            </p>
        </div>

        <form wire:submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-12 gap-6">

            <!-- Left Column: Personal & Health -->
            <div class="md:col-span-7 flex flex-col gap-6">

                <!-- Personal Details Card -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="size-10 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-2xl">person</span>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Personal Information</h2>
                    </div>

                    <div class="grid gap-4">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Full Name</span>
                            <input wire:model.defer="donor_name" type="text" placeholder="John Doe"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                            @error('donor_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </label>

                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Age</span>
                                <input wire:model.defer="age" type="number" placeholder="18-65"
                                    class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                @error('age') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                            </label>

                            <label class="flex flex-col gap-2">
                                <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Weight (kg)</span>
                                <input wire:model.defer="weight" type="number" placeholder="45+"
                                    class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                @error('weight') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Contact Details Card -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-blue-500"></div>
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="size-10 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600">
                            <span class="material-symbols-outlined text-2xl">contact_phone</span>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Contact Details</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Mobile Number</span>
                            <input wire:model.defer="phone" type="tel" placeholder="9876543210"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            @error('phone') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </label>

                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Email (Optional)</span>
                            <input wire:model.defer="email" type="email" placeholder="you@example.com"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <!-- Submit Button (Desktop) -->
                <button type="submit"
                    class="hidden md:flex w-full h-14 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl font-bold text-lg items-center justify-center gap-2 hover:opacity-90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    <span>Register Now</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </div>

            <!-- Right Column: Blood & Location -->
            <div class="md:col-span-5 flex flex-col gap-6">

                <!-- Blood Group Selector -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Blood Group</h2>
                        <span
                            class="text-xs font-bold text-primary bg-primary/10 px-2 py-1 rounded uppercase">Required</span>
                    </div>

                    <div class="grid grid-cols-4 gap-3">
                        @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $group)
                            <label class="cursor-pointer relative">
                                <input type="radio" wire:model.defer="blood_group" value="{{ $group }}"
                                    class="peer sr-only">
                                <div
                                    class="h-12 rounded-lg border-2 border-slate-100 dark:border-slate-700 flex items-center justify-center font-bold text-slate-600 dark:text-slate-400 hover:border-red-200 dark:hover:border-red-900 peer-checked:border-primary peer-checked:bg-primary peer-checked:text-white transition-all">
                                    {{ $group }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('blood_group') <span class="text-red-600 text-xs mt-2 block">{{ $message }}</span> @enderror
                </div>

                <!-- Location Details -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-green-500"></div>
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="size-10 rounded-full bg-green-50 dark:bg-green-900/20 flex items-center justify-center text-green-600">
                            <span class="material-symbols-outlined text-2xl">location_on</span>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Location</h2>
                    </div>

                    <div class="grid gap-4">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">State</span>
                            <input wire:model.defer="state" type="text" placeholder="State"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all">
                            @error('state') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </label>

                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">District</span>
                            <input wire:model.defer="district" type="text" placeholder="District"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all">
                            @error('district') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </label>

                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">City</span>
                            <input wire:model.defer="city" type="text" placeholder="City"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all">
                            @error('city') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </label>

                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Landmark
                                (Optional)</span>
                            <input wire:model.defer="preferred_area" type="text" placeholder="Near City Center"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all">
                        </label>
                    </div>
                </div>

                <!-- Notes -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                    <label class="block">
                        <span class="text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 block">Notes</span>
                        <textarea wire:model.defer="notes"
                            placeholder="Any specific availability times or medical notes?"
                            class="w-full h-24 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none"></textarea>
                    </label>
                </div>

                <!-- Submit Mobile -->
                <button type="submit"
                    class="md:hidden w-full h-14 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-xl font-bold text-lg flex items-center justify-center gap-2 hover:opacity-90 transition-all shadow-lg active:scale-95">
                    <span>Register Now</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>

            </div>
        </form>

        <!-- Flash Message -->
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="fixed bottom-10 right-10 bg-slate-900 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-4 animate-bounce z-50">
                <span class="material-symbols-outlined text-green-400">check_circle</span>
                <div>
                    <h4 class="font-bold">Registration Successful!</h4>
                    <p class="text-sm text-slate-300">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-slate-400 hover:text-white"><span
                        class="material-symbols-outlined">close</span></button>
            </div>
        @endif

    </div>
</div>