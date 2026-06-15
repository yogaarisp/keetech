<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>KeeTech Admin | Login</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        :root {
            --bg: #01030D;
            --teal: #2DD4BF;
            --teal-hover: #14B8A6;
            --gradient: linear-gradient(90deg, #2DD4BF 0%, #34D399 100%);
            --text-muted: rgba(255, 255, 255, 0.5);
            --border-subtle: rgba(255, 255, 255, 0.1);
            --card-bg: rgba(255, 255, 255, 0.03);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined', sans-serif;
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .dot-grid {
            background-image: radial-gradient(circle, rgba(45, 212, 191, 0.15) 1px, transparent 1px);
            background-size: 26px 26px;
        }

        .text-gradient {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-gradient {
            background: var(--gradient);
            color: #01030D;
            box-shadow: 0 0 28px rgba(45, 212, 191, 0.35);
            transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
        }

        .btn-gradient:hover {
            box-shadow: 0 0 36px rgba(45, 212, 191, 0.5);
            transform: translateY(-1px);
        }

        .btn-gradient:active {
            transform: translateY(0);
        }

        .input-field {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-subtle);
            border-radius: 10px;
            padding: 14px 16px 14px 48px;
            font-size: 0.875rem;
            color: #fff;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .input-field:focus {
            border-color: rgba(45, 212, 191, 0.4);
            box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.12);
        }

        .login-card {
            background: var(--card-bg);
            border: 1px solid var(--border-subtle);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.4), 0 0 40px rgba(45, 212, 191, 0.04);
        }

        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 5px 14px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(255, 255, 255, 0.03);
            font-size: 9.5px;
            font-weight: 500;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.5);
        }

        .glow-right {
            position: absolute;
            width: 55%;
            height: 85%;
            top: -5%;
            right: -5%;
            background: radial-gradient(ellipse at 65% 45%, rgba(45, 212, 191, 0.12) 0%, transparent 62%);
            pointer-events: none;
        }

        .glow-left {
            position: absolute;
            width: 45%;
            height: 75%;
            bottom: -5%;
            left: -8%;
            background: radial-gradient(ellipse at 30% 60%, rgba(45, 212, 191, 0.08) 0%, transparent 65%);
            pointer-events: none;
        }

        .checkbox-field {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.05);
            accent-color: var(--teal);
        }
    </style>
</head>
<body>
<main class="relative flex flex-1 flex-col items-center justify-center overflow-hidden px-4 py-10 sm:px-6 sm:py-14">
    {{-- Background layers --}}
    <div aria-hidden class="pointer-events-none absolute inset-0 dot-grid"></div>
    <div aria-hidden class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="glow-right"></div>
        <div class="glow-left"></div>
        <div style="position:absolute;width:35%;height:45%;bottom:0;right:8%;background:radial-gradient(ellipse at bottom,rgba(45,212,191,0.08) 0%,transparent 70%);"></div>
    </div>

    {{-- Brand --}}
    <div class="relative z-10 mb-8 text-center sm:mb-10">
        <div class="mb-5 inline-flex items-center justify-center">
            <div
                class="flex h-14 w-14 items-center justify-center rounded-full text-xl font-black text-white sm:h-16 sm:w-16 sm:text-2xl"
                style="background: var(--gradient); box-shadow: 0 0 20px rgba(45,212,191,0.45);"
            >K</div>
        </div>
        <div class="badge-pill mb-4">
            <span style="font-size:8px;color:rgba(255,255,255,0.45);">✦</span>
            Admin Portal
            <span style="font-size:8px;color:rgba(255,255,255,0.45);">✦</span>
        </div>
        <h1 class="mb-2 text-2xl font-black tracking-tight text-white sm:text-3xl">
            Kee<span class="text-gradient">Tech</span> Admin
        </h1>
        <p class="text-sm" style="color: var(--text-muted);">Masuk untuk mengelola konten website</p>
    </div>

    {{-- Login card --}}
    <div class="login-card relative z-10 w-full max-w-[440px] rounded-2xl p-6 sm:rounded-3xl sm:p-8">
        <div class="mb-6 text-center sm:mb-8">
            <h2 class="mb-2 text-xl font-bold text-white sm:text-2xl">Selamat Datang</h2>
            <p class="text-xs font-medium uppercase tracking-widest" style="color: var(--text-muted);">
                Akses khusus administrator
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 rounded-lg px-4 py-3 text-sm font-medium" style="background:rgba(45,212,191,0.1);border:1px solid rgba(45,212,191,0.25);color:var(--teal);">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label class="mb-2 block text-xs font-bold text-white/80 sm:text-sm" for="email">
                    Email Administrator
                </label>
                <div class="relative group">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <span class="material-symbols-outlined text-lg transition-colors group-focus-within:text-[var(--teal)]" style="color: rgba(255,255,255,0.35);">person</span>
                    </div>
                    <input
                        class="input-field"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@keetech.co.id"
                        type="email"
                        required
                        autofocus
                    />
                </div>
                @error('email')
                    <p class="mt-2 px-1 text-sm font-medium text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="mb-2 block text-xs font-bold text-white/80 sm:text-sm" for="password">
                    Kata Sandi
                </label>
                <div class="relative group">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <span class="material-symbols-outlined text-lg transition-colors group-focus-within:text-[var(--teal)]" style="color: rgba(255,255,255,0.35);">key</span>
                    </div>
                    <input
                        class="input-field"
                        id="password"
                        name="password"
                        placeholder="••••••••••••"
                        type="password"
                        required
                    />
                </div>
                @error('password')
                    <p class="mt-2 px-1 text-sm font-medium text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember --}}
            <div class="flex items-center justify-between px-1">
                <label class="flex cursor-pointer items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="checkbox-field">
                    <span class="text-xs font-medium sm:text-sm" style="color: var(--text-muted);">Ingat sesi saya</span>
                </label>
            </div>

            {{-- Submit --}}
            <button class="btn-gradient mt-2 flex w-full items-center justify-center gap-2 rounded-xl py-3.5 text-sm font-bold sm:py-4 sm:text-base" type="submit">
                <span class="material-symbols-outlined text-lg" style="font-variation-settings:'FILL' 1;">lock</span>
                Masuk Dashboard
            </button>
        </form>

        {{-- Security note --}}
        <div class="mt-6 border-t pt-6 text-center" style="border-color: rgba(255,255,255,0.08);">
            <div class="inline-flex items-center gap-2 text-xs" style="color: var(--text-muted);">
                <span class="material-symbols-outlined text-sm" style="color: var(--teal);">verified_user</span>
                Koneksi aman &amp; terenkripsi
            </div>
        </div>
    </div>
</main>

<footer class="relative z-10 w-full py-6 sm:py-8">
    <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-4 text-center sm:px-8 md:flex-row md:text-left">
        <p class="text-xs tracking-wide" style="color: rgba(255,255,255,0.35);">
            © {{ date('Y') }} KeeTech Admin Portal. All rights reserved.
        </p>
        <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
            <a class="text-xs tracking-wide transition-colors hover:text-white" style="color: rgba(255,255,255,0.35);" href="#">Kebijakan Privasi</a>
            <a class="text-xs tracking-wide transition-colors hover:text-white" style="color: rgba(255,255,255,0.35);" href="#">Syarat Layanan</a>
        </div>
    </div>
</footer>
</body>
</html>
