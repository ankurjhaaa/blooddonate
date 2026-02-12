<?php

use Livewire\Component;
use App\Models\User;

new class extends Component {
    public string $name = "";
    public string $email = "";
    public string $password = "";


    public function register()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'user'
        ]);
        Auth::login($user);
        return redirect()->route('home');
    }
};
?>

<div class="w-full flex flex-col justify-center items-center min-h-[calc(100vh-200px)] py-12">

    <!-- Right Side: Signup Form -->
    <div
        class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 md:p-12 lg:p-20 overflow-y-auto custom-scrollbar">
        <div class="max-w-[480px] w-full space-y-8">
            <!-- Page Heading -->
            <div class="space-y-2">
                <h1
                    class="text-[#1b0d0d] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em] font-display">
                    Create Your Account</h1>
                <p class="text-[#9a4c4c] dark:text-[#cc7a7a] text-base font-normal font-display">Join our
                    community to save lives or find help when you need it.</p>
            </div>

            <form wire:submit="register" class="space-y-4">
                <!-- Full Name -->
                <div class="flex flex-col gap-2">
                    <label class="text-[#1b0d0d] dark:text-[#f8f6f6] text-sm font-semibold font-display">Full
                        Name</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#9a4c4c]">person</span>
                        <input wire:model="name"
                            class="form-input w-full rounded-lg border border-[#e7cfcf] dark:border-[#3d2020] bg-white dark:bg-[#2d1a1a] h-14 pl-12 pr-4 text-[#1b0d0d] dark:text-white placeholder:text-[#9a4c4c] focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                            placeholder="John Doe" type="text" />
                    </div>
                </div>
                <!-- Email Address -->
                <div class="flex flex-col gap-2">
                    <label class="text-[#1b0d0d] dark:text-[#f8f6f6] text-sm font-semibold font-display">Email
                        Address</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#9a4c4c]">mail</span>
                        <input wire:model="email"
                            class="form-input w-full rounded-lg border border-[#e7cfcf] dark:border-[#3d2020] bg-white dark:bg-[#2d1a1a] h-14 pl-12 pr-4 text-[#1b0d0d] dark:text-white placeholder:text-[#9a4c4c] focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                            placeholder="john@example.com" type="email" />
                    </div>
                </div>
                <!-- Password -->
                <div class="flex flex-col gap-2">
                    <label
                        class="text-[#1b0d0d] dark:text-[#f8f6f6] text-sm font-semibold font-display">Password</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#9a4c4c]">lock</span>
                        <input wire:model="password"
                            class="form-input w-full rounded-lg border border-[#e7cfcf] dark:border-[#3d2020] bg-white dark:bg-[#2d1a1a] h-14 pl-12 pr-12 text-[#1b0d0d] dark:text-white placeholder:text-[#9a4c4c] focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                            placeholder="••••••••" type="password" />
                        <span
                            class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#9a4c4c] cursor-pointer hover:text-primary">visibility</span>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start gap-3 py-2">
                    <input
                        class="mt-1 h-4 w-4 rounded border-[#e7cfcf] dark:border-[#3d2020] text-primary focus:ring-primary"
                        id="terms" type="checkbox" />
                    <label class="text-sm text-[#9a4c4c] dark:text-[#cc7a7a] font-display" for="terms">
                        I agree to the <a class="text-primary font-semibold hover:underline" href="#">Terms of
                            Service</a> and <a class="text-primary font-semibold hover:underline" href="#">Privacy
                            Policy</a>.
                    </label>
                </div>
                <!-- Submit Button -->
                <button
                    class="w-full bg-primary text-white h-14 rounded-xl font-bold text-lg shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all active:scale-[0.98] mt-4 flex items-center justify-center gap-2"
                    type="submit">
                    <span>Create Account</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
                <div class="text-center pt-4">
                    <p class="text-[#9a4c4c] dark:text-[#cc7a7a] text-sm font-display">
                        Already have an account? <a class="text-primary font-bold hover:underline" href="#">Log
                            in</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>