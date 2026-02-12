<?php

use Livewire\Component;
use App\Models\Blood;

new class extends Component {
    public $bloods;
    public function mount()
    {
        $this->bloods = Blood::where('user_id', Auth::id())->get();
    }
};
?>

<div class="layout-content-container flex flex-col w-full max-w-[960px] px-4 py-10">
    <!-- Profile Header -->
    <div class="flex flex-col @container">
        <div
            class="flex w-full flex-col gap-6 @[520px]:flex-row @[520px]:justify-between @[520px]:items-start bg-white dark:bg-[#2d1616] p-6 rounded-xl shadow-sm">
            <div class="flex flex-col @[480px]:flex-row gap-6">
                <div class="relative">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-32 border-4 border-white dark:border-[#3d2020]"
                        data-alt="User profile picture of John Doe"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDs7UX0cZHihWsZCuKMIduxT4ZqagAbxgatQyb6XoT6GdKvP0ZlV0E-BQNgMliY6f9MT1I__ECnrQmE7WeZkl55RjpUfIPol2DBxbCDWlnummKqdrdjZRksdGZmET0bUohf6knGFw3hBxnakkYBA52rBBenFfyRAk8IkL-B9PywVbyOu1f8NSmU_D-aXvB8xnJ475pP3zbE_gw3PYcTYs5urHvxkABIHYu7XNHQRTHvyNBNMTKaafgQRdAn75pEMDxXzSGrgHTsTA");'>
                    </div>
                    <div
                        class="absolute bottom-1 right-1 size-6 bg-green-500 border-2 border-white dark:border-[#2d1616] rounded-full">
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <div class="flex items-center gap-3">
                        <h1 class="text-[#1b0d0d] dark:text-white text-3xl font-bold tracking-tight">
                            {{ Auth::user()->name }}
                        </h1>

                    </div>

                    <div class="flex items-center gap-2 mt-2">
                        <span class="flex size-2 rounded-full bg-green-500"></span>
                        <p class="text-green-600 dark:text-green-400 text-sm font-semibold">Available to
                            Donate</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-3 w-full @[480px]:w-auto min-w-[200px]">
                <a href="{{ route('donateblood') }}"
                    class="flex items-center justify-center rounded-lg h-11 px-6 bg-primary text-white text-sm font-bold tracking-[0.015em] hover:bg-red-700 transition-colors w-full">
                    <span class="material-symbols-outlined mr-2 text-lg">add_circle</span>
                    Add Blood Donation
                </a>
                <a href="{{ route('finddoner') }}"
                    class="flex items-center justify-center rounded-lg h-11 px-6 border-2 border-primary text-primary dark:text-red-400 text-sm font-bold tracking-[0.015em] hover:bg-primary/10 transition-colors w-full">
                    <span class="material-symbols-outlined mr-2 text-lg">emergency</span>
                    Request Blood
                </a>
            </div>
        </div>
    </div>
    <!-- Availability Action -->
    <div class="flex py-6 justify-start">
        <button
            class="flex items-center justify-center rounded-lg h-10 px-4 bg-[#f3e7e7] dark:bg-[#3d2020] text-[#1b0d0d] dark:text-white text-sm font-bold hover:bg-[#e7cfcf] dark:hover:bg-[#4d2a2a] transition-colors">
            <span class="material-symbols-outlined mr-2 text-lg">edit_calendar</span>
            Update Availability
        </button>
    </div>
    <!-- Tabs Interface -->
    <div class="mt-4">
        <div class="border-b border-[#e7cfcf] dark:border-[#3d2020] px-4 flex gap-8">
            <a class="flex flex-col items-center justify-center border-b-[3px] border-primary text-primary pb-3 pt-4"
                href="#">
                <p class="text-sm font-bold tracking-[0.015em]">My Blood Donations</p>
            </a>

        </div>
    </div>
    <!-- Content List (Donations) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-8">
        @foreach ($bloods as $blood)
            <!-- Donation Card 1 -->
            <div class="flex flex-col @container">
                <div
                    class="flex items-stretch justify-between gap-4 rounded-xl bg-white dark:bg-[#2d1616] p-5 shadow-sm border border-[#f3e7e7] dark:border-[#3d2020]">
                    <div class="flex flex-[2_2_0px] flex-col justify-between">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center gap-2">
                                <span class="size-2 rounded-full bg-green-500"></span>
                                <p class="text-green-600 dark:text-green-400 text-xs font-bold uppercase">
                                    Approved</p>
                            </div>
                            <h3 class="text-[#1b0d0d] dark:text-white text-xl font-bold">{{ $blood->blood_group }} |
                                {{ $blood->units }} Unit
                            </h3>
                            <p class="text-[#9a4c4c] dark:text-[#cc8e8e] text-sm font-medium flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">calendar_today</span>
                                {{ $blood->created_at }}
                            </p>
                            <p class="text-[#9a4c4c] dark:text-[#cc8e8e] text-sm font-medium flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">location_city</span>
                                {{ $blood->hospital_name }}
                            </p>
                        </div>
                        <button
                            class="flex items-center justify-center rounded-lg h-9 px-4 bg-[#f3e7e7] dark:bg-[#3d2020] text-[#1b0d0d] dark:text-white text-sm font-semibold w-fit mt-4 hover:bg-[#e7cfcf] transition-colors">
                            View Details
                        </button>
                    </div>
                    <div class="w-32 h-auto bg-center bg-no-repeat bg-cover rounded-lg"
                        data-alt="Abstract red and white medical pattern"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDGCawZemH7uvkckve0iY2g3RNBTJbLD4uZNPdX_zzIFDDN-B-C56bfgW4O_bgZQdA-aU3wjq4a-xiZXjefkIm0AtG6Yr-U83vGPPT-IE-ymUES-66Mv89pXOK7Dnpb_NDjH_JsiitwGiP0NQpL_sq2wyQ83mGVmBDHjoA7_tiw-_oJoiIzoE5BNqpiDvZ3doa9_TMcHmi_OacuQWa0uHDrUSuc135HalYmJq6ybQV_dzjhqTnBMqjqUu33q5-THMDL5zn0O6joNQ");'>
                    </div>
                </div>
            </div>

        @endforeach

    </div>
    <!-- Example of Request Cards (Hidden for 'My Donations' view but included for structure) -->
    <div class="hidden grid grid-cols-1 md:grid-cols-2 gap-6 py-4">
        <div class="flex flex-col @container">
            <div
                class="flex items-stretch justify-between gap-4 rounded-xl bg-white dark:bg-[#2d1616] p-5 shadow-sm border border-[#f3e7e7] dark:border-[#3d2020]">
                <div class="flex flex-col flex-1 gap-2">
                    <div class="flex justify-between items-center">
                        <p class="text-primary font-bold text-xs uppercase flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">warning</span> Emergency
                        </p>
                        <span class="text-[#9a4c4c] dark:text-[#cc8e8e] text-xs">Today, 2:30 PM</span>
                    </div>
                    <h3 class="text-[#1b0d0d] dark:text-white text-lg font-bold">Patient: Sarah Jenkins
                    </h3>
                    <p class="text-[#1b0d0d] dark:text-white font-medium text-sm">Required: A- (2 Units)
                    </p>
                    <p class="text-[#9a4c4c] dark:text-[#cc8e8e] text-sm flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">apartment</span> Dell Seton
                        Medical Center
                    </p>
                    <div class="flex gap-2 mt-4">
                        <button class="bg-primary text-white text-xs font-bold px-4 py-2 rounded-lg">Fulfill
                            Request</button>
                        <button
                            class="bg-[#f3e7e7] dark:bg-[#3d2020] text-[#1b0d0d] dark:text-white text-xs font-bold px-4 py-2 rounded-lg">Share</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>