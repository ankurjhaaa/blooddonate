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

    public $phone;
    public $email;
    public $notes;

    protected $rules = [
        'blood_group' => 'required',
        'units' => 'required|integer|min:1',
        'urgency' => 'required',
        'patient_name' => 'required|min:3',
        'hospital_name' => 'required|min:3',
        'hospital_location' => 'required|min:3',
        'phone' => 'required|min:10',
        'email' => 'nullable|email',
        'notes' => 'nullable|string',
    ];

    public function submit()
    {
        $this->validate();

        Blood::create([
            // REQUIRED BY TABLE
            'type' => 'receiver',
            'user_id' => Auth::id(),
            'blood_group' => $this->blood_group,
            'urgency' => $this->urgency,
            'country' => 'India',

            // 👇 FIX FOR REQUIRED COLUMNS
            'state' => 'N/A',
            'district' => 'N/A',
            'city' => 'N/A',
            'donor_name' => $this->patient_name, // smart reuse

            // RECEIVER DATA
            'units' => $this->units,
            'patient_name' => $this->patient_name,
            'hospital_name' => $this->hospital_name,
            'hospital_location' => $this->hospital_location,
            'phone' => $this->phone,
            'email' => $this->email,
            'notes' => $this->notes,

            'is_active' => true,
        ]);

        session()->flash('success', 'Blood request submitted successfully 🚑');

        $this->reset();
    }
};
?>

<div class="layout-content-container flex flex-col max-w-[800px] w-full gap-6 mt-5 mb-5">

    <!-- Heading -->
    <div class="px-4">
        <h1 class="text-4xl font-black text-[#1b0d0d] dark:text-white">
            Request Blood Assistance
        </h1>
        <p class="text-[#9a4c4c] dark:text-red-300">
            Fill in the details below to broadcast your request.
        </p>
    </div>

    <form wire:submit.prevent="submit" class="flex flex-col gap-6">

        <!-- Errors -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 p-4 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Requirement -->
        <div class="bg-white dark:bg-black/20 p-6 rounded-xl border">
            <h2 class="text-xl font-bold mb-4">Requirement Details</h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <select wire:model.defer="blood_group" class="h-14 w-full rounded-lg border px-4">
                        <option value="">Select Blood Group</option>
                        <option>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>O+</option>
                        <option>O-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                    </select>
                    @error('blood_group') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <input type="number" min="1" wire:model.defer="units" placeholder="Units Needed"
                        class="h-14 w-full rounded-lg border px-4" />
                    @error('units') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6 flex gap-6">
                <label class="flex items-center gap-2">
                    <input type="radio" wire:model="urgency" value="normal"> Normal
                </label>
                <label class="flex items-center gap-2">
                    <input type="radio" wire:model="urgency" value="emergency"> Emergency
                </label>
            </div>
        </div>

        <!-- Hospital -->
        <div class="bg-white dark:bg-black/20 p-6 rounded-xl border">
            <h2 class="text-xl font-bold mb-4">Hospital Information</h2>

            <input wire:model.defer="patient_name" placeholder="Patient Name"
                class="h-14 w-full rounded-lg border px-4 mb-2" />
            @error('patient_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror

            <div class="grid md:grid-cols-2 gap-4 mt-2">
                <div>
                    <input wire:model.defer="hospital_name" placeholder="Hospital Name"
                        class="h-14 w-full rounded-lg border px-4" />
                    @error('hospital_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <input wire:model.defer="hospital_location" placeholder="Hospital Location"
                        class="h-14 w-full rounded-lg border px-4" />
                    @error('hospital_location') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <!-- Hospital -->
        <div class="bg-white dark:bg-black/20 p-6 rounded-xl border">
            <h2 class="text-xl font-bold mb-4">Address Information</h2>

            <input wire:model.live="patient_name" placeholder="Patient Name"
                class="h-14 w-full rounded-lg border px-4 mb-2" />
            @error('patient_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror

            <div class="grid md:grid-cols-2 gap-4 mt-2">
                <div>
                    <input wire:model.defer="hospital_name" placeholder="Hospital Name"
                        class="h-14 w-full rounded-lg border px-4" />
                    @error('hospital_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <input wire:model.defer="hospital_location" placeholder="Hospital Location"
                        class="h-14 w-full rounded-lg border px-4" />
                    @error('hospital_location') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div class="bg-white dark:bg-black/20 p-6 rounded-xl border">
            <h2 class="text-xl font-bold mb-4">Contact Details</h2>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <input wire:model.defer="phone" placeholder="Phone Number"
                        class="h-14 w-full rounded-lg border px-4" />
                    @error('phone') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <input wire:model.defer="email" placeholder="Email (optional)"
                        class="h-14 w-full rounded-lg border px-4" />
                    @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <textarea wire:model.defer="notes" placeholder="Additional notes..."
                class="mt-4 w-full min-h-[100px] rounded-lg border px-4 py-3"></textarea>
        </div>

        <button type="submit" class="h-14 rounded-xl bg-primary text-white font-bold hover:bg-red-700">
            Submit Blood Request
        </button>

        @if (session()->has('success'))
            <div class="bg-green-50 border border-green-300 text-green-700 p-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif
    </form>
</div>