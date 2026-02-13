<?php

use Livewire\Component;
use App\Models\User;

new class extends Component {
    public $teamMembers;

    public function mount()
    {
        // For now, let's assume team members are users with 'admin' role or just all users if it's a small project
        // Based on the user's request "who created by this project", let's show admins or creators.
        $this->teamMembers = User::where('role', 'admin')->get();
        
        // If no admins found, let's just show all users for demonstration, or add some default ones
        if ($this->teamMembers->isEmpty()) {
            $this->teamMembers = User::all();
        }
    }
};
?>

<div class="w-full flex flex-col items-center">
    <!-- Hero Section -->
    <div class="w-full bg-white dark:bg-[#1a0c0c] border-b border-[#e6dbdb] dark:border-[#3d2424] py-20 px-4">
        <div class="max-w-[1200px] mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-black text-[#181111] dark:text-white mb-6">
                Meet the <span class="text-primary">Visionaries</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-500 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                The dedicated group of individuals working tirelessly to make blood donation accessible, efficient, and life-saving for everyone.
            </p>
        </div>
    </div>

    <!-- Team Grid -->
    <div class="w-full max-w-[1200px] px-4 md:px-20 py-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($teamMembers as $member)
                <div class="group relative flex flex-col items-center p-8 bg-white dark:bg-[#1a0c0c] border border-[#e6dbdb] dark:border-[#3d2424] rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 -mr-12 -mt-12 rounded-full group-hover:scale-110 transition-transform"></div>
                    
                    <div class="relative size-32 mb-6">
                        <div class="size-full rounded-2xl bg-slate-200 dark:bg-slate-700 bg-cover bg-center shadow-lg"
                             style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=ec1313&color=fff&size=200')">
                        </div>
                        <div class="absolute -bottom-2 -right-2 size-8 bg-primary rounded-lg flex items-center justify-center text-white shadow-lg">
                            <span class="material-symbols-outlined text-sm">verified</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <h3 class="text-xl font-black text-[#181111] dark:text-white mb-2">{{ $member->name }}</h3>
                        <p class="text-primary font-bold text-sm uppercase tracking-widest mb-4">
                            {{ $member->role ?? 'Project Contributor' }}
                        </p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6">
                            Dedicated to building a stronger community through technology and compassion.
                        </p>
                    </div>

                    <div class="flex gap-4">
                        <a href="mailto:{{ $member->email }}" class="size-10 rounded-xl bg-[#f4f0f0] dark:bg-[#3d2424] flex items-center justify-center text-[#181111] dark:text-white hover:bg-primary hover:text-white transition-all">
                            <span class="material-symbols-outlined text-xl">mail</span>
                        </a>
                        <a href="#" class="size-10 rounded-xl bg-[#f4f0f0] dark:bg-[#3d2424] flex items-center justify-center text-[#181111] dark:text-white hover:bg-primary hover:text-white transition-all">
                            <span class="material-symbols-outlined text-xl">share</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">groups</span>
                    <p class="text-gray-500">No team members found.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Join Us Section -->
    <div class="w-full max-w-[1000px] px-4 mb-20">
        <div class="relative overflow-hidden bg-primary rounded-[2.5rem] p-12 text-center text-white shadow-2xl shadow-primary/30">
            <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 -ml-32 -mt-32 rounded-full"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-white/10 -mr-32 -mb-32 rounded-full"></div>
            
            <h2 class="text-3xl md:text-4xl font-black mb-6 relative z-10">Want to join our mission?</h2>
            <p class="text-white/80 text-lg mb-10 max-w-xl mx-auto relative z-10">
                We're always looking for passionate individuals to help us expand our reach and save more lives.
            </p>
            <a href="{{ route('register') }}" class="inline-flex items-center gap-3 bg-white text-primary px-8 py-4 rounded-2xl font-black hover:scale-105 transition-transform relative z-10 shadow-xl">
                Become a Member
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </div>
</div>
