<?php

use Livewire\Component;
use App\Models\Blood;

new class extends Component {
    public $Bloods;
    public function mount()
    {
        $this->Bloods = Blood::take(3)->get();
    }
};
?>

<div class="w-full flex flex-col justify-center items-center min-h-[calc(100vh-200px)] ">
    <!-- Hero Section -->
    <div class="w-full max-w-[1200px] px-4 md:px-20 py-10 md:py-20">
        <div class="flex flex-col gap-8 md:flex-row items-center">
            <div class="flex flex-col gap-6 md:w-1/2">
                <div class="flex flex-col gap-4">
                    <h1
                        class="text-[#181111] dark:text-white text-5xl md:text-6xl font-black leading-tight tracking-[-0.033em]">
                        Donate Blood, <br /><span class="text-primary">Save Lives</span>
                    </h1>
                    <p
                        class="text-[#181111] dark:text-gray-300 text-lg md:text-xl font-normal leading-relaxed max-w-[500px]">
                        Your donation can give someone a second chance at life. Join our community of heroes
                        today and help bridge the gap in blood supply.
                    </p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('donateblood') }}"
                        class="flex min-w-[160px] cursor-pointer items-center justify-center rounded-xl h-14 px-6 bg-primary text-white text-lg font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-transform">
                        <span>Become a Donor</span>
                    </a>
                    <a href="{{ route('finddoner') }}"
                        class="flex min-w-[160px] cursor-pointer items-center justify-center rounded-xl h-14 px-6 bg-white dark:bg-[#3d2424] border-2 border-primary/10 text-[#181111] dark:text-white text-lg font-bold hover:bg-[#f4f0f0] transition-all">
                        <span>Find Blood</span>
                    </a>
                </div>
            </div>
            <div class="w-full md:w-1/2 aspect-video md:aspect-square bg-cover bg-center rounded-2xl shadow-2xl"
                data-alt="Doctor holding a blood donation bag"
                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDfWSeK_9b1OaRlwn-rH1YR6SNMIj7rlBMbF7adNvi6jRu2EOFsBMVwGVj_yXGdv5uOT_4e9c2YsFHEQndxkxSpaNwVO9k1yLZh_P4D01N9dXRFabR8HbK-QhjN6u6HGmb_W9YrYY8obftTC1xpa0zk5v6qMm02QzmWu5t4FmC8NplrJTWs_9ZiD6fOdHE2Zgpf85aQAhqmYFdn6fqTCLpl59FGB3yhYl53HsIIO7ktfwXYt8yYPJlxbf_Peo106S63G5nv6jVbtw");'>
            </div>
        </div>
    </div>
    <!-- Stats Section -->
    <div class="w-full bg-white dark:bg-[#1a0c0c] py-12 border-y border-[#e6dbdb] dark:border-b-[#3d2424]">
        <div class="max-w-[1200px] mx-auto px-20 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="flex flex-col items-center gap-2 text-center p-6 bg-background-light dark:bg-[#221010] rounded-2xl border border-[#e6dbdb] dark:border-[#3d2424]">
                <span class="material-symbols-outlined text-primary text-4xl mb-2">groups</span>
                <p class="text-[#181111] dark:text-gray-400 text-base font-medium uppercase tracking-wider">
                    Total Donors</p>
                <p class="text-[#181111] dark:text-white text-4xl font-black">15,420</p>
                <p class="text-[#078807] text-sm font-bold flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">trending_up</span> +12% this month
                </p>
            </div>
            <div
                class="flex flex-col items-center gap-2 text-center p-6 bg-background-light dark:bg-[#221010] rounded-2xl border border-[#e6dbdb] dark:border-[#3d2424]">
                <span class="material-symbols-outlined text-primary text-4xl mb-2">favorite</span>
                <p class="text-[#181111] dark:text-gray-400 text-base font-medium uppercase tracking-wider">
                    Lives Saved</p>
                <p class="text-[#181111] dark:text-white text-4xl font-black">46,260</p>
                <p class="text-[#078807] text-sm font-bold flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">trending_up</span> +15% this month
                </p>
            </div>
            <div
                class="flex flex-col items-center gap-2 text-center p-6 bg-background-light dark:bg-[#221010] rounded-2xl border border-[#e6dbdb] dark:border-[#3d2424]">
                <span class="material-symbols-outlined text-primary text-4xl mb-2">local_hospital</span>
                <p class="text-[#181111] dark:text-gray-400 text-base font-medium uppercase tracking-wider">
                    Partner Hospitals</p>
                <p class="text-[#181111] dark:text-white text-4xl font-black">120</p>
                <p class="text-[#078807] text-sm font-bold flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">trending_up</span> +5% new partners
                </p>
            </div>
        </div>
    </div>
    <!-- Availability Section -->
    <section class="py-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($Bloods as $Blood)
                <!-- Donor Card 1 -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-md hover:shadow-lg transition-shadow p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 -mr-8 -mt-8 rounded-full"></div>
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-full bg-slate-200 bg-cover bg-center"
                                data-alt="Portrait of a male blood donor"
                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBGqIZddJibNk5jV8yRhjEfWDBWa_3m8tbLUQ0WJ6M6JIgGyHx59hy5COWgeRkieOCitDs2BUIbME5sF3xu-YIZRntFemNIZV4VycRBPwzhxtKcCrKFoJGAPDwI8fGjgNo7OaCkPZl3GPofYWsGQ43MiTFIYKNsL6yhI7pfXnjrndGi8jUoxuH9cyIMsK8hPMHzm7YPLSV2uToDVut2e6oNiroEv9PB4B8x7bgZkBoyhc9fcZDODPOPl_PwZhCI3_2DQykMgEXAjw')">
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 dark:text-white">{{ $Blood->patient_name }}</h3>
                                <div class="flex items-center text-xs text-slate-500 font-medium">
                                    <span class="material-symbols-outlined text-sm mr-1">location_on</span>
                                    {{ $Blood->city }}, {{ $Blood->state }}
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-primary text-white font-black px-3 py-1 rounded-lg text-sm shadow-sm shadow-primary/30">
                            {{ $Blood->blood_group }}
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6 text-sm">

                        <div class="bg-slate-50 dark:bg-slate-700/50 p-3 rounded-xl">
                            <span
                                class="text-slate-500 dark:text-slate-400 block text-[10px] uppercase font-bold mb-1">Status</span>
                            <span class="flex items-center gap-1.5 text-green-600 font-semibold">
                                <span class="size-1.5 rounded-full bg-green-600"></span> Available
                            </span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="tel:{{ $Blood->phone }}"
                            class="flex-1 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 py-2.5 rounded-lg text-sm font-bold flex items-center justify-center gap-2 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                            <span class="material-symbols-outlined text-lg">call</span> Call
                        </a>
                        <button
                            class="flex-1 bg-primary text-white py-2.5 rounded-lg text-sm font-bold flex items-center justify-center gap-2 hover:bg-primary/90 transition-colors shadow-sm shadow-primary/20">
                            Request
                        </button>

                    </div>
                </div>
            @endforeach


        </div>
        <div class="mt-10 flex justify-center">
            <a href="{{ route('finddoner') }}"
                class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-8 py-3 rounded-xl font-bold text-slate-600 dark:text-slate-400 hover:text-primary transition-colors flex items-center gap-2">
                Show More Donors
                <span class="material-symbols-outlined">expand_more</span>
            </a>
        </div>
    </section>
    <!-- How It Works infographic section -->
    <section class="w-full bg-white dark:bg-[#1a0c0c] py-20" id="how-it-works">
        <div class="max-w-[1200px] mx-auto px-20">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Simple 3-Step Process</h2>
                <p class="text-gray-500 max-w-lg mx-auto">Donating blood is easier than you think. Here's
                    how you can make a difference in less than an hour.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="size-20 bg-primary text-white rounded-2xl flex items-center justify-center mb-6 shadow-xl shadow-primary/30">
                        <span class="material-symbols-outlined text-4xl">edit_document</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">1. Register</h3>
                    <p class="text-gray-500">Sign up online or at any of our partner centers. Complete a
                        quick health screening.</p>
                </div>
                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="size-20 bg-primary text-white rounded-2xl flex items-center justify-center mb-6 shadow-xl shadow-primary/30">
                        <span class="material-symbols-outlined text-4xl">vaccines</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">2. Donate</h3>
                    <p class="text-gray-500">The actual donation only takes about 10-15 minutes in a
                        comfortable, safe environment.</p>
                </div>
                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center">
                    <div
                        class="size-20 bg-primary text-white rounded-2xl flex items-center justify-center mb-6 shadow-xl shadow-primary/30">
                        <span class="material-symbols-outlined text-4xl">celebration</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">3. Save Lives</h3>
                    <p class="text-gray-500">Your donation is processed and sent to hospitals to help
                        patients in urgent need.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- NGO Section -->
    <section class="w-full max-w-[1200px] px-4 md:px-20 py-20" id="ngos">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div class="text-center md:text-left">
                <h2 class="text-[#181111] dark:text-white text-3xl font-bold">Featured NGOs</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Supporting organizations across the country
                </p>
            </div>
            <button
                class="bg-[#f4f0f0] dark:bg-[#3d2424] px-6 py-3 rounded-lg font-bold hover:bg-[#e6dbdb] transition-all">View
                All Organizations</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- NGO Card 1 -->
            <div
                class="bg-white dark:bg-[#1a0c0c] border border-[#e6dbdb] dark:border-[#3d2424] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow">
                <div class="h-48 bg-cover bg-center" data-alt="A group of health volunteers"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDnWYti0Vy6Wpz_sCy-XGsU7cwMOUgLDCAffSWlcqy0Tbh7q6RA6YXxlmg23blPU83QiK1UKJBCiJPb6d7CbqPObzZWzUkDv7tOzQb0sfQuxWxiV3oUh4aX-eDar1me9cBOzVA73tQ5AuTcrtKHYHICGC0ZX_JhJDrDnUoJv8STqX33u_LE6HB84q8dykoZoGhdWzXH1ogZGUvgWDSb1EwxZRe6NqIvJDxTKDtPokknm8zVGCIQ5Y93ZmZZ7IpazWCb7gywE3UGgA');">
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold mb-2">Red Cross Society</h4>
                    <p class="text-gray-500 text-sm mb-4">Dedicated to emergency assistance, disaster
                        relief, and health education.</p>
                    <div class="flex items-center gap-2 text-primary font-bold text-sm cursor-pointer hover:underline">
                        Learn More <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </div>
                </div>
            </div>
            <!-- NGO Card 2 -->
            <div
                class="bg-white dark:bg-[#1a0c0c] border border-[#e6dbdb] dark:border-[#3d2424] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow">
                <div class="h-48 bg-cover bg-center" data-alt="Hands stacked together in teamwork"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAmqAM5BMvdvJjiW98MojRrGfnQiPHMlcMh0lkxVnSTAQJctGuOLhvmcYOicB_z171ZA82Ykenb8t-j-bnelyg1I0k46vLCvcNr6gXZWP6dazu_gYpnAoxcTpdQ-RzycUfDmWULcVuYBDKhwpyl1F7xqmAC-Mdk-SfKto3czrgXw32OKijPR6idAbO_tBuCZ828mu5glGRnhfCpXNiD7aLG26ZplzzkskxV0DdVVTuBmbIhP7_Amrq_rgwuDwxQY7EwRKVMbp_x2g');">
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold mb-2">LifeStream Foundation</h4>
                    <p class="text-gray-500 text-sm mb-4">Bridging the gap between blood donors and rural
                        healthcare centers.</p>
                    <div class="flex items-center gap-2 text-primary font-bold text-sm cursor-pointer hover:underline">
                        Learn More <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </div>
                </div>
            </div>
            <!-- NGO Card 3 -->
            <div
                class="bg-white dark:bg-[#1a0c0c] border border-[#e6dbdb] dark:border-[#3d2424] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow">
                <div class="h-48 bg-cover bg-center" data-alt="Modern laboratory setup"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAZzPK2oXahvd-Ccd7gFUMRApJo_jADe-d4eWWAX_z76sAoz7DIQtGRacx2gAi_Rh8CHLons6U_3snReFSKKjpFbY4oLKvPbR1UuHVSg27YDRoyvKmAURJgqShVEGw8AlAU8zaBLJnd20eCvc1rTWGYx6VwrBqxePbtNZUM7vF_DiN5Yt1RYVgoe32bjwfFqq3B6lCE6dKovn3ml3n3QEfXv24AxP7pDyi2WTsww5Pa3qOKExsv-J96aXIFvxQTB1uR0Su8D-x9Gg');">
                </div>
                <div class="p-6">
                    <h4 class="text-xl font-bold mb-2">Unity Blood Bank</h4>
                    <p class="text-gray-500 text-sm mb-4">A community-driven network ensuring no one waits
                        for rare blood types.</p>
                    <div class="flex items-center gap-2 text-primary font-bold text-sm cursor-pointer hover:underline">
                        Learn More <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>