<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - KeeTech Sovereign IT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-surface text-on-surface antialiased transition-colors duration-500 font-sans tracking-tight">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebarOverlay"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[45] lg:hidden hidden transition-opacity"
        onclick="toggleSidebar()"></div>

    <!-- SideNavBar Shell -->
    <aside id="sidebar"
        class="fixed left-0 top-0 h-full w-64 flex flex-col p-6 bg-stone-50 dark:bg-slate-950 border-r border-[#e0bfbf]/20 z-50 shadow-2xl shadow-[#1a1a2e]/5 -translate-x-full lg:translate-x-0 transition-transform duration-500">
        <div class="flex justify-between items-center mb-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary-container flex items-center justify-center shadow-lg">
                    <span class="material-symbols-outlined text-secondary-container"
                        style="font-variation-settings: 'FILL' 1;">security</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold tracking-tighter text-[#800020] dark:text-[#fed65b]">KeeTech</h1>
                    <p class="text-[10px] uppercase tracking-[0.2em] font-extrabold text-on-surface-variant opacity-60">
                        Sovereign IT</p>
                </div>
            </div>
            <button onclick="toggleSidebar()" class="lg:hidden text-on-surface-variant">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <nav class="flex-1 space-y-2 overflow-y-auto custom-scrollbar pr-2">
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-[#800020] text-white rounded-xl shadow-lg' : 'text-stone-600 dark:text-stone-400 hover:bg-[#800020]/10 hover:text-[#800020] rounded-xl' }} transition-all duration-300"
                href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                <span class="font-semibold">Dashboard</span>
            </a>

            <p class="px-4 text-[10px] font-extrabold text-on-surface-variant/50 uppercase tracking-widest mt-6 mb-2">
                Ecosystem</p>
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.services.*') ? 'bg-[#800020] text-white rounded-xl shadow-lg' : 'text-stone-600 dark:text-stone-400 hover:bg-[#800020]/10 hover:text-[#800020] rounded-xl' }} transition-all duration-300"
                href="{{ route('admin.services.index') }}">
                <span class="material-symbols-outlined" data-icon="settings_suggest">settings_suggest</span>
                <span class="font-semibold">Layanan</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.portfolio-categories.*') ? 'bg-[#800020] text-white rounded-xl shadow-lg' : 'text-stone-600 dark:text-stone-400 hover:bg-[#800020]/10 hover:text-[#800020] rounded-xl' }} transition-all duration-300"
                href="{{ route('admin.portfolio-categories.index') }}">
                <span class="material-symbols-outlined" data-icon="category">category</span>
                <span class="font-semibold">Kategori Proyek</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.portfolios.*') ? 'bg-[#800020] text-white rounded-xl shadow-lg' : 'text-stone-600 dark:text-stone-400 hover:bg-[#800020]/10 hover:text-[#800020] rounded-xl' }} transition-all duration-300"
                href="{{ route('admin.portfolios.index') }}">
                <span class="material-symbols-outlined" data-icon="auto_awesome">auto_awesome</span>
                <span class="font-semibold">Portofolio</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.testimonials.*') ? 'bg-[#800020] text-white rounded-xl shadow-lg' : 'text-stone-600 dark:text-stone-400 hover:bg-[#800020]/10 hover:text-[#800020] rounded-xl' }} transition-all duration-300"
                href="{{ route('admin.testimonials.index') }}">
                <span class="material-symbols-outlined" data-icon="chat">chat</span>
                <span class="font-semibold">Testimoni</span>
            </a>

            <p class="px-4 text-[10px] font-extrabold text-on-surface-variant/50 uppercase tracking-widest mt-6 mb-2">
                Ops</p>
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.contacts.*') ? 'bg-[#800020] text-white rounded-xl shadow-lg' : 'text-stone-600 dark:text-stone-400 hover:bg-[#800020]/10 hover:text-[#800020] rounded-xl' }} transition-all duration-300 relative"
                href="{{ route('admin.contacts.index') }}">
                <span class="material-symbols-outlined" data-icon="mail">mail</span>
                <span class="font-semibold">Pesan/Kontak</span>
                <span class="absolute right-4 w-2 h-2 bg-secondary-container rounded-full"></span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.settings.*') ? 'bg-[#800020] text-white rounded-xl shadow-lg' : 'text-stone-600 dark:text-stone-400 hover:bg-[#800020]/10 hover:text-[#800020] rounded-xl' }} transition-all duration-300"
                href="{{ route('admin.settings.index') }}">
                <span class="material-symbols-outlined" data-icon="settings">settings</span>
                <span class="font-semibold">Pengaturan</span>
            </a>
        </nav>

    </aside>

    <!-- TopNavBar Shell -->
    <header
        class="sticky top-0 z-40 lg:ml-64 flex items-center justify-between px-6 lg:px-10 h-20 bg-white dark:bg-slate-950 border-b border-outline-variant/10 shadow-sm transition-all duration-300">

        <!-- Left: Branding/Search Toggle -->
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()"
                class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-stone-100 dark:bg-white/5 text-on-surface">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="relative hidden sm:block">
                <span
                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant/40 text-xl">search</span>
                <input type="text" placeholder="Search resources..."
                    class="bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-2xl pl-12 pr-6 py-2.5 text-sm w-64 lg:w-80 focus:ring-2 focus:ring-primary/20 focus:border-primary/30 outline-none transition-all font-medium">
            </div>
        </div>

        <!-- Right: Actions & User -->
        <div class="flex items-center gap-4 lg:gap-8">

            <div class="flex items-center gap-2">
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-xl text-on-surface-variant hover:bg-stone-100 dark:hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                <button onclick="toggleTheme()"
                    class="w-10 h-10 flex items-center justify-center rounded-xl text-on-surface-variant hover:bg-stone-100 dark:hover:bg-white/10 transition-colors">
                    <span id="theme-icon" class="material-symbols-outlined">dark_mode</span>
                </button>
            </div>

            <div class="h-8 w-px bg-outline-variant/20 hidden sm:block"></div>

            <!-- User Profile Block -->
            <div class="relative">
                <div id="profileTrigger"
                    class="flex items-center gap-4 p-2 px-3 rounded-[20px] bg-[#f5f2ff] dark:bg-primary/10 border border-[#e8e4ff] dark:border-primary/20 cursor-pointer hover:shadow-md transition-all">
                    <!-- Avatar Image/Letter Box -->
                    <div
                        class="w-10 h-10 rounded-[14px] bg-[#fdfcff] dark:bg-white/10 flex items-center justify-center shadow-inner">
                        <span
                            class="text-[#1a1a2e] dark:text-white font-black text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>

                    <!-- Name & Subtitle -->
                    <div class="hidden md:block">
                        <h4 class="text-sm font-black text-[#1a1a2e] dark:text-white leading-tight">
                            {{ auth()->user()->name }}</h4>
                        <p class="text-[10px] text-[#1a1a2e]/60 dark:text-primary font-bold uppercase tracking-wider">
                            Administrator</p>
                    </div>

                    <!-- Dropdown Arrow -->
                    <span class="material-symbols-outlined text-stone-400 text-lg hidden md:block">expand_more</span>
                </div>

                <!-- Dropdown Menu -->
                <div id="profileDropdown"
                    class="absolute right-0 mt-3 w-56 bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-outline-variant/10 opacity-0 invisible translate-y-2 transition-all duration-200 transform origin-top-right scale-95 z-50 overflow-hidden">
                    <div class="p-2">
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-stone-50 dark:hover:bg-white/5 rounded-2xl transition-colors font-bold text-sm">
                            <span class="material-symbols-outlined text-xl">person</span> Profile
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-stone-50 dark:hover:bg-white/5 rounded-2xl transition-colors font-bold text-sm">
                            <span class="material-symbols-outlined text-xl">settings</span> Settings
                        </a>
                        <div class="h-px bg-outline-variant/10 my-1 mx-2"></div>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-3 text-error hover:bg-error/5 rounded-2xl transition-colors font-bold text-sm">
                                <span class="material-symbols-outlined text-xl text-error">logout</span> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="lg:ml-64 p-6 lg:p-8 min-h-[calc(100vh-73px)] flex flex-col relative overflow-hidden">

        <!-- Flash Messages -->
        @if(session('success') || session('error') || $errors->any())
            <div class="fixed top-20 right-8 z-[100] flex flex-col gap-4 animate-in slide-in-from-right-10 duration-500">
                @if(session('success'))
                    <div
                        class="bg-surface-container-highest border border-green-500/20 px-6 py-4 rounded-2xl flex items-center gap-4 shadow-xl">
                        <div class="w-8 h-8 rounded-full bg-green-500/10 flex items-center justify-center text-green-600">
                            <span class="material-symbols-outlined text-sm">check_circle</span>
                        </div>
                        <p class="text-xs font-bold text-on-surface uppercase tracking-widest">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error') || $errors->any())
                    <div
                        class="bg-surface-container-highest border border-error/20 px-6 py-4 rounded-2xl flex items-center gap-4 shadow-xl">
                        <div class="w-8 h-8 rounded-full bg-error/10 flex items-center justify-center text-error">
                            <span class="material-symbols-outlined text-sm">error</span>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-xs font-bold text-error uppercase tracking-widest">
                                {{ session('error') ?? 'Validation Protocol Failure' }}</p>
                            @if($errors->any())
                                <ul class="mt-1">
                                    @foreach($errors->all() as $error)
                                        <li class="text-[10px] font-bold text-error/70 tracking-tight">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <div class="flex-1">
            @yield('content')
        </div>

        <!-- Footer Visual Hint -->
        <footer
            class="mt-12 pt-8 border-t border-outline-variant/10 flex flex-col sm:flex-row justify-between items-center opacity-60 gap-4">
            <p class="text-xs font-extrabold uppercase tracking-widest text-on-surface-variant">© {{ date('Y') }}
                KeeTech Admin Systems</p>
            <div class="flex gap-4">
                <span
                    class="text-[10px] font-bold text-on-surface-variant hover:text-primary cursor-pointer transition-colors">Privacy
                    Policy</span>
                <span
                    class="text-[10px] font-bold text-on-surface-variant hover:text-primary cursor-pointer transition-colors">Terms
                    of Sovereign Service</span>
            </div>
        </footer>
    </main>

    <!-- Delete Confirmation Modal (Preserved) -->
    <div id="deleteConfirmationModal" class="fixed inset-0 z-[200] flex items-center justify-center p-6 hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
        <div
            class="relative w-full max-w-md bg-surface-container-lowest rounded-3xl p-10 space-y-8 animate-in zoom-in-95 duration-300 shadow-2xl border border-error/10">
            <div
                class="w-20 h-20 bg-error/10 border border-error/20 rounded-3xl flex items-center justify-center text-error mx-auto shadow-xl shadow-error/10">
                <span class="material-symbols-outlined text-4xl">warning</span>
            </div>
            <div class="text-center space-y-2">
                <h3 class="font-bold text-xl text-on-surface tracking-widest uppercase">System Protocol: Termination
                </h3>
                <p id="deleteModalMessage" class="text-xs text-on-surface-variant font-medium leading-relaxed">Action is
                    irreversible. Confirm record decryption and deletion.</p>
            </div>
            <div class="flex flex-col gap-3">
                <button id="confirmDeleteBtn"
                    class="w-full bg-error text-on-error font-bold py-4 rounded-xl hover:bg-error/90 transition-all shadow-lg uppercase tracking-widest text-[10px]">
                    Execute Deletion
                </button>
                <button onclick="closeDeleteModal()"
                    class="w-full bg-surface-variant text-on-surface font-bold py-4 rounded-xl hover:bg-surface-variant/80 transition-all uppercase tracking-widest text-[10px]">
                    Abort Protocol
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteForm = null;

        function closeDeleteModal() {
            document.getElementById('deleteConfirmationModal').classList.add('hidden');
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('theme-icon');
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                icon.innerText = 'dark_mode';
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                icon.innerText = 'light_mode';
            }
        }

        // Init theme icon
        document.addEventListener('DOMContentLoaded', () => {
            if (!document.documentElement.classList.contains('dark')) {
                document.getElementById('theme-icon').innerText = 'dark_mode';
            } else {
                document.getElementById('theme-icon').innerText = 'light_mode';
            }
        });

        // Profile Dropdown Toggle
        const profileTrigger = document.getElementById('profileTrigger');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileTrigger && profileDropdown) {
            profileTrigger.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('opacity-0');
                profileDropdown.classList.toggle('invisible');
                profileDropdown.classList.toggle('opacity-100');
                profileDropdown.classList.toggle('visible');
                profileDropdown.classList.toggle('translate-y-2');
                profileDropdown.classList.toggle('translate-y-0');
                profileDropdown.classList.toggle('scale-95');
                profileDropdown.classList.toggle('scale-100');
            });

            document.addEventListener('click', (e) => {
                if (!profileDropdown.contains(e.target) && !profileTrigger.contains(e.target)) {
                    profileDropdown.classList.add('opacity-0', 'invisible', 'translate-y-2', 'scale-95');
                    profileDropdown.classList.remove('opacity-100', 'visible', 'translate-y-0', 'scale-100');
                }
            });
        }

        // --- GLOBAL ADMINISTRATIVE ACTION ENGINE ---
        document.addEventListener('click', function (e) {
            const destroyBtn = e.target.closest('[data-destroy]');
            if (!destroyBtn) return;

            e.preventDefault();
            const message = destroyBtn.getAttribute('data-confirm') || 'Terminate this record? Action is irreversible.';
            const formId = destroyBtn.getAttribute('data-form-id');

            if (formId) {
                currentDeleteForm = document.getElementById(formId);
            } else {
                currentDeleteForm = destroyBtn.closest('form');
            }

            if (currentDeleteForm) {
                document.getElementById('deleteModalMessage').innerText = message;
                document.getElementById('deleteConfirmationModal').classList.remove('hidden');
            }
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (currentDeleteForm) {
                this.innerHTML = '<span class="animate-spin material-symbols-outlined">sync</span>';
                this.disabled = true;
                currentDeleteForm.submit();
            }
        });
    </script>
</body>

</html>