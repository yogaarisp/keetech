<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>KeeTech Admin | Secure Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            900: '#134e4a',
                            950: '#01030D',
                        }
                    },
                    animation: {
                        blob: "blob 7s infinite",
                        pulseSlow: "pulseSlow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite",
                    },
                    keyframes: {
                        blob: {
                            "0%": { transform: "translate(0px, 0px) scale(1)" },
                            "33%": { transform: "translate(30px, -50px) scale(1.1)" },
                            "66%": { transform: "translate(-20px, 20px) scale(0.9)" },
                            "100%": { transform: "translate(0px, 0px) scale(1)" }
                        },
                        pulseSlow: {
                            "0%, 100%": { opacity: 1 },
                            "50%": { opacity: .7 },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --bg: #01030D;
            --teal: #2DD4BF;
            --gradient: linear-gradient(135deg, #2DD4BF 0%, #34D399 100%);
            --glass-bg: rgba(20, 25, 40, 0.45);
            --glass-border: rgba(255, 255, 255, 0.08);
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: #fff;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }

        /* Ambient Background */
        .dot-pattern {
            background-image: radial-gradient(rgba(45, 212, 191, 0.15) 1px, transparent 1px);
            background-size: 32px 32px;
            opacity: 0.4;
        }

        /* Glassmorphism Card */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--glass-border);
            box-shadow: 
                0 4px 6px -1px rgba(0, 0, 0, 0.1), 
                0 24px 48px -12px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        /* Typography */
        .text-gradient {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Form Inputs */
        .input-wrapper {
            position: relative;
            transition: all 0.3s ease;
        }

        .custom-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 14px 16px 14px 46px;
            font-size: 0.9rem;
            color: #fff;
            outline: none;
            transition: all 0.3s ease;
        }

        .custom-input::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        .custom-input:focus {
            background: rgba(0, 0, 0, 0.4);
            border-color: rgba(45, 212, 191, 0.5);
            box-shadow: 0 0 0 4px rgba(45, 212, 191, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .custom-input:focus + .input-icon,
        .custom-input:not(:placeholder-shown) + .input-icon {
            color: var(--teal);
        }

        /* Custom Checkbox */
        .custom-checkbox {
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(0, 0, 0, 0.2);
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
        }

        .custom-checkbox:checked {
            background: var(--gradient);
            border-color: transparent;
        }

        .custom-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid #01030D;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* Button */
        .btn-submit {
            background: var(--gradient);
            color: #01030D;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.4s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(45, 212, 191, 0.4), 0 8px 10px -6px rgba(45, 212, 191, 0.1);
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Animation Delays */
        .delay-2000 { animation-delay: 2s; }
        .delay-4000 { animation-delay: 4s; }
    </style>
</head>
<body class="selection:bg-brand-400 selection:text-brand-950">

    {{-- Background Orbs --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 dot-pattern"></div>
        
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-brand-400/20 rounded-full mix-blend-screen filter blur-[100px] animate-blob"></div>
        <div class="absolute top-[20%] right-[-10%] w-96 h-96 bg-brand-500/10 rounded-full mix-blend-screen filter blur-[120px] animate-blob delay-2000"></div>
        <div class="absolute bottom-[-20%] left-[20%] w-[500px] h-[500px] bg-emerald-500/15 rounded-full mix-blend-screen filter blur-[150px] animate-blob delay-4000"></div>
    </div>

    <main class="relative flex flex-1 flex-col items-center justify-center px-4 py-12 sm:px-6 z-10">
        
        {{-- Header / Brand --}}
        <div class="text-center mb-10 transform transition-all duration-700 translate-y-0 opacity-100">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-400 to-emerald-400 shadow-[0_0_30px_rgba(45,212,191,0.3)] mb-6 relative group cursor-default">
                <div class="absolute inset-0 bg-white/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <span class="text-2xl font-black text-brand-950">K</span>
            </div>
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-white/10 bg-white/5 backdrop-blur-md mb-5">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-400 animate-pulse"></span>
                <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-white/70">Admin Portal</span>
            </div>
            
            <h1 class="text-3xl sm:text-4xl font-black tracking-tight mb-2">
                Kee<span class="text-gradient">Tech</span>
            </h1>
            <p class="text-white/40 text-sm font-medium tracking-wide">
                Secure Administrator Access
            </p>
        </div>

        {{-- Login Card --}}
        <div class="glass-card w-full max-w-[420px] rounded-[24px] p-8 sm:p-10 transform transition-all duration-700 translate-y-0 opacity-100">
            
            <div class="mb-8">
                <h2 class="text-xl font-bold text-white mb-1">Welcome Back</h2>
                <p class="text-sm text-white/50">Enter your credentials to continue</p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-brand-400/10 border border-brand-400/20 text-brand-400 text-sm font-medium flex items-start gap-3">
                    <span class="material-symbols-outlined text-[18px]">info</span>
                    <p class="leading-relaxed">{{ session('status') }}</p>
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Email Input --}}
                <div class="space-y-2">
                    <label class="text-[11px] font-bold uppercase tracking-wider text-white/60 ml-1" for="email">
                        Email Address
                    </label>
                    <div class="input-wrapper group">
                        <input
                            class="custom-input"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@keetech.co.id"
                            type="email"
                            required
                            autofocus
                        />
                        <span class="material-symbols-outlined input-icon text-[20px]">alternate_email</span>
                    </div>
                    @error('email')
                        <p class="text-[13px] font-medium text-red-400 mt-1.5 ml-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">error</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password Input --}}
                <div class="space-y-2">
                    <div class="flex items-center justify-between ml-1">
                        <label class="text-[11px] font-bold uppercase tracking-wider text-white/60" for="password">
                            Password
                        </label>
                        {{-- Optional: Forgot Password Link --}}
                        {{-- <a href="#" class="text-[11px] font-bold text-brand-400 hover:text-white transition-colors">Forgot?</a> --}}
                    </div>
                    <div class="input-wrapper group">
                        <input
                            class="custom-input"
                            id="password"
                            name="password"
                            placeholder="••••••••••••"
                            type="password"
                            required
                        />
                        <span class="material-symbols-outlined input-icon text-[20px]">lock</span>
                    </div>
                    @error('password')
                        <p class="text-[13px] font-medium text-red-400 mt-1.5 ml-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">error</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center pt-1 ml-1">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" name="remember" id="remember" class="custom-checkbox">
                        <span class="text-[13px] font-medium text-white/50 group-hover:text-white/80 transition-colors select-none">
                            Keep me signed in
                        </span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button class="btn-submit w-full flex items-center justify-center gap-2 rounded-xl py-3.5 text-[15px] font-bold shadow-lg" type="submit">
                        Sign In to Dashboard
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>
            </form>

        </div>
        
        {{-- Footer --}}
        <div class="mt-12 text-center">
            <div class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/5 text-white/40 text-[11px] font-medium tracking-wide">
                <span class="material-symbols-outlined text-[14px] text-brand-400/70">shield</span>
                End-to-End Encrypted Connection
            </div>
        </div>

    </main>

</body>
</html>
