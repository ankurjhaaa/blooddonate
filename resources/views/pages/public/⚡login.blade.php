<?php

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\User;

new #[Layout('layouts.app')] class extends Component {
    public $email = '';
    public $password = '';
    public $remember = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            session()->flash('error', 'Credencial Invalid');
            return;
        }

        if (!Hash::check($this->password, $user->password)) {
            session()->flash('error', 'Credencial Invalid');
            return;
        }

        Auth::login($user);
        return redirect()->route('home');
    }
};
?>

<div class="w-full flex flex-col justify-center items-center min-h-[calc(100vh-200px)] py-12">
    <div class="max-w-[480px] w-full px-6 md:px-0 space-y-8">
        <!-- Page Heading -->
        <div class="space-y-2">
            <h1
                class="text-[#1b0d0d] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em] font-display">
                Welcome Back</h1>
            <p class="text-[#9a4c4c] dark:text-[#cc7a7a] text-base font-normal font-display">Sign in to your account to
                access blood donation services.</p>
        </div>

        <form wire:submit="login" class="space-y-4">
            <!-- Email Address -->
            <div class="flex flex-col gap-2">
                <label class="text-[#1b0d0d] dark:text-[#f8f6f6] text-sm font-semibold font-display">Email
                    Address</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#9a4c4c]">mail</span>
                    <input
                        class="form-input w-full rounded-lg border border-[#e7cfcf] dark:border-[#3d2020] bg-white dark:bg-[#2d1a1a] h-14 pl-12 pr-4 text-[#1b0d0d] dark:text-white placeholder:text-[#9a4c4c] focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                        placeholder="john@example.com" type="email" wire:model="email" required />
                </div>
            </div>
            <!-- Password -->
            <div class="flex flex-col gap-2">
                <label class="text-[#1b0d0d] dark:text-[#f8f6f6] text-sm font-semibold font-display">Password</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#9a4c4c]">lock</span>
                    <input
                        class="form-input w-full rounded-lg border border-[#e7cfcf] dark:border-[#3d2020] bg-white dark:bg-[#2d1a1a] h-14 pl-12 pr-12 text-[#1b0d0d] dark:text-white placeholder:text-[#9a4c4c] focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"
                        placeholder="••••••••" type="password" wire:model="password" required />
                    <span
                        class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-[#9a4c4c] cursor-pointer hover:text-primary">visibility</span>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center gap-3 py-2">
                <input class="h-4 w-4 rounded border-[#e7cfcf] dark:border-[#3d2020] text-primary focus:ring-primary"
                    id="remember" type="checkbox" wire:model="remember" />
                <label class="text-sm text-[#9a4c4c] dark:text-[#cc7a7a] font-display" for="remember">
                    Remember me
                </label>
            </div>

            <!-- Forgot Password -->
            <div class="text-right">
                <a class="text-sm text-primary font-semibold hover:underline" href="#">Forgot password?</a>
            </div>

            <!-- Submit Button -->
            <button
                class="w-full bg-primary text-white h-14 rounded-xl font-bold text-lg shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all active:scale-[0.98] mt-6 flex items-center justify-center gap-2"
                type="submit">
                <span>Sign In</span>
                <span class="material-symbols-outlined">arrow_forward</span>
            </button>

            <!-- Sign Up Link -->
            <div class="text-center pt-4">
                <p class="text-[#9a4c4c] dark:text-[#cc7a7a] text-sm font-display">
                    Don't have an account? <a class="text-primary font-bold hover:underline" href="#">Sign up</a>
                </p>
            </div>
        </form>
    </div>
</div>