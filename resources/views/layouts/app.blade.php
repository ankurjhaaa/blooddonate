<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>BloodLink - Donate Blood, Save Lives</title>
    <link href="src/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
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
                        "background-dark": "#221010",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>



    @livewireStyles
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-[#181111] dark:text-white transition-colors duration-300">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <!-- Navigation -->
            <header
                class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e6dbdb] dark:border-b-[#3d2424] px-20 py-3 bg-white dark:bg-[#1a0c0c] sticky top-0 z-50">
                <div class="flex items-center gap-2">
                    <div class="size-9 text-primary">
                        <span class="material-symbols-outlined  text-3xl">bloodtype</span>
                    </div>
                    <a href="{{ route('home') }}"
                        class="text-[#181111] dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">
                        BloodLink</a>
                </div>
                <div class="flex flex-1 justify-end gap-8">
                    <nav class="hidden md:flex items-center gap-9">

                        <a class="text-[#181111] dark:text-white text-sm font-medium hover:text-primary transition-colors"
                            href="{{ route('finddoner') }}">Find Donar</a>

                        @auth
                            <a class="text-[#181111] dark:text-white text-sm font-medium hover:text-primary transition-colors"
                                href="{{ route('donateblood') }}">Donate now
                            </a>
                            <a class="text-[#181111] dark:text-white text-sm font-medium hover:text-primary transition-colors"
                                href="{{ route('profile') }}">Profile</a>
                        @endauth
                    </nav>
                    <div class="flex gap-2">
                        @auth
                            <a href="{{ route('logout') }}"
                                class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-all">
                                <span>Logout</span>
                            </a>
                        @else
                            <div class="flex gap-2">
                                <a href="{{ route('register') }}"
                                    class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-all">
                                    <span>Sign Up</span>
                                </a>
                                <a href="{{ route('login') }}"
                                    class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-[#f4f0f0] dark:bg-[#3d2424] text-[#181111] dark:text-white text-sm font-bold hover:bg-[#e6dbdb] dark:hover:bg-[#4d3030] transition-all">
                                    <span>Login</span>
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </header>
            <main class="flex flex-col items-center">
                {{ $slot }}

            </main>
            <!-- Footer -->
            <footer class="w-full bg-[#1a0c0c] text-white py-16 px-[5%] mt-10">
                <div class="max-w-[1200px] mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div class="col-span-1 md:col-span-1">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="material-symbols-outlined text-primary text-3xl">bloodtype</span>
                            <span class="text-2xl font-bold">BloodLink</span>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Empowering communities through seamless blood donation management. Every drop counts.
                        </p>
                    </div>
                    <div>
                        <h5 class="font-bold mb-6">Quick Links</h5>
                        <ul class="space-y-4 text-gray-400 text-sm">
                            <li><a class="hover:text-primary transition-colors" href="#">Find Donor</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Blood Banks</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Emergency Request</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">NGO Partnership</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-bold mb-6">Support</h5>
                        <ul class="space-y-4 text-gray-400 text-sm">
                            <li><a class="hover:text-primary transition-colors" href="#">Help Center</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Privacy Policy</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Terms of Service</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-bold mb-6">Stay Updated</h5>
                        <div class="flex gap-2">
                            <input
                                class="bg-[#221010] border border-[#3d2424] rounded-lg px-4 py-2 w-full text-sm focus:outline-none focus:border-primary"
                                placeholder="Email address" type="email" />
                            <button
                                class="bg-primary px-4 py-2 rounded-lg font-bold hover:bg-primary/90 transition-all">Join</button>
                        </div>
                    </div>
                </div>
                <div
                    class="max-w-[1200px] mx-auto border-t border-[#3d2424] mt-12 pt-8 text-center text-gray-500 text-xs">
                    © 2024 BloodLink Management System. All rights reserved.
                </div>
            </footer>
        </div>
    </div>
    @livewireScripts
</body>



</html>