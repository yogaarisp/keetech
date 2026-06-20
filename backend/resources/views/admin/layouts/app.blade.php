<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — KeeTech Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg:       #01030D;
            --bg-card:  rgba(255,255,255,0.035);
            --bg-hover: rgba(255,255,255,0.06);
            --border:   rgba(255,255,255,0.07);
            --border-active: rgba(45,212,191,0.4);
            --teal:     #2DD4BF;
            --teal-dim: rgba(45,212,191,0.12);
            --teal-glow:rgba(45,212,191,0.25);
            --emerald:  #34D399;
            --gradient: linear-gradient(90deg, #2DD4BF 0%, #34D399 100%);
            --text:     rgba(255,255,255,0.87);
            --text-dim: rgba(255,255,255,0.45);
            --text-faint: rgba(255,255,255,0.22);
            --red:      #EF4444;
            --red-dim:  rgba(239,68,68,0.12);
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0; padding: 0;
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
        }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--teal-dim); }

        /* ── SIDEBAR ── */
        #sidebar {
            position: fixed; left: 0; top: 0; bottom: 0;
            width: 240px;
            background: rgba(1,3,13,0.92);
            border-right: 1px solid var(--border);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            display: flex; flex-direction: column;
            padding: 0;
            z-index: 50;
            transition: transform 0.4s cubic-bezier(0.22,1,0.36,1);
        }

        .sidebar-header {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }

        .sidebar-logo {
            display: flex; align-items: center; gap: 12px;
        }

        .sidebar-logo-icon {
            width: 34px; height: 34px;
            border-radius: 10px;
            background: var(--gradient);
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; color: var(--bg); font-size: 1rem;
            box-shadow: 0 0 16px var(--teal-glow);
            flex-shrink: 0;
        }

        .sidebar-logo-text { font-size: 1.1rem; font-weight: 800; color: #fff; letter-spacing: -0.02em; }
        .sidebar-logo-sub  { font-size: 9px; font-weight: 600; letter-spacing: 0.18em; color: var(--teal); text-transform: uppercase; }

        .sidebar-nav { flex: 1; overflow-y: auto; padding: 16px 12px; }

        .nav-section-label {
            font-size: 9px; font-weight: 700; letter-spacing: 0.2em;
            text-transform: uppercase; color: var(--text-faint);
            padding: 16px 10px 8px;
        }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 13px; font-weight: 600;
            color: var(--text-dim);
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 2px;
            position: relative;
        }

        .nav-item:hover {
            color: #fff;
            background: var(--bg-hover);
        }

        .nav-item.active {
            color: #fff;
            background: var(--teal-dim);
            border: 1px solid var(--border-active);
        }

        .nav-item.active .material-symbols-outlined { color: var(--teal); }

        .nav-item .material-symbols-outlined { font-size: 18px; flex-shrink: 0; }

        .nav-badge {
            margin-left: auto;
            width: 7px; height: 7px;
            border-radius: 99px;
            background: var(--teal);
            box-shadow: 0 0 8px var(--teal-glow);
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border);
        }

        /* ── TOPBAR ── */
        #topbar {
            position: sticky; top: 0; z-index: 40;
            height: 64px;
            background: rgba(1,3,13,0.88);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            display: flex; align-items: center;
            padding: 0 28px;
            gap: 16px;
        }

        .topbar-search {
            flex: 1; max-width: 280px;
            position: relative;
        }

        .topbar-search input {
            width: 100%; background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 14px 8px 38px;
            font-size: 13px; color: var(--text);
            outline: none;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s;
        }

        .topbar-search input:focus { border-color: var(--teal); }
        .topbar-search input::placeholder { color: var(--text-faint); }

        .topbar-search .search-icon {
            position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
            color: var(--text-faint); font-size: 17px;
        }

        .topbar-right { margin-left: auto; display: flex; align-items: center; gap: 8px; }

        .icon-btn {
            width: 36px; height: 36px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--bg-card);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.2s;
            color: var(--text-dim);
        }

        .icon-btn:hover { background: var(--bg-hover); color: #fff; border-color: rgba(255,255,255,0.15); }
        .icon-btn .material-symbols-outlined { font-size: 18px; }

        .user-pill {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 12px 6px 6px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: var(--bg-card);
            cursor: pointer;
            transition: all 0.2s;
        }

        .user-pill:hover { border-color: rgba(255,255,255,0.15); background: var(--bg-hover); }

        .user-avatar {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: var(--gradient);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem; font-weight: 800;
            color: var(--bg);
        }

        .user-name  { font-size: 13px; font-weight: 700; color: #fff; }
        .user-role  { font-size: 10px; color: var(--teal); font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; }

        /* ── LAYOUT SHELL ── */
        .admin-shell {
            display: flex; min-height: 100vh;
        }

        .sidebar-spacer { width: 240px; flex-shrink: 0; }

        .main-area {
            flex: 1; min-width: 0;
            display: flex; flex-direction: column;
        }

        .main-content {
            flex: 1;
            padding: 28px 28px 40px;
        }

        /* ── CARDS ── */
        .admin-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        /* ── FLASH TOAST ── */
        .toast-wrap {
            position: fixed; top: 76px; right: 24px;
            z-index: 200; display: flex; flex-direction: column; gap: 10px;
            pointer-events: none;
        }

        .toast {
            display: flex; align-items: center; gap: 12px;
            padding: 14px 18px;
            border-radius: 12px;
            background: rgba(1,3,13,0.95);
            border: 1px solid var(--border);
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
            animation: slideIn 0.4s cubic-bezier(0.22,1,0.36,1);
            pointer-events: all;
        }

        .toast.success { border-color: rgba(52,211,153,0.35); }
        .toast.error   { border-color: rgba(239,68,68,0.35); }

        .toast-icon {
            width: 32px; height: 32px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .toast.success .toast-icon { background: rgba(52,211,153,0.12); color: var(--emerald); }
        .toast.error   .toast-icon { background: var(--red-dim); color: var(--red); }
        .toast-icon .material-symbols-outlined { font-size: 16px; }
        .toast-text { font-size: 13px; font-weight: 600; color: var(--text); }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(24px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        @keyframes spin { 
            to { transform: rotate(360deg); } 
        }

        /* ── DELETE MODAL ── */
        .modal-backdrop {
            position: fixed; inset: 0; z-index: 200;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(8px);
            display: flex; align-items: center; justify-content: center;
            padding: 24px;
        }

        .modal-box {
            width: 100%; max-width: 400px;
            background: rgba(5,10,24,0.98);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 36px 32px;
            text-align: center;
            box-shadow: 0 24px 64px rgba(0,0,0,0.7);
            animation: zoomIn 0.25s cubic-bezier(0.22,1,0.36,1);
        }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.93); }
            to   { opacity: 1; transform: scale(1); }
        }

        .modal-icon {
            width: 64px; height: 64px; border-radius: 16px;
            background: var(--red-dim); border: 1px solid rgba(239,68,68,0.25);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            color: var(--red);
        }

        .modal-icon .material-symbols-outlined { font-size: 32px; }
        .modal-title { font-size: 17px; font-weight: 800; color: #fff; margin-bottom: 8px; }
        .modal-desc  { font-size: 13px; color: var(--text-dim); line-height: 1.6; margin-bottom: 28px; }

        .modal-btns { display: flex; flex-direction: column; gap: 10px; }

        .btn-danger {
            width: 100%; padding: 13px;
            background: var(--red); color: #fff;
            border: none; border-radius: 10px;
            font-size: 13px; font-weight: 700; cursor: pointer;
            transition: all 0.2s;
        }

        .btn-danger:hover { background: #dc2626; }

        .btn-ghost {
            width: 100%; padding: 13px;
            background: var(--bg-card); color: var(--text-dim);
            border: 1px solid var(--border); border-radius: 10px;
            font-size: 13px; font-weight: 600; cursor: pointer;
            transition: all 0.2s;
        }

        .btn-ghost:hover { background: var(--bg-hover); color: #fff; }

        /* ── MOBILE ── */
        #sidebarOverlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.75); backdrop-filter: blur(4px);
            z-index: 45;
        }

        @media (max-width: 1023px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0) !important; }
            #sidebarOverlay.show { display: block !important; }
            .sidebar-spacer { display: none !important; }
        }

        /* ── UTILITY FALLBACKS ── */
        .hidden { display: none !important; }
        @media (min-width: 640px) {
            .sm\:block { display: block !important; }
        }
        @media (min-width: 1024px) {
            .lg\:hidden { display: none !important; }
        }

        /* ── PROFILE DROPDOWN ── */
        #profileDropdown {
            position: absolute; right: 0; top: calc(100% + 8px);
            width: 200px;
            background: rgba(5,10,24,0.98);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 16px 48px rgba(0,0,0,0.6);
            padding: 6px;
            opacity: 0; visibility: hidden; transform: translateY(-6px);
            transition: all 0.2s ease;
            z-index: 100;
        }

        #profileDropdown.show { opacity: 1; visibility: visible; transform: translateY(0); }

        .dropdown-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            border-radius: 9px;
            font-size: 13px; font-weight: 600; color: var(--text-dim);
            text-decoration: none;
            transition: all 0.15s; cursor: pointer;
            background: none; border: none; width: 100%; text-align: left;
        }

        .dropdown-item:hover { background: var(--bg-hover); color: #fff; }
        .dropdown-item.danger:hover { background: var(--red-dim); color: var(--red); }
        .dropdown-item .material-symbols-outlined { font-size: 17px; }
        .dropdown-divider { height: 1px; background: var(--border); margin: 4px 6px; }

        /* ── FORMS (global override) ── */
        .admin-input {
            width: 100%;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px; color: var(--text);
            font-family: 'Inter', sans-serif;
            outline: none; transition: border-color 0.2s;
        }
        .admin-input:focus { border-color: var(--teal); }
        .admin-input::placeholder { color: var(--text-faint); }

        .admin-label {
            display: block; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.12em;
            color: var(--text-dim); margin-bottom: 6px;
        }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(90deg, #2DD4BF, #34D399);
            color: var(--bg); border: none; border-radius: 10px;
            font-size: 13px; font-weight: 700;
            cursor: pointer; transition: all 0.2s;
            text-decoration: none;
            box-shadow: 0 0 20px rgba(45,212,191,0.25);
        }

        .btn-primary:hover { box-shadow: 0 0 28px rgba(45,212,191,0.4); transform: translateY(-1px); }

        .btn-secondary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px;
            background: var(--bg-card); color: var(--text-dim);
            border: 1px solid var(--border); border-radius: 10px;
            font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            text-decoration: none;
        }

        .btn-secondary:hover { background: var(--bg-hover); color: #fff; border-color: rgba(255,255,255,0.15); }

        /* ── TABLE ── */
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th {
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.14em;
            color: var(--text-faint);
            padding: 12px 16px; text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .admin-table td {
            padding: 14px 16px;
            font-size: 13px; color: var(--text-dim);
            border-bottom: 1px solid rgba(255,255,255,0.04);
            vertical-align: middle;
        }

        .admin-table tr:hover td { background: rgba(255,255,255,0.02); }
        .admin-table tr:last-child td { border-bottom: none; }

        /* ── BADGE ── */
        .badge {
            display: inline-flex; align-items: center;
            padding: 3px 10px; border-radius: 99px;
            font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em;
        }

        .badge-teal { background: rgba(45,212,191,0.12); color: var(--teal); border: 1px solid rgba(45,212,191,0.25); }
        .badge-red  { background: var(--red-dim); color: var(--red); border: 1px solid rgba(239,68,68,0.25); }
        .badge-gray { background: var(--bg-card); color: var(--text-dim); border: 1px solid var(--border); }
    </style>
</head>

<body>
    <div class="admin-shell">
        <!-- Mobile overlay -->
        <div id="sidebarOverlay" onclick="closeSidebar()"></div>

        <!-- ─── SIDEBAR ─── -->
        <aside id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <div class="sidebar-logo-icon">K</div>
                    <div>
                        <div class="sidebar-logo-text">KeeTech</div>
                        <div class="sidebar-logo-sub">Admin Panel</div>
                    </div>
                </div>
                <button onclick="closeSidebar()" class="lg:hidden icon-btn" style="border:none;background:none;">
                    <span class="material-symbols-outlined" style="font-size:18px;color:var(--text-dim)">close</span>
                </button>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    Dashboard
                </a>

                <div class="nav-section-label">Konten</div>

                <a href="{{ route('admin.services.index') }}"
                    class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">build_circle</span>
                    Layanan
                </a>

                <a href="{{ route('admin.portfolio-categories.index') }}"
                    class="nav-item {{ request()->routeIs('admin.portfolio-categories.*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">category</span>
                    Kategori Proyek
                </a>

                <a href="{{ route('admin.portfolios.index') }}"
                    class="nav-item {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">auto_awesome</span>
                    Portofolio
                </a>

                <a href="{{ route('admin.testimonials.index') }}"
                    class="nav-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">format_quote</span>
                    Testimoni
                </a>

                <div class="nav-section-label">Operasional</div>

                <a href="{{ route('admin.contacts.index') }}"
                    class="nav-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">mail</span>
                    Pesan Masuk
                    <span class="nav-badge"></span>
                </a>

                <a href="{{ route('admin.settings.index') }}"
                    class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">tune</span>
                    Pengaturan
                </a>
            </nav>

            <div class="sidebar-footer">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-item" style="width:100%;border:none;cursor:pointer;background:none;" onmouseenter="this.style.background='var(--red-dim)';this.style.color='var(--red)'" onmouseleave="this.style.background='none';this.style.color='var(--text-dim)'">
                        <span class="material-symbols-outlined">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Spacer to push main content to the right of fixed sidebar -->
        <div class="sidebar-spacer"></div>

        <!-- ─── MAIN AREA ─── -->
        <div class="main-area">
            <!-- TOPBAR -->
            <header id="topbar">
                <button onclick="openSidebar()" class="icon-btn lg:hidden" style="flex-shrink:0">
                    <span class="material-symbols-outlined">menu</span>
                </button>

                <div class="topbar-search hidden sm:block">
                    <span class="material-symbols-outlined search-icon">search</span>
                    <input type="text" placeholder="Cari sesuatu...">
                </div>

                <div class="topbar-right">
                    <button class="icon-btn" title="Notifikasi">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>

                    <div style="height:28px;width:1px;background:var(--border);"></div>

                    <!-- User pill -->
                    <div style="position:relative;">
                        <div id="profileTrigger" class="user-pill" onclick="toggleProfileDropdown()">
                            <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                            <div class="hidden sm:block">
                                <div class="user-name">{{ auth()->user()->name }}</div>
                                <div class="user-role">Administrator</div>
                            </div>
                            <span class="material-symbols-outlined hidden sm:block" style="font-size:16px;color:var(--text-faint)">expand_more</span>
                        </div>

                        <div id="profileDropdown">
                            <a href="#" class="dropdown-item">
                                <span class="material-symbols-outlined">person</span> Profil
                            </a>
                            <a href="{{ route('admin.settings.index') }}" class="dropdown-item">
                                <span class="material-symbols-outlined">tune</span> Pengaturan
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item danger">
                                    <span class="material-symbols-outlined">logout</span> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT -->
            <main class="main-content">
                @yield('content')
            </main>

            <footer style="padding: 20px 28px; border-top: 1px solid var(--border); display:flex; justify-content:space-between; align-items:center;">
                <span style="font-size:11px; color:var(--text-faint)">© {{ date('Y') }} KeeTech Admin System</span>
                <span style="font-size:11px; color:var(--text-faint)">v1.0</span>
            </footer>
        </div>
    </div>

    <!-- ─── FLASH TOAST ─── -->
    @if(session('success') || session('error') || $errors->any())
    <div class="toast-wrap">
        @if(session('success'))
        <div class="toast success">
            <div class="toast-icon">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
            <span class="toast-text">{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error') || $errors->any())
        <div class="toast error">
            <div class="toast-icon">
                <span class="material-symbols-outlined">error</span>
            </div>
            <div>
                <div class="toast-text">{{ session('error') ?? 'Terjadi kesalahan validasi.' }}</div>
                @if($errors->any())
                <div style="margin-top:4px">
                    @foreach($errors->all() as $err)
                    <div style="font-size:11px;color:var(--text-dim)">• {{ $err }}</div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
    @endif

    <!-- ─── DELETE MODAL ─── -->
    <div id="deleteModal" class="modal-backdrop" style="display:none">
        <div class="modal-box">
            <div class="modal-icon">
                <span class="material-symbols-outlined">delete_forever</span>
            </div>
            <div class="modal-title">Hapus Data?</div>
            <p class="modal-desc" id="deleteModalMessage">Tindakan ini tidak dapat dibatalkan. Data akan dihapus secara permanen.</p>
            <div class="modal-btns">
                <button id="confirmDeleteBtn" class="btn-danger">
                    <span>Ya, Hapus Sekarang</span>
                </button>
                <button onclick="closeDeleteModal()" class="btn-ghost">Batal</button>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteForm = null;

        // ── SIDEBAR ──
        function openSidebar() {
            document.getElementById('sidebar').classList.add('open');
            document.getElementById('sidebarOverlay').classList.add('show');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('show');
        }

        // ── PROFILE DROPDOWN ──
        function toggleProfileDropdown() {
            document.getElementById('profileDropdown').classList.toggle('show');
        }

        document.addEventListener('click', function(e) {
            const trigger = document.getElementById('profileTrigger');
            const dropdown = document.getElementById('profileDropdown');
            if (trigger && dropdown && !trigger.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });

        // ── DELETE MODAL ──
        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
            currentDeleteForm = null;
        }

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('[data-destroy]');
            if (!btn) return;
            e.preventDefault();
            const msg = btn.getAttribute('data-confirm') || 'Apakah Anda yakin ingin menghapus data ini?';
            const formId = btn.getAttribute('data-form-id');
            currentDeleteForm = formId ? document.getElementById(formId) : btn.closest('form');
            if (currentDeleteForm) {
                document.getElementById('deleteModalMessage').innerText = msg;
                document.getElementById('deleteModal').style.display = 'flex';
            }
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (currentDeleteForm) {
                this.innerHTML = '<span class="material-symbols-outlined" style="animation:spin 0.8s linear infinite;font-size:16px">sync</span> Menghapus...';
                this.disabled = true;
                currentDeleteForm.submit();
            }
        });

        // Close modal on backdrop click
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // ── AUTO-DISMISS TOAST ──
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(t => {
                setTimeout(() => {
                    t.style.transition = 'opacity 0.4s, transform 0.4s';
                    t.style.opacity = '0';
                    t.style.transform = 'translateX(20px)';
                    setTimeout(() => t.remove(), 400);
                }, 4000);
            });
        });
    </script>
</body>

</html>