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
    public $state;
    public $district;
    public $city;

    protected $rules = [
        'blood_group'       => 'required',
        'units'             => 'required|integer|min:1',
        'urgency'           => 'required',
        'patient_name'      => 'required|min:3',
        'hospital_name'     => 'required|min:3',
        'hospital_location' => 'required|min:3',
        'phone'             => 'required|min:10',
        'email'             => 'nullable|email',
        'notes'             => 'nullable|string',
    ];

    public function submit()
    {
        $this->validate();

        Blood::create([
            'type'              => 'receiver',
            'user_id'           => Auth::id(),
            'blood_group'       => $this->blood_group,
            'units'             => $this->units,
            'urgency'           => $this->urgency,

            // required columns (safe defaults)
            'country'   => 'India',
            'state'     => $this->state,
            'district'  => $this->district,
            'city'      => $this->city,
            'donor_name'=> $this->patient_name,

            'patient_name'      => $this->patient_name,
            'hospital_name'     => $this->hospital_name,
            'hospital_location' => $this->hospital_location,
            'phone'             => $this->phone,
            'email'             => $this->email,
            'notes'             => $this->notes,

            'is_active' => true,
        ]);

        session()->flash('success', 'Blood request submitted successfully 🚑');
        return redirect()->route('finddoner');
        $this->reset();
    }
};
?>

<div class="layout-content-container flex flex-col max-w-[800px] w-full gap-6 mt-10">

    <!-- Page Heading -->
    <div class="flex flex-wrap justify-between gap-3 px-4">
        <div class="flex flex-col gap-2">
            <h1 class="text-[#1b0d0d] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">
                Request Blood Assistance
            </h1>
            <p class="text-[#9a4c4c] dark:text-red-300 text-base">
                Fill in the details below to broadcast your request to eligible donors in your area.
            </p>
        </div>
    </div>

    <form wire:submit.prevent="submit" class="flex flex-col gap-6">

        <!-- 🔴 Error Summary -->
        @if ($errors->any())
            <div class="mx-4 bg-red-50 border border-red-300 text-red-700 p-4 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Blood Requirement -->
        <div class="bg-white dark:bg-black/20 p-6 rounded-xl border">
            <h2 class="text-xl font-bold pb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">water_drop</span>
                Requirement Details
            </h2>

            <div class="grid md:grid-cols-2 gap-4">

                <label class="flex flex-col">
                    <p class="text-sm font-medium pb-2">Required Blood Group</p>
                    <select wire:model.defer="blood_group" class="h-14 rounded-lg border px-4">
                        <option value="">Select blood type</option>
                        <option>A+</option><option>A-</option>
                        <option>B+</option><option>B-</option>
                        <option>O+</option><option>O-</option>
                        <option>AB+</option><option>AB-</option>
                    </select>
                    @error('blood_group') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </label>

                <label class="flex flex-col">
                    <p class="text-sm font-medium pb-2">Units Needed (Pints)</p>
                    <input type="number" min="1" wire:model.defer="units"
                        class="h-14 rounded-lg border px-4"
                        placeholder="e.g. 2" />
                    @error('units') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </label>
            </div>

            <!-- Urgency -->
            <div class="mt-6">
                <p class="text-sm font-medium pb-2">Urgency Level</p>
                <div class="grid grid-cols-2 gap-4">
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="urgency" value="normal" class="hidden peer">
                        <div class="p-3 border rounded-lg peer-checked:bg-gray-100 text-center">
                            Normal
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="urgency" value="emergency" class="hidden peer">
                        <div
                            class="p-3 border-2 border-primary/20 rounded-lg peer-checked:bg-primary peer-checked:text-white text-primary text-center font-bold">
                            Emergency
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Hospital Info -->
        <div class="bg-white dark:bg-black/20 p-6 rounded-xl border">
            <h2 class="text-xl font-bold pb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">local_hospital</span>
                Address Information
            </h2>

            <label class="flex flex-col mb-4">
                <p class="text-sm font-medium pb-2">State</p>
                <input wire:model.defer="state" class="h-14 rounded-lg border px-4" />
                @error('state') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
            </label>

            <div class="grid md:grid-cols-2 gap-4">
                <label class="flex flex-col">
                    <p class="text-sm font-medium pb-2">district</p>
                    <input wire:model.defer="district" class="h-14 rounded-lg border px-4" />
                    @error('district') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </label>

                <label class="flex flex-col">
                    <p class="text-sm font-medium pb-2">city</p>
                    <input wire:model.defer="city" class="h-14 rounded-lg border px-4" />
                    @error('city') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </label>
            </div>
        </div>
        <div class="bg-white dark:bg-black/20 p-6 rounded-xl border">
            <h2 class="text-xl font-bold pb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">local_hospital</span>
                Hospital Information
            </h2>

            <label class="flex flex-col mb-4">
                <p class="text-sm font-medium pb-2">Patient Name</p>
                <input wire:model.defer="patient_name" class="h-14 rounded-lg border px-4" />
                @error('patient_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
            </label>

            <div class="grid md:grid-cols-2 gap-4">
                <label class="flex flex-col">
                    <p class="text-sm font-medium pb-2">Hospital Name</p>
                    <input wire:model.defer="hospital_name" class="h-14 rounded-lg border px-4" />
                    @error('hospital_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </label>

                <label class="flex flex-col">
                    <p class="text-sm font-medium pb-2">Hospital Location</p>
                    <input wire:model.defer="hospital_location" class="h-14 rounded-lg border px-4" />
                    @error('hospital_location') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </label>
            </div>
        </div>

        <!-- Contact -->
        <div class="bg-white dark:bg-black/20 p-6 rounded-xl border">
            <h2 class="text-xl font-bold pb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">contact_phone</span>
                Contact Details
            </h2>

            <div class="grid md:grid-cols-2 gap-4">
                <label class="flex flex-col">
                    <p class="text-sm font-medium pb-2">Phone Number</p>
                    <input wire:model.defer="phone" type="number" class="h-14 rounded-lg border px-4" />
                    @error('phone') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </label>

                <label class="flex flex-col">
                    <p class="text-sm font-medium pb-2">Email (optional)</p>
                    <input wire:model.defer="email" type="email" class="h-14 rounded-lg border px-4" />
                    @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </label>
            </div>

            <label class="flex flex-col mt-4">
                <p class="text-sm font-medium pb-2">Additional Notes</p>
                <textarea wire:model.defer="notes"
                    class="min-h-[100px] rounded-lg border px-4 py-3"></textarea>
            </label>
        </div>

        <!-- Submit -->
        <div class="px-4 py-6">
            <button type="submit"
                class="w-full h-14 rounded-xl bg-primary text-white text-lg font-bold hover:bg-red-700">
                Submit Blood Request
            </button>

            @if (session()->has('success'))
                <p class="text-green-600 text-center mt-4">
                    {{ session('success') }}
                </p>
            @endif
        </div>
    </form>
</div>
