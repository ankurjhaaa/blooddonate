<?php

use Livewire\Component;
use App\Models\Blood;
use Illuminate\Support\Facades\Auth;

new class extends Component {

    public $blood_group;
    public $units;
    public $urgency = 'normal';

    public $patient_name;
    public $hospital_name;
    public $hospital_location;

    // Address
    public $state;
    public $district;
    public $city;

    public $phone;
    public $email;
    public $notes;

    protected $rules = [
        'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
        'units' => 'required|integer|min:1|max:20',
        'urgency' => 'required|in:normal,emergency',
        'patient_name' => 'required|min:3|string',
        'hospital_name' => 'required|min:3|string',
        'hospital_location' => 'required|min:5|string', // Detailed address needed
        'state' => 'required|min:2|string',
        'district' => 'required|min:2|string',
        'city' => 'required|min:2|string',
        'phone' => ['required', 'regex:/^[6-9]\d{9}$/'], // Indian Phone Format
        'email' => 'nullable|email',
        'notes' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'phone.regex' => 'Please enter a valid 10-digit Indian mobile number.',
        'units.max' => 'For large requests (>20 units), please contact blood banks directly.',
        'hospital_location.min' => 'Please provide the full hospital address for faster help.',
    ];

    public function mount()
    {
        if (Auth::check()) {
            $this->phone = Auth::user()->phone;
            $this->email = Auth::user()->email;
        }
    }

    public function submit()
    {
        $this->validate();

        Blood::create([
            'type' => 'receiver',
            'user_id' => Auth::id(),
            'blood_group' => $this->blood_group,
            'units' => $this->units,
            'urgency' => $this->urgency,

            // Location for the request (where blood is needed)
            'country' => 'India',
            'state' => $this->state,
            'district' => $this->district,
            'city' => $this->city,

            // Patient / Hospital Info
            'patient_name' => $this->patient_name,
            'hospital_name' => $this->hospital_name,
            'hospital_location' => $this->hospital_location,

            // Contact (Requester)
            'phone' => $this->phone,
            'email' => $this->email,
            'notes' => $this->notes,

            'is_active' => true,
        ]);

        session()->flash('success', 'Blood request broadcasted! Help is on the way. 🚑'); // Emoji for visual confirmation

        $this->reset(['blood_group', 'units', 'urgency', 'patient_name', 'hospital_name', 'hospital_location', 'state', 'district', 'city', 'notes']);
        // Keep phone/email for convenience
    }
};
?>

<div class="w-full flex justify-center py-10 px-4">
    <div class="max-w-4xl w-full">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-4 tracking-tight">
                Request <span class="text-red-600">Blood Assistance</span>
            </h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                Broadcast your request to thousands of registered donors instantly.
            </p>
        </div>

        <form wire:submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-12 gap-6">

            <!-- Left Column: Patient & Hospital -->
            <div class="md:col-span-7 flex flex-col gap-6">

                <!-- Patient / Hospital Details -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-red-600"></div>
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="size-10 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-red-600">
                            <span class="material-symbols-outlined text-2xl">local_hospital</span>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Hospital & Patient</h2>
                    </div>

                    <div class="grid gap-4">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Patient Name</span>
                            <input wire:model.defer="patient_name" type="text" placeholder="Patient Full Name"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                            @error('patient_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </label>

                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Hospital Name</span>
                            <input wire:model.defer="hospital_name" type="text" placeholder="Hospital Name"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                            @error('hospital_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </label>

                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Hospital Address</span>
                            <input wire:model.defer="hospital_location" type="text"
                                placeholder="Full Address of Hospital"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                            @error('hospital_location') <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

                <!-- Requirement Details -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="size-10 rounded-full bg-red-50 dark:bg-red-900/20 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-2xl">water_drop</span>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Blood Requirement</h2>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Blood Group</span>
                            <select wire:model.defer="blood_group"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                                <option value="">Select</option>
                                @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $group)
                                    <option value="{{ $group }}">{{ $group }}</option>
                                @endforeach
                            </select>
                            @error('blood_group') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </label>

                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Units Needed</span>
                            <input wire:model.defer="units" type="number" min="1" placeholder="Units"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                            @error('units') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <div>
                        <span class="text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 block">Urgency
                            Level</span>
                        <div class="flex gap-4">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" wire:model="urgency" value="normal" class="peer sr-only">
                                <div
                                    class="h-12 rounded-lg border-2 border-slate-100 dark:border-slate-700 flex items-center justify-center font-bold text-slate-600 peer-checked:border-slate-500 peer-checked:bg-slate-500 peer-checked:text-white transition-all">
                                    Normal
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" wire:model="urgency" value="emergency" class="peer sr-only">
                                <div
                                    class="h-12 rounded-lg border-2 border-red-100 dark:border-red-900/30 flex items-center justify-center font-bold text-red-600 peer-checked:border-red-600 peer-checked:bg-red-600 peer-checked:text-white transition-all gap-2">
                                    <span class="material-symbols-outlined text-lg">warning</span> Emergency
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Button (Desktop) -->
                <button type="submit"
                    class="hidden md:flex w-full h-14 bg-red-600 text-white rounded-xl font-bold text-lg items-center justify-center gap-2 hover:bg-red-700 transition-all shadow-lg hover:shadow-xl hover:shadow-red-500/30 transform hover:-translate-y-1">
                    <span>Broadcast Request</span>
                    <span class="material-symbols-outlined">campaign</span>
                </button>
            </div>

            <!-- Right Column: Location & Contact -->
            <div class="md:col-span-5 flex flex-col gap-6">

                <!-- Location Details -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-green-500"></div>
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="size-10 rounded-full bg-green-50 dark:bg-green-900/20 flex items-center justify-center text-green-600">
                            <span class="material-symbols-outlined text-2xl">location_on</span>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Location Details</h2>
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
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">City/Area</span>
                            <input wire:model.defer="city" type="text" placeholder="City"
                                class="w-full h-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all">
                            @error('city') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </label>
                    </div>
                </div>

                <!-- Contact & Notes -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-blue-500"></div>
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="size-10 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600">
                            <span class="material-symbols-outlined text-2xl">contact_phone</span>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Contact & Notes</h2>
                    </div>

                    <div class="grid gap-4">
                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Contact Number</span>
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

                        <label class="block mt-2">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 block">Additional
                                Notes</span>
                            <textarea wire:model.defer="notes" placeholder="Any specific instructions?"
                                class="w-full h-24 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-4 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all resize-none"></textarea>
                        </label>
                    </div>
                </div>

                <!-- Submit Mobile -->
                <button type="submit"
                    class="md:hidden w-full h-14 bg-red-600 text-white rounded-xl font-bold text-lg flex items-center justify-center gap-2 hover:bg-red-700 transition-all shadow-lg active:scale-95">
                    <span>Broadcast Request</span>
                    <span class="material-symbols-outlined">campaign</span>
                </button>

            </div>
        </form>

        <!-- Flash Message -->
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="fixed bottom-10 right-10 bg-slate-900 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-4 animate-bounce z-50">
                <span class="material-symbols-outlined text-green-400">check_circle</span>
                <div>
                    <h4 class="font-bold">Request Sent!</h4>
                    <p class="text-sm text-slate-300">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-slate-400 hover:text-white"><span
                        class="material-symbols-outlined">close</span></button>
            </div>
        @endif

    </div>
</div>