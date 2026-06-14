<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>AdminPortal | Secure Login</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .abstract-pattern {
            background-color: #570013;
            background-image: radial-gradient(circle at 20% 30%, #800020 0%, transparent 50%),
                              radial-gradient(circle at 80% 70%, #40000b 0%, transparent 50%);
        }
    </style>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "surface-bright": "#f9f9ff",
                      "on-tertiary": "#ffffff",
                      "surface-tint": "#af2b3e",
                      "background": "#f9f9ff",
                      "surface-dim": "#d0daf0",
                      "inverse-on-surface": "#ebf1ff",
                      "on-error": "#ffffff",
                      "on-error-container": "#93000a",
                      "on-surface-variant": "#584141",
                      "primary-container": "#800020",
                      "on-secondary-fixed": "#111c2c",
                      "error": "#ba1a1a",
                      "on-tertiary-fixed-variant": "#434749",
                      "tertiary-container": "#3a3e40",
                      "on-secondary": "#ffffff",
                      "secondary-fixed": "#d8e3fa",
                      "surface-container-high": "#dee8ff",
                      "on-tertiary-container": "#a5a9ab",
                      "on-secondary-container": "#586377",
                      "surface-container-lowest": "#ffffff",
                      "surface-container": "#e7eeff",
                      "on-primary-fixed-variant": "#8e0f28",
                      "on-background": "#121c2c",
                      "inverse-surface": "#273141",
                      "error-container": "#ffdad6",
                      "on-primary-fixed": "#40000b",
                      "on-secondary-fixed-variant": "#3c475a",
                      "tertiary-fixed": "#e0e3e5",
                      "surface": "#f9f9ff",
                      "tertiary": "#24282a",
                      "primary-fixed": "#ffdada",
                      "outline": "#8c7071",
                      "on-surface": "#121c2c",
                      "inverse-primary": "#ffb3b5",
                      "secondary-container": "#d5e0f7",
                      "on-primary": "#ffffff",
                      "primary": "#570013",
                      "secondary": "#545f72",
                      "surface-container-highest": "#d9e3f9",
                      "outline-variant": "#e0bfbf",
                      "secondary-fixed-dim": "#bcc7dd",
                      "on-primary-container": "#ff828a",
                      "tertiary-fixed-dim": "#c3c7c9",
                      "surface-variant": "#d9e3f9",
                      "surface-container-low": "#f0f3ff",
                      "primary-fixed-dim": "#ffb3b5",
                      "on-tertiary-fixed": "#181c1e"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "md": "16px",
                      "container-margin": "40px",
                      "xs": "4px",
                      "gutter": "24px",
                      "unit": "4px",
                      "lg": "24px",
                      "xl": "32px",
                      "sm": "8px"
              },
              "fontFamily": {
                      "label-md": ["Manrope"],
                      "label-sm": ["Manrope"],
                      "h2": ["Manrope"],
                      "h1": ["Manrope"],
                      "body-lg": ["Manrope"],
                      "h3": ["Manrope"],
                      "body-md": ["Manrope"]
              },
              "fontSize": {
                      "label-md": ["14px", {"lineHeight": "1.2", "fontWeight": "600"}],
                      "label-sm": ["12px", {"lineHeight": "1.2", "letterSpacing": "0.05em", "fontWeight": "500"}],
                      "h2": ["24px", {"lineHeight": "1.3", "fontWeight": "700"}],
                      "h1": ["36px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                      "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                      "h3": ["20px", {"lineHeight": "1.4", "fontWeight": "600"}],
                      "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}]
              }
            },
          },
        }
      </script>
</head>
<body class="abstract-pattern font-body-md text-on-background min-h-screen flex flex-col">
<!-- Hero Content / Background Area -->
<main class="flex-grow flex flex-col items-center justify-center relative px-4 sm:px-6 py-8 sm:py-12">
<!-- Background Decorative Element -->
<div class="absolute inset-0 overflow-hidden pointer-events-none">
<div class="absolute top-[-10%] right-[-5%] w-[400px] h-[400px] bg-primary-container/20 rounded-full blur-[120px]"></div>
<div class="absolute bottom-[-10%] left-[-5%] w-[500px] h-[500px] bg-primary/20 rounded-full blur-[150px]"></div>
</div>
<!-- Identity Section -->
<div class="mb-10 text-center z-10">
<div class="inline-flex items-center justify-center w-20 h-20 mb-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 shadow-2xl">
<span class="material-symbols-outlined text-white text-5xl" style="font-variation-settings: 'FILL' 1;">shield</span>
</div>
<h1 class="font-h1 text-h1 text-white tracking-widest uppercase mb-2">AdminPortal</h1>
<div class="flex items-center justify-center gap-2">
<span class="h-[1px] w-8 bg-white/30"></span>
<span class="font-label-sm text-label-sm text-white/60 tracking-widest uppercase">System Control Unit</span>
<span class="h-[1px] w-8 bg-white/30"></span>
</div>
</div>
<!-- Glassmorphism Login Card -->
<div class="glass-panel w-full max-w-[480px] p-6 sm:p-xl rounded-2xl sm:rounded-[32px] shadow-[0px_20px_50px_rgba(0,0,0,0.3)] z-10 border border-white/40">
<div class="text-center mb-xl">
<h2 class="font-h2 text-h2 text-primary-container mb-2">Welcome Back</h2>
<p class="font-label-sm text-label-sm text-on-surface-variant/70 tracking-widest uppercase">Authorized Personnel Only</p>
</div>

<!-- ERROR ALERT IF LOGIN FAILS -->
@if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
@endif

<form action="{{ route('admin.login.post') }}" method="POST" class="space-y-lg">
@csrf

<!-- Identity Field -->
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface-variant block ml-1" for="email">Administrator Email</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-md flex items-center pointer-events-none transition-colors duration-200 group-focus-within:text-primary-container">
<span class="material-symbols-outlined text-primary-container/60 group-focus-within:text-primary-container">person</span>
</div>
<input class="w-full bg-white/80 border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container rounded-xl py-4 pl-12 pr-md font-body-md text-on-surface outline-none transition-all placeholder:text-on-surface-variant/40" id="email" name="email" value="{{ old('email') }}" placeholder="admin@keetech.co.id" type="email" required autofocus/>
</div>
@error('email')
    <p class="mt-2 text-sm text-red-600 font-medium px-1">{{ $message }}</p>
@enderror
</div>

<!-- Credential Field -->
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface-variant block ml-1" for="password">Security Key</label>
<div class="relative group">
<div class="absolute inset-y-0 left-0 pl-md flex items-center pointer-events-none transition-colors duration-200 group-focus-within:text-primary-container">
<span class="material-symbols-outlined text-primary-container/60 group-focus-within:text-primary-container">key</span>
</div>
<input class="w-full bg-white/80 border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container rounded-xl py-4 pl-12 pr-md font-body-md text-on-surface outline-none transition-all placeholder:text-on-surface-variant/40" id="password" name="password" placeholder="••••••••••••" type="password" required/>
</div>
@error('password')
    <p class="mt-2 text-sm text-red-600 font-medium px-1">{{ $message }}</p>
@enderror
</div>

<!-- Action Links -->
<div class="flex items-center justify-between font-label-sm text-label-sm px-1 mt-4">
<label class="flex items-center gap-2 cursor-pointer group">
<input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-outline-variant text-primary-container focus:ring-primary-container bg-white/80 transition-colors">
<span class="text-on-surface-variant hover:text-primary-container transition-colors font-medium">Maintain Session</span>
</label>
<a class="text-primary-container font-semibold hover:underline decoration-2 underline-offset-4" href="#">Identity Recovery</a>
</div>

<!-- Primary Action -->
<button class="w-full bg-primary-container text-white font-label-md text-body-lg py-4 rounded-xl shadow-lg shadow-primary-container/30 hover:bg-primary-container/90 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3 mt-6" type="submit">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">lock</span>
                    Secure Access
                </button>
</form>

<!-- Secondary Verification -->
<div class="mt-xl pt-lg border-t border-white/30 flex flex-col items-center gap-4">
<p class="font-label-sm text-label-sm text-on-surface-variant/60">Verification via connected hardware</p>
<div class="flex gap-4">
<button class="w-12 h-12 rounded-full flex items-center justify-center bg-white/40 border border-white/40 text-on-surface-variant hover:text-primary-container hover:bg-white/60 transition-all shadow-sm">
<span class="material-symbols-outlined">fingerprint</span>
</button>
<button class="w-12 h-12 rounded-full flex items-center justify-center bg-white/40 border border-white/40 text-on-surface-variant hover:text-primary-container hover:bg-white/60 transition-all shadow-sm">
<span class="material-symbols-outlined">qr_code_2</span>
</button>
</div>
</div>
</div>
</main>
<!-- Footer Component -->
<footer class="w-full py-6 sm:py-8 bg-transparent">
<div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center px-4 sm:px-8 gap-4 md:gap-0 text-center md:text-left">
<p class="font-['Manrope'] text-xs tracking-wide text-white/50">© 2024 KeeTech Admin Portal. All rights reserved.</p>
<div class="flex flex-wrap justify-center gap-4 sm:gap-8">
<a class="font-['Manrope'] text-xs tracking-wide text-white/50 hover:text-white transition-colors" href="#">Privacy Policy</a>
<a class="font-['Manrope'] text-xs tracking-wide text-white/50 hover:text-white transition-colors" href="#">Terms of Service</a>
<a class="font-['Manrope'] text-xs tracking-wide text-white/50 hover:text-white transition-colors" href="#">Security Audit</a>
</div>
</div>
</footer>
</body></html>
