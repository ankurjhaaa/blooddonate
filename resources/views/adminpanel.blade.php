<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>NGO Request Management - LifeStream</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ec1313",
                        "background-light": "#f8f6f6",
                        "background-dark": "#1a0a0a",
                    },
                    fontFamily: {
                        "display": ["Lexend"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Lexend', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#1b0d0d] dark:text-white min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 border-r border-[#e7cfcf] dark:border-[#3d2020] bg-white dark:bg-[#2a1515] flex flex-col">
            <div class="p-6 flex items-center gap-3 text-primary">
                <div class="size-8">
                    <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd"
                            d="M47.2426 24L24 47.2426L0.757355 24L24 0.757355L47.2426 24ZM12.2426 21H35.7574L24 9.24264L12.2426 21Z"
                            fill="currentColor" fill-rule="evenodd"></path>
                    </svg>
                </div>
                <h1 class="text-lg font-bold text-[#1b0d0d] dark:text-white leading-tight">LifeStream NGO</h1>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-[#f3e7e7] dark:bg-[#321a1a] text-primary font-bold"
                    href="#">
                    <span class="material-symbols-outlined">pending_actions</span>
                    <span class="text-sm">Pending Requests</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#9a4c4c] dark:text-[#cc8a8a] hover:bg-[#f3e7e7] dark:hover:bg-[#321a1a] transition-colors"
                    href="#">
                    <span class="material-symbols-outlined">volunteer_activism</span>
                    <span class="text-sm">Active Donations</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#9a4c4c] dark:text-[#cc8a8a] hover:bg-[#f3e7e7] dark:hover:bg-[#321a1a] transition-colors"
                    href="#">
                    <span class="material-symbols-outlined">task_alt</span>
                    <span class="text-sm">Fulfilled</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#9a4c4c] dark:text-[#cc8a8a] hover:bg-[#f3e7e7] dark:hover:bg-[#321a1a] transition-colors"
                    href="#">
                    <span class="material-symbols-outlined">hub</span>
                    <span class="text-sm">Donor Network</span>
                </a>
                <div class="pt-8 pb-2 px-4 text-[10px] font-bold uppercase tracking-widest text-[#9a4c4c]/50">
                    Administration</div>
                <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#9a4c4c] dark:text-[#cc8a8a] hover:bg-[#f3e7e7] dark:hover:bg-[#321a1a] transition-colors"
                    href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="text-sm">Settings</span>
                </a>
            </nav>
            <div class="p-4 border-t border-[#e7cfcf] dark:border-[#3d2020]">
                <div class="flex items-center gap-3 p-2">
                    <div class="size-10 rounded-full bg-cover bg-center border border-[#e7cfcf] dark:border-[#3d2020]"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAUuBUqU-rXlLhDdc1dQJX-eutuklvsA2c4yAGqnzMMQLEZZvt7o0bs9QO44ITxf7mTCtVCkglVqkmHAOAe8yRNdPJgH5cXPArwkbSjcwWbnbsTMpgwDlGXgX1CQzlduIUSFfvMxGlYhKKS-Ptmqdxxnalxed-dS10YYpPocBRJfINeMVgAMjRwQsXQZ8FncKVj_EdiiFsqu5FS21z4wEFwJDlo-KUlNhPVC8vGzVVORuL2oFBiJttLsQOKpxbuP8tJcOdXGEgwjQ");'>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm font-bold truncate">Sarah Jenkins</p>
                        <p class="text-[10px] text-[#9a4c4c] uppercase font-bold">NGO Coordinator</p>
                    </div>
                </div>
            </div>
        </aside>
        <div class="flex-1 flex flex-col overflow-hidden">
            <header
                class="h-16 border-b border-[#e7cfcf] dark:border-[#3d2020] bg-white dark:bg-[#2a1515] flex items-center justify-between px-8 shrink-0">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold tracking-tight">Request Management</h2>
                    <span class="px-2 py-0.5 rounded bg-primary/10 text-primary text-[10px] font-bold uppercase">Admin
                        View</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <span
                            class="material-symbols-outlined text-[#9a4c4c] p-2 rounded-full hover:bg-background-light dark:hover:bg-background-dark cursor-pointer">notifications</span>
                        <span
                            class="absolute top-2 right-2 size-2 bg-primary rounded-full border-2 border-white dark:border-[#2a1515]"></span>
                    </div>
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-bold hover:bg-primary/90 transition-all shadow-sm">
                        <span class="material-symbols-outlined text-sm">add</span>
                        Manual Entry
                    </button>
                </div>
            </header>
            <main class="flex-1 overflow-y-auto p-8 bg-background-light dark:bg-background-dark">
                <div class="max-w-6xl mx-auto">
                    <div class="mb-8">
                        <h1 class="text-3xl font-black text-[#1b0d0d] dark:text-white tracking-tight">Incoming User
                            Requests</h1>
                        <p class="text-[#9a4c4c] dark:text-[#cc8a8a] mt-1">High-priority worklist for immediate donor
                            matching and medical validation.</p>
                    </div>
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                        <div class="flex items-center gap-2">
                            <button
                                class="px-4 py-1.5 rounded-full bg-white dark:bg-[#2a1515] border border-primary text-primary text-sm font-bold">All
                                Requests (24)</button>
                            <button
                                class="px-4 py-1.5 rounded-full bg-transparent border border-[#e7cfcf] dark:border-[#3d2020] text-[#9a4c4c] text-sm font-medium hover:bg-white dark:hover:bg-[#2a1515]">Critical
                                (8)</button>
                            <button
                                class="px-4 py-1.5 rounded-full bg-transparent border border-[#e7cfcf] dark:border-[#3d2020] text-[#9a4c4c] text-sm font-medium hover:bg-white dark:hover:bg-[#2a1515]">Routine
                                (16)</button>
                        </div>
                        <div class="flex items-center gap-2">
                            <label class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#9a4c4c] text-xl leading-none">search</span>
                                <input
                                    class="pl-10 pr-4 py-2 rounded-lg border-none bg-white dark:bg-[#2a1515] text-sm focus:ring-1 focus:ring-primary w-64 shadow-sm"
                                    placeholder="Search patient or hospital..." type="text" />
                            </label>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-[#2a1515] rounded-xl border border-[#e7cfcf] dark:border-[#3d2020] shadow-sm overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-[#f3e7e7]/30 dark:bg-[#321a1a]/30 border-b border-[#e7cfcf] dark:border-[#3d2020]">
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#9a4c4c]">
                                        Blood Type</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#9a4c4c]">
                                        Patient Information</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#9a4c4c]">
                                        Urgency</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#9a4c4c]">
                                        Location</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#9a4c4c]">Time
                                        Elapsed</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-[#9a4c4c] text-right">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e7cfcf] dark:divide-[#3d2020]">
                                <tr
                                    class="hover:bg-background-light/30 dark:hover:bg-background-dark/30 transition-colors">
                                    <td class="px-6 py-5">
                                        <div
                                            class="size-12 rounded-lg bg-red-50 dark:bg-red-950/30 flex items-center justify-center border border-red-100 dark:border-red-900/50">
                                            <span class="text-xl font-black text-primary">O-</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm font-bold text-[#1b0d0d] dark:text-white">Marcus Thornton</p>
                                        <p class="text-xs text-[#9a4c4c]">ID: #RQ-9421 • 2 Units Req.</p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400">
                                            High Priority
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm text-[#1b0d0d] dark:text-white">St. Mary's Hospital</p>
                                        <p class="text-xs text-[#9a4c4c]">Emergency Wing</p>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-medium text-primary">
                                        12 mins ago
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                class="px-3 py-1.5 rounded-lg border border-[#e7cfcf] dark:border-[#3d2020] text-xs font-bold text-[#1b0d0d] dark:text-white hover:bg-[#f3e7e7] dark:hover:bg-[#321a1a] flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">visibility</span>
                                                Docs
                                            </button>
                                            <button
                                                class="px-3 py-1.5 rounded-lg border border-red-200 text-red-600 text-xs font-bold hover:bg-red-50 transition-colors">Reject</button>
                                            <button
                                                class="px-4 py-1.5 rounded-lg bg-green-600 text-white text-xs font-bold hover:bg-green-700 transition-all shadow-sm">Accept
                                                Request</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr
                                    class="hover:bg-background-light/30 dark:hover:bg-background-dark/30 transition-colors">
                                    <td class="px-6 py-5">
                                        <div
                                            class="size-12 rounded-lg bg-gray-50 dark:bg-gray-800/30 flex items-center justify-center border border-gray-100 dark:border-gray-800">
                                            <span class="text-xl font-black text-[#1b0d0d] dark:text-white">A+</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm font-bold text-[#1b0d0d] dark:text-white">Elena Rodriguez</p>
                                        <p class="text-xs text-[#9a4c4c]">ID: #RQ-9418 • 1 Unit Req.</p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-700 dark:bg-orange-900/40 dark:text-orange-400">
                                            Medium
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm text-[#1b0d0d] dark:text-white">City Central Clinic</p>
                                        <p class="text-xs text-[#9a4c4c]">General Ward</p>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-medium text-[#1b0d0d] dark:text-white">
                                        45 mins ago
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                class="px-3 py-1.5 rounded-lg border border-[#e7cfcf] dark:border-[#3d2020] text-xs font-bold text-[#1b0d0d] dark:text-white hover:bg-[#f3e7e7] dark:hover:bg-[#321a1a] flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">visibility</span>
                                                Docs
                                            </button>
                                            <button
                                                class="px-3 py-1.5 rounded-lg border border-red-200 text-red-600 text-xs font-bold hover:bg-red-50">Reject</button>
                                            <button
                                                class="px-4 py-1.5 rounded-lg bg-green-600 text-white text-xs font-bold hover:bg-green-700 shadow-sm">Accept
                                                Request</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr
                                    class="hover:bg-background-light/30 dark:hover:bg-background-dark/30 transition-colors">
                                    <td class="px-6 py-5">
                                        <div
                                            class="size-12 rounded-lg bg-red-50 dark:bg-red-950/30 flex items-center justify-center border border-red-100 dark:border-red-900/50">
                                            <span class="text-xl font-black text-primary">B-</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm font-bold text-[#1b0d0d] dark:text-white">Samuel Lee</p>
                                        <p class="text-xs text-[#9a4c4c]">ID: #RQ-9415 • 3 Units Req.</p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400">
                                            High Priority
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm text-[#1b0d0d] dark:text-white">Northern Surgical Inst.</p>
                                        <p class="text-xs text-[#9a4c4c]">Surgery Dept</p>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-medium text-primary">
                                        1h 04m ago
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                class="px-3 py-1.5 rounded-lg border border-[#e7cfcf] dark:border-[#3d2020] text-xs font-bold text-[#1b0d0d] dark:text-white hover:bg-[#f3e7e7] dark:hover:bg-[#321a1a] flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">visibility</span>
                                                Docs
                                            </button>
                                            <button
                                                class="px-3 py-1.5 rounded-lg border border-red-200 text-red-600 text-xs font-bold hover:bg-red-50">Reject</button>
                                            <button
                                                class="px-4 py-1.5 rounded-lg bg-green-600 text-white text-xs font-bold hover:bg-green-700 shadow-sm">Accept
                                                Request</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr
                                    class="hover:bg-background-light/30 dark:hover:bg-background-dark/30 transition-colors">
                                    <td class="px-6 py-5">
                                        <div
                                            class="size-12 rounded-lg bg-gray-50 dark:bg-gray-800/30 flex items-center justify-center border border-gray-100 dark:border-gray-800">
                                            <span class="text-xl font-black text-[#1b0d0d] dark:text-white">AB-</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm font-bold text-[#1b0d0d] dark:text-white">Johnathan Rivers</p>
                                        <p class="text-xs text-[#9a4c4c]">ID: #RQ-9399 • 1 Unit Req.</p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                            Low
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <p class="text-sm text-[#1b0d0d] dark:text-white">Mercy Rehab Center</p>
                                        <p class="text-xs text-[#9a4c4c]">Internal Medicine</p>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-medium text-[#1b0d0d] dark:text-white">
                                        3h 22m ago
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                class="px-3 py-1.5 rounded-lg border border-[#e7cfcf] dark:border-[#3d2020] text-xs font-bold text-[#1b0d0d] dark:text-white hover:bg-[#f3e7e7] dark:hover:bg-[#321a1a] flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">visibility</span>
                                                Docs
                                            </button>
                                            <button
                                                class="px-3 py-1.5 rounded-lg border border-red-200 text-red-600 text-xs font-bold hover:bg-red-50">Reject</button>
                                            <button
                                                class="px-4 py-1.5 rounded-lg bg-green-600 text-white text-xs font-bold hover:bg-green-700 shadow-sm">Accept
                                                Request</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="flex items-center justify-between px-6 py-4 bg-gray-50/50 dark:bg-[#321a1a]/20 border-t border-[#e7cfcf] dark:border-[#3d2020]">
                            <p class="text-xs text-[#9a4c4c] font-medium">Displaying 4 of 24 active requests</p>
                            <div class="flex items-center gap-1">
                                <button
                                    class="p-1 rounded hover:bg-white dark:hover:bg-[#2a1515] transition-colors"><span
                                        class="material-symbols-outlined text-sm">chevron_left</span></button>
                                <span class="px-3 py-1 text-xs font-bold bg-primary text-white rounded">1</span>
                                <span
                                    class="px-3 py-1 text-xs font-bold hover:bg-white dark:hover:bg-[#2a1515] rounded cursor-pointer">2</span>
                                <span
                                    class="px-3 py-1 text-xs font-bold hover:bg-white dark:hover:bg-[#2a1515] rounded cursor-pointer">3</span>
                                <button
                                    class="p-1 rounded hover:bg-white dark:hover:bg-[#2a1515] transition-colors"><span
                                        class="material-symbols-outlined text-sm">chevron_right</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 p-6 bg-primary/5 rounded-xl border border-primary/10 flex items-start gap-4">
                        <div class="p-2 rounded-lg bg-primary/10 text-primary">
                            <span class="material-symbols-outlined">info</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-primary uppercase tracking-wider">Workflow Note</h4>
                            <p class="text-sm text-[#1b0d0d] dark:text-white mt-1">Accepted requests are automatically
                                moved to the <span class="font-bold">In Progress</span> queue. You will be prompted to
                                match specific donors from the network once medical documentation is verified by the
                                medical officer on duty.</p>
                        </div>
                    </div>
                </div>
            </main>
            <footer
                class="h-10 px-8 border-t border-[#e7cfcf] dark:border-[#3d2020] bg-white dark:bg-[#2a1515] flex items-center justify-between shrink-0">
                <p class="text-[10px] text-[#9a4c4c] font-medium uppercase tracking-widest">LifeStream NGO Admin Portal
                    • v2.8.5</p>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1.5">
                        <span class="size-1.5 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-[10px] text-[#9a4c4c] font-bold uppercase">System Online</span>
                    </div>
                    <p class="text-[10px] text-[#9a4c4c] font-medium uppercase tracking-widest">© 2024 Secure NGO Access
                    </p>
                </div>
            </footer>
        </div>
    </div>

</body>

</html>