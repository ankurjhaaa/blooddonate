<?php

use Livewire\Component;
use App\Models\Blood;

new class extends Component {
    public $recentDonors;
    public $totalDonors;
    public $livesSaved;
    public $partnerHospitals;

    public function mount()
    {
        // Dynamic Stats
        $this->totalDonors = Blood::where('type', 'donor')->where('is_active', true)->count();
        $this->livesSaved = $this->totalDonors * 3; // Estimate
        $this->partnerHospitals = Blood::where('type', 'receiver')->distinct('hospital_name')->count('hospital_name');

        // Recent Heroes
        $this->recentDonors = Blood::where('type', 'donor')
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();
    }
};
?>

<div class="w-full flex flex-col justify-center items-center min-h-screen font-sans">

    <!-- Hero Section -->
    <div class="w-full relative overflow-hidden bg-slate-50 dark:bg-[#0f0505]">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-red-500/10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-primary/10 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 py-20 md:py-32 relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-12 md:gap-20">

                <!-- Hero Content -->
                <div class="md:w-1/2 flex flex-col items-start text-left gap-6 animate-fade-in-up">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-xs font-bold uppercase tracking-wider">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                        </span>
                        Urgent Need: A- & O+ Blood
                    </div>

                    <h1
                        class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white leading-[1.1] tracking-tight">
                        Donate Blood, <br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-rose-400">Save a
                            Life.</span>
                    </h1>

                    <p class="text-lg md:text-xl text-slate-600 dark:text-slate-400 max-w-lg leading-relaxed">
                        Join our community of everyday heroes. Your donation is a lifeline for someone in need.
                        It only takes 15 minutes to save 3 lives.
                    </p>

                    <div class="flex flex-wrap gap-4 w-full sm:w-auto">
                        <a href="{{ route('donateblood') }}"
                            class="group relative flex items-center justify-center gap-3 px-8 py-4 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-bold text-lg shadow-lg hover:shadow-red-500/40 transition-all transform hover:-translate-y-1 w-full sm:w-auto">
                            <span>Become a Donor</span>
                            <span
                                class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                        <a href="{{ route('finddoner') }}"
                            class="flex items-center justify-center gap-3 px-8 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-red-200 dark:hover:border-red-900 text-slate-900 dark:text-white rounded-2xl font-bold text-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-all w-full sm:w-auto">
                            <span class="material-symbols-outlined text-red-500">search</span>
                            <span>Find Blood</span>
                        </a>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="md:w-1/2 relative group">
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-red-600 to-rose-400 rounded-3xl rotate-3 opacity-20 group-hover:rotate-6 transition-transform duration-500">
                    </div>
                    <div
                        class="relative bg-white dark:bg-slate-800 p-2 rounded-3xl shadow-2xl rotate-0 group-hover:-rotate-2 transition-transform duration-500">
                        <img src="https://images.unsplash.com/photo-1615461066841-6116e61058f4?q=80&w=1000&auto=format&fit=crop"
                            alt="Blood Donation" class="rounded-2xl w-full object-cover aspect-[4/3]">

                        <!-- Floating Badge -->
                        <div
                            class="absolute -bottom-6 -left-6 bg-white dark:bg-slate-900 p-4 rounded-xl shadow-xl border border-slate-100 dark:border-slate-800 flex items-center gap-4 animate-bounce-slow">
                            <div class="bg-green-100 dark:bg-green-900/30 p-3 rounded-full text-green-600">
                                <span class="material-symbols-outlined">verified_user</span>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-bold uppercase">Trusted By</p>
                                <p class="text-lg font-black text-slate-900 dark:text-white">
                                    {{ number_format($partnerHospitals + 50) }}+ Hospitals
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section (Dynamic) -->
    <div class="w-full bg-white dark:bg-[#1a0c0c] py-20 border-y border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">

            <div
                class="bg-slate-50 dark:bg-[#221010] p-8 rounded-3xl text-center group hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors border border-transparent hover:border-red-100 dark:hover:border-red-900/30">
                <div
                    class="mx-auto w-16 h-16 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">groups</span>
                </div>
                <h3 class="text-5xl font-black text-slate-900 dark:text-white mb-2">{{ number_format($totalDonors) }}
                </h3>
                <p class="text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wide">Registered Donors</p>
            </div>

            <div
                class="bg-slate-50 dark:bg-[#221010] p-8 rounded-3xl text-center group hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors border border-transparent hover:border-red-100 dark:hover:border-red-900/30">
                <div
                    class="mx-auto w-16 h-16 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">favorite</span>
                </div>
                <h3 class="text-5xl font-black text-slate-900 dark:text-white mb-2">{{ number_format($livesSaved) }}
                </h3>
                <p class="text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wide">Lives Saved (Est)</p>
            </div>

            <div
                class="bg-slate-50 dark:bg-[#221010] p-8 rounded-3xl text-center group hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors border border-transparent hover:border-red-100 dark:hover:border-red-900/30">
                <div
                    class="mx-auto w-16 h-16 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">local_hospital</span>
                </div>
                <h3 class="text-5xl font-black text-slate-900 dark:text-white mb-2">
                    {{ number_format($partnerHospitals) }}
                </h3>
                <p class="text-slate-500 dark:text-slate-400 font-bold uppercase tracking-wide">Partner Hospitals</p>
            </div>

        </div>
    </div>

    <!-- Recent Donors & Activity -->
    <section class="w-full py-20 px-6 max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="text-red-500 font-bold uppercase tracking-wider text-sm">Real-time Activity</span>
            <h2 class="text-4xl font-black text-slate-900 dark:text-white mt-2">Latest Heroes</h2>
            <p class="text-slate-500 dark:text-slate-400 max-w-xl mx-auto mt-4">
                People just like you are signing up every minute to make a difference.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($recentDonors as $donor)
                <div
                    class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-14 h-14 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-xl font-bold text-slate-500 overflow-hidden border-2 border-white dark:border-slate-700 shadow-sm">
                            {{ substr($donor->donor_name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-slate-900 dark:text-white leading-tight">
                                {{ $donor->donor_name }}
                            </h3>
                            <div class="flex items-center gap-1 text-xs text-slate-500 font-medium mt-1">
                                <span class="material-symbols-outlined text-sm">location_on</span>
                                {{ $donor->city }}, {{ $donor->state }} - {{ $donor->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div
                            class="ml-auto flex flex-col items-center justify-center w-12 h-12 rounded-xl bg-red-50 dark:bg-red-900/20 text-red-600 font-black border border-red-100 dark:border-red-900/30">
                            <span class="text-sm line-through opacity-50 block -mb-1 text-[10px]">Type</span>
                            {{ $donor->blood_group }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-800">
                        <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded">Active Hero</span>
                        <button
                            class="text-sm font-bold text-slate-900 dark:text-white flex items-center gap-1 hover:text-red-600 transition-colors">
                            View Profile <span class="material-symbols-outlined text-sm">arrow_outward</span>
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-10 text-center">
                    <div class="inline-block p-4 rounded-full bg-slate-50 dark:bg-slate-800 mb-4">
                        <span class="material-symbols-outlined text-4xl text-slate-400">person_off</span>
                    </div>
                    <p class="text-slate-500 font-medium">No active donors yet. Be the first!</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('finddoner') }}"
                class="inline-flex items-center gap-2 font-bold text-slate-900 dark:text-white border-b-2 border-slate-900 dark:border-white pb-1 hover:text-red-600 hover:border-red-600 transition-colors">
                View All Donors
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="w-full bg-red-600 text-white py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10">
        </div>
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-black mb-6">Ready to make an impact?</h2>
            <p class="text-xl text-red-100 mb-10 max-w-2xl mx-auto">
                There are patients waiting for your help right now. Registration takes less than 2 minutes.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('donateblood') }}"
                    class="px-8 py-4 bg-white text-red-600 rounded-2xl font-bold text-lg shadow-xl hover:bg-slate-100 transition-all transform hover:-translate-y-1">
                    Sign Up Now
                </a>
                <a href="{{ route('requestform') }}"
                    class="px-8 py-4 bg-red-700 text-white border border-red-500 rounded-2xl font-bold text-lg hover:bg-red-800 transition-all">
                    I Need Blood
                </a>
            </div>
        </div>
    </section>

</div>