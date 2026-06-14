@extends('admin.layouts.app')

@section('title', 'Pengaturan Situs')

@section('content')
<div>
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="font-bold text-2xl text-stone-900 dark:text-white tracking-tight">Pengaturan Situs</h2>
            <p class="text-sm text-stone-500 dark:text-stone-400 mt-1">Kelola semua konten landing page dan konfigurasi situs dari sini.</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 pb-32">
        @csrf

        {{-- Tab Navigation --}}
        <div class="flex flex-wrap gap-2 border-b border-stone-200 dark:border-white/10 pb-0">
            <button type="button" onclick="showTab('hero')" class="tab-btn active px-5 py-3 text-sm font-bold rounded-t-xl transition-all" data-tab="hero">
                <span class="material-symbols-outlined text-base align-middle mr-1">rocket_launch</span> Hero
            </button>
            <button type="button" onclick="showTab('about')" class="tab-btn px-5 py-3 text-sm font-bold rounded-t-xl transition-all" data-tab="about">
                <span class="material-symbols-outlined text-base align-middle mr-1">info</span> About
            </button>
            <button type="button" onclick="showTab('general')" class="tab-btn px-5 py-3 text-sm font-bold rounded-t-xl transition-all" data-tab="general">
                <span class="material-symbols-outlined text-base align-middle mr-1">settings</span> General
            </button>
            <button type="button" onclick="showTab('contact')" class="tab-btn px-5 py-3 text-sm font-bold rounded-t-xl transition-all" data-tab="contact">
                <span class="material-symbols-outlined text-base align-middle mr-1">call</span> Kontak
            </button>
            <button type="button" onclick="showTab('social')" class="tab-btn px-5 py-3 text-sm font-bold rounded-t-xl transition-all" data-tab="social">
                <span class="material-symbols-outlined text-base align-middle mr-1">share</span> Social
            </button>
            <button type="button" onclick="showTab('stats')" class="tab-btn px-5 py-3 text-sm font-bold rounded-t-xl transition-all" data-tab="stats">
                <span class="material-symbols-outlined text-base align-middle mr-1">monitoring</span> Stats
            </button>
            <button type="button" onclick="showTab('features')" class="tab-btn px-5 py-3 text-sm font-bold rounded-t-xl transition-all" data-tab="features">
                <span class="material-symbols-outlined text-base align-middle mr-1">star</span> Keunggulan
            </button>
            <button type="button" onclick="showTab('footer')" class="tab-btn px-5 py-3 text-sm font-bold rounded-t-xl transition-all" data-tab="footer">
                <span class="material-symbols-outlined text-base align-middle mr-1">bottom_navigation</span> Footer
            </button>
            <button type="button" onclick="showTab('webhook')" class="tab-btn px-5 py-3 text-sm font-bold rounded-t-xl transition-all" data-tab="webhook">
                <span class="material-symbols-outlined text-base align-middle mr-1">hub</span> Webhook
            </button>
        </div>

        {{-- ===== HERO TAB ===== --}}
        <div class="tab-content" id="tab-hero">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-stone-200 dark:border-white/10 overflow-hidden">
                <div class="px-8 py-5 border-b border-stone-200 dark:border-white/10 bg-gradient-to-r from-[#800020]/5 to-transparent flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#800020]/10 text-[#800020] flex items-center justify-center">
                        <span class="material-symbols-outlined">rocket_launch</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-stone-900 dark:text-white">Hero Section</h3>
                        <p class="text-xs text-stone-500">Bagian pertama yang dilihat pengunjung saat membuka landing page.</p>
                    </div>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($settings['hero'] as $setting)
                        @php
                            $label = str_replace(['hero_', '_'], ['', ' '], $setting->key);
                            $isLong = in_array($setting->key, ['hero_description', 'hero_image', 'hero_title']);
                        @endphp
                        <div class="{{ $isLong ? 'md:col-span-2' : '' }}">
                            <label class="block text-xs font-bold text-stone-600 dark:text-stone-400 mb-2 uppercase tracking-wider">{{ $label }}</label>
                            @if($setting->key === 'hero_description')
                                <textarea name="{{ $setting->key }}" rows="3" class="w-full px-4 py-3 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-[#800020]/20 focus:border-[#800020] outline-none transition-all text-sm text-stone-900 dark:text-white resize-none">{{ $setting->value }}</textarea>
                            @elseif($setting->key === 'hero_image')
                                <div class="space-y-4">
                                    <div class="drop-zone relative group cursor-pointer" data-target="hero_image">
                                        <input type="file" name="hero_image_file" class="hidden file-input" accept="image/*">
                                        <div class="drop-zone-display border-2 border-dashed border-stone-200 dark:border-white/10 rounded-2xl p-6 transition-all flex flex-col items-center justify-center min-h-[150px] text-center bg-stone-50 dark:bg-white/5">
                                            @php
                                                $heroImg = $setting->value;
                                                $heroPreview = $heroImg ? (str_starts_with($heroImg, 'http') ? $heroImg : asset('storage/' . $heroImg)) : null;
                                            @endphp
                                            <div class="preview-container {{ $heroPreview ? '' : 'hidden' }} absolute inset-0 rounded-2xl overflow-hidden">
                                                <img src="{{ $heroPreview }}" class="img-preview w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <span class="bg-white text-stone-900 font-bold px-3 py-1 rounded-lg text-[10px] uppercase">Ganti Gambar</span>
                                                </div>
                                            </div>
                                            <div class="drop-text {{ $heroPreview ? 'hidden' : '' }} space-y-2">
                                                <span class="material-symbols-outlined text-stone-400 text-3xl">image</span>
                                                <p class="text-[10px] font-bold text-stone-500 uppercase">Tarik gambar hero atau klik disini</p>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="url-input w-full px-4 py-2 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-[#800020]/20 focus:border-[#800020] outline-none transition-all text-[10px] text-stone-400 font-mono" placeholder="Atau tempel URL gambar di sini...">
                                </div>
                            @else
                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full px-4 py-3 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-[#800020]/20 focus:border-[#800020] outline-none transition-all text-sm font-semibold text-stone-900 dark:text-white">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== ABOUT TAB ===== --}}
        <div class="tab-content hidden" id="tab-about">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-stone-200 dark:border-white/10 overflow-hidden">
                <div class="px-8 py-5 border-b border-stone-200 dark:border-white/10 bg-gradient-to-r from-blue-500/5 to-transparent flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-600 flex items-center justify-center">
                        <span class="material-symbols-outlined">info</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-stone-900 dark:text-white">About / Tentang Kami</h3>
                        <p class="text-xs text-stone-500">Heading, gambar tim, dan tahun pengalaman di seksi "Mengapa Memilih Kami".</p>
                    </div>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($settings['about'] as $setting)
                        @php $label = str_replace(['about_', '_'], ['', ' '], $setting->key); @endphp
                        <div class="{{ $setting->key === 'about_image' ? 'md:col-span-2' : '' }}">
                            <label class="block text-xs font-bold text-stone-600 dark:text-stone-400 mb-2 uppercase tracking-wider">{{ $label }}</label>
                            @if($setting->key === 'about_image')
                                <div class="space-y-4">
                                    <div class="drop-zone relative group cursor-pointer" data-target="about_image">
                                        <input type="file" name="about_image_file" class="hidden file-input" accept="image/*">
                                        <div class="drop-zone-display border-2 border-dashed border-stone-200 dark:border-white/10 rounded-2xl p-6 transition-all flex flex-col items-center justify-center min-h-[150px] text-center bg-stone-50 dark:bg-white/5">
                                            @php
                                                $aboutImg = $setting->value;
                                                $aboutPreview = $aboutImg ? (str_starts_with($aboutImg, 'http') ? $aboutImg : asset('storage/' . $aboutImg)) : null;
                                            @endphp
                                            <div class="preview-container {{ $aboutPreview ? '' : 'hidden' }} absolute inset-0 rounded-2xl overflow-hidden">
                                                <img src="{{ $aboutPreview }}" class="img-preview w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <span class="bg-white text-stone-900 font-bold px-3 py-1 rounded-lg text-[10px] uppercase">Ganti Gambar</span>
                                                </div>
                                            </div>
                                            <div class="drop-text {{ $aboutPreview ? 'hidden' : '' }} space-y-2">
                                                <span class="material-symbols-outlined text-stone-400 text-3xl">group</span>
                                                <p class="text-[10px] font-bold text-stone-500 uppercase">Tarik gambar tim atau klik disini</p>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="url-input w-full px-4 py-2 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-[10px] text-stone-400 font-mono" placeholder="Atau tempel URL gambar di sini...">
                                </div>
                            @else
                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full px-4 py-3 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm font-semibold text-stone-900 dark:text-white">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== GENERAL TAB ===== --}}
        <div class="tab-content hidden" id="tab-general">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-stone-200 dark:border-white/10 overflow-hidden">
                <div class="px-8 py-5 border-b border-stone-200 dark:border-white/10 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-500 flex items-center justify-center">
                        <span class="material-symbols-outlined">settings</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-stone-900 dark:text-white">Identitas & Meta Data</h3>
                        <p class="text-xs text-stone-500">Logo perusahaan, favicon, dan deskripsi umum.</p>
                    </div>
                </div>
                <div class="p-8">
                    {{-- Branding Section --}}
                    <div class="mb-10 p-6 bg-stone-50 dark:bg-white/5 rounded-2xl border border-stone-200 dark:border-white/10">
                        <h4 class="text-xs font-black text-stone-900 dark:text-white uppercase tracking-[0.2em] mb-6">Logo & Favicon</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Logo --}}
                            <div class="space-y-4">
                                <label class="block text-xs font-bold text-stone-500 uppercase tracking-wider">Site Logo</label>
                                <div class="drop-zone relative group cursor-pointer" data-target="company_logo">
                                    <input type="file" name="company_logo" class="hidden file-input" accept="image/*">
                                    <div class="drop-zone-display border-2 border-dashed border-stone-200 dark:border-white/10 rounded-2xl p-6 transition-all flex flex-col items-center justify-center min-h-[120px] text-center bg-white dark:bg-slate-900">
                                        @php
                                            $logo = \App\Models\SiteSetting::where('key', 'company_logo')->first()?->value;
                                            $logoPreview = $logo ? (str_starts_with($logo, 'http') ? $logo : asset('storage/' . $logo)) : null;
                                        @endphp
                                        <div class="preview-container {{ $logoPreview ? '' : 'hidden' }} absolute inset-0 rounded-2xl overflow-hidden flex items-center justify-center bg-stone-100 dark:bg-white/5">
                                            <img src="{{ $logoPreview }}" class="img-preview max-h-[80%] max-w-[80%] object-contain">
                                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <span class="bg-white text-stone-900 font-bold px-3 py-1 rounded-lg text-[10px] uppercase">Ganti Logo</span>
                                            </div>
                                        </div>
                                        <div class="drop-text {{ $logoPreview ? 'hidden' : '' }} space-y-2">
                                            <span class="material-symbols-outlined text-stone-400 text-3xl">image</span>
                                            <p class="text-[10px] font-bold text-stone-500 uppercase">Tarik logo kesini</p>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" name="company_logo_url" value="{{ $logo }}" class="url-input w-full px-4 py-2 bg-white dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-[10px] text-stone-400 font-mono" placeholder="Atau URL Logo...">
                            </div>

                            {{-- Favicon --}}
                            <div class="space-y-4">
                                <label class="block text-xs font-bold text-stone-500 uppercase tracking-wider">Site Favicon</label>
                                <div class="drop-zone relative group cursor-pointer" data-target="company_favicon">
                                    <input type="file" name="company_favicon" class="hidden file-input" accept="image/x-icon,image/png">
                                    <div class="drop-zone-display border-2 border-dashed border-stone-200 dark:border-white/10 rounded-2xl p-6 transition-all flex flex-col items-center justify-center min-h-[120px] text-center bg-white dark:bg-slate-900">
                                        @php
                                            $favicon = \App\Models\SiteSetting::where('key', 'company_favicon')->first()?->value;
                                            $faviconPreview = $favicon ? (str_starts_with($favicon, 'http') ? $favicon : asset('storage/' . $favicon)) : null;
                                        @endphp
                                        <div class="preview-container {{ $faviconPreview ? '' : 'hidden' }} absolute inset-0 rounded-2xl overflow-hidden flex items-center justify-center bg-stone-100 dark:bg-white/5">
                                            <img src="{{ $faviconPreview }}" class="img-preview w-8 h-8 object-contain">
                                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <span class="bg-white text-stone-900 font-bold px-3 py-1 rounded-lg text-[10px] uppercase">Ganti Favicon</span>
                                            </div>
                                        </div>
                                        <div class="drop-text {{ $faviconPreview ? 'hidden' : '' }} space-y-2">
                                            <span class="material-symbols-outlined text-stone-400 text-3xl">favicon</span>
                                            <p class="text-[10px] font-bold text-stone-500 uppercase">Tarik favicon kesini</p>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" name="company_favicon_url" value="{{ $favicon }}" class="url-input w-full px-4 py-2 bg-white dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-[10px] text-stone-400 font-mono" placeholder="Atau URL Favicon...">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($settings['general'] as $setting)
                            @php $label = str_replace(['company_', '_'], ['', ' '], $setting->key); @endphp
                            <div class="{{ $setting->key == 'company_description' ? 'md:col-span-2' : '' }}">
                                <label class="block text-xs font-bold text-stone-600 dark:text-stone-400 mb-2 uppercase tracking-wider">{{ $label }}</label>
                                @if(strlen($setting->value) > 100 || $setting->key == 'company_description')
                                    <textarea name="{{ $setting->key }}" rows="4" class="w-full px-4 py-3 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm text-stone-900 dark:text-white resize-none">{{ $setting->value }}</textarea>
                                @else
                                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full px-4 py-3 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all text-sm font-semibold text-stone-900 dark:text-white">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== CONTACT TAB ===== --}}
        <div class="tab-content hidden" id="tab-contact">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-stone-200 dark:border-white/10 overflow-hidden">
                <div class="px-8 py-5 border-b border-stone-200 dark:border-white/10 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#800020]/10 text-[#800020] flex items-center justify-center">
                        <span class="material-symbols-outlined">call</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-stone-900 dark:text-white">Informasi Kontak</h3>
                        <p class="text-xs text-stone-500">Alamat, telepon, email, dan WhatsApp yang tampil di landing page.</p>
                    </div>
                </div>
                <div class="p-8 space-y-6">
                    @foreach($settings['contact'] as $setting)
                        @php $label = str_replace(['company_', '_'], ['', ' '], $setting->key); @endphp
                        <div>
                            <label class="block text-xs font-bold text-stone-600 dark:text-stone-400 mb-2 uppercase tracking-wider">{{ $label }}</label>
                            <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full px-4 py-3 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-[#800020]/20 focus:border-[#800020] outline-none transition-all text-sm font-semibold text-stone-900 dark:text-white">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== SOCIAL TAB ===== --}}
        <div class="tab-content hidden" id="tab-social">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-stone-200 dark:border-white/10 overflow-hidden">
                <div class="px-8 py-5 border-b border-stone-200 dark:border-white/10 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center">
                        <span class="material-symbols-outlined">share</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-stone-900 dark:text-white">Media Sosial</h3>
                        <p class="text-xs text-stone-500">Link social media yang tampil di footer landing page.</p>
                    </div>
                </div>
                <div class="p-8 space-y-6">
                    @foreach($settings['social'] as $setting)
                        @php $label = str_replace(['social_', '_'], ['', ' '], $setting->key); @endphp
                        <div>
                            <label class="block text-xs font-bold text-stone-600 dark:text-stone-400 mb-2 uppercase tracking-wider">{{ $label }}</label>
                            <input type="url" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full px-4 py-3 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm text-stone-900 dark:text-white" placeholder="https://...">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== STATS TAB ===== --}}
        <div class="tab-content hidden" id="tab-stats">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-stone-200 dark:border-white/10 overflow-hidden">
                <div class="px-8 py-5 border-b border-stone-200 dark:border-white/10 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center">
                        <span class="material-symbols-outlined">monitoring</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-stone-900 dark:text-white">Statistik Perusahaan</h3>
                        <p class="text-xs text-stone-500">Angka-angka pencapaian yang tampil di seksi About landing page.</p>
                    </div>
                </div>
                <div class="p-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($settings['stats'] as $setting)
                        @php $label = str_replace(['stat_', '_'], ['', ' '], $setting->key); @endphp
                        <div class="text-center">
                            <label class="block text-xs font-bold text-stone-600 dark:text-stone-400 mb-2 uppercase tracking-wider">{{ $label }}</label>
                            <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full px-4 py-3 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none transition-all text-lg font-black text-stone-900 dark:text-white text-center">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== FEATURES/KEUNGGULAN TAB ===== --}}
        <div class="tab-content hidden" id="tab-features">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-stone-200 dark:border-white/10 overflow-hidden">
                <div class="px-8 py-5 border-b border-stone-200 dark:border-white/10 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-500/10 text-green-600 flex items-center justify-center">
                        <span class="material-symbols-outlined">star</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-stone-900 dark:text-white">Keunggulan / Why Choose Us</h3>
                        <p class="text-xs text-stone-500">3 alasan utama yang tampil di seksi "Mengapa Memilih Kami".</p>
                    </div>
                </div>
                <div class="p-8 space-y-8">
                    @for($i = 1; $i <= 3; $i++)
                        @php
                            $titleSetting = $settings['features']->firstWhere('key', "why_title_{$i}");
                            $descSetting = $settings['features']->firstWhere('key', "why_desc_{$i}");
                        @endphp
                        @if($titleSetting && $descSetting)
                        <div class="p-6 bg-stone-50 dark:bg-white/5 rounded-xl border border-stone-200 dark:border-white/10">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-sm">{{ $i }}</div>
                                <span class="text-sm font-bold text-stone-700 dark:text-stone-300">Keunggulan #{{ $i }}</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-stone-500 mb-2 uppercase tracking-wider">Judul</label>
                                    <input type="text" name="why_title_{{ $i }}" value="{{ $titleSetting->value }}" class="w-full px-4 py-3 bg-white dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none transition-all text-sm font-semibold text-stone-900 dark:text-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-stone-500 mb-2 uppercase tracking-wider">Deskripsi</label>
                                    <input type="text" name="why_desc_{{ $i }}" value="{{ $descSetting->value }}" class="w-full px-4 py-3 bg-white dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none transition-all text-sm text-stone-900 dark:text-white">
                                </div>
                            </div>
                        </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>

        {{-- ===== FOOTER TAB ===== --}}
        <div class="tab-content hidden" id="tab-footer">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-stone-200 dark:border-white/10 overflow-hidden">
                <div class="px-8 py-5 border-b border-stone-200 dark:border-white/10 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-stone-500/10 text-stone-600 flex items-center justify-center">
                        <span class="material-symbols-outlined">bottom_navigation</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-stone-900 dark:text-white">Footer</h3>
                        <p class="text-xs text-stone-500">Deskripsi perusahaan dan copyright text di bagian bawah landing page.</p>
                    </div>
                </div>
                <div class="p-8 space-y-6">
                    @foreach($settings['footer'] as $setting)
                        @php $label = str_replace(['footer_', '_'], ['', ' '], $setting->key); @endphp
                        <div>
                            <label class="block text-xs font-bold text-stone-600 dark:text-stone-400 mb-2 uppercase tracking-wider">{{ $label }}</label>
                            @if($setting->key === 'footer_description')
                                <textarea name="{{ $setting->key }}" rows="3" class="w-full px-4 py-3 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-stone-500/20 focus:border-stone-500 outline-none transition-all text-sm text-stone-900 dark:text-white resize-none">{{ $setting->value }}</textarea>
                            @else
                                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full px-4 py-3 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-stone-500/20 focus:border-stone-500 outline-none transition-all text-sm font-semibold text-stone-900 dark:text-white">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== WEBHOOK TAB ===== --}}
        <div class="tab-content hidden" id="tab-webhook">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-stone-200 dark:border-white/10 overflow-hidden">
                <div class="px-8 py-5 border-b border-stone-200 dark:border-white/10 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                        <span class="material-symbols-outlined">hub</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-stone-900 dark:text-white">Webhook (n8n)</h3>
                        <p class="text-xs text-stone-500">Endpoint untuk meneruskan data kontak masuk secara real-time.</p>
                    </div>
                </div>
                <div class="p-8 space-y-6">
                    @foreach($settings['webhook'] as $setting)
                        <div>
                            <label class="block text-xs font-bold text-stone-600 dark:text-stone-400 mb-2 uppercase tracking-wider">Webhook Endpoint URL</label>
                            <input type="url" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full px-4 py-3 bg-stone-50 dark:bg-white/5 border border-stone-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all text-sm font-mono text-stone-900 dark:text-white" placeholder="https://n8n.domain.id/...">
                            <div class="mt-4 flex items-start gap-3 p-4 bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-500/20 rounded-xl">
                                <span class="material-symbols-outlined text-amber-500 text-base mt-0.5">warning</span>
                                <p class="text-xs text-amber-700 dark:text-amber-400 leading-relaxed">Data dari form kontak publik akan diteruskan ke endpoint ini secara real-time.</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Floating Save Button --}}
        <div class="fixed bottom-8 left-1/2 -translate-x-1/2 lg:ml-32 z-[100]">
            <button type="submit" class="bg-[#800020] hover:bg-[#600018] text-white font-bold px-10 py-4 rounded-2xl shadow-2xl shadow-[#800020]/30 flex items-center gap-3 transition-all hover:-translate-y-1">
                <span class="material-symbols-outlined">save</span>
                <span class="uppercase tracking-widest text-xs">Simpan Semua Perubahan</span>
            </button>
        </div>
    </form>
</div>

<style>
    .tab-btn { color: #6b7280; background: transparent; }
    .tab-btn.active { color: #800020; background: white; border: 1px solid #e5e7eb; border-bottom-color: white; margin-bottom: -1px; position: relative; z-index: 1; }
    .dark {
        --tw-bg-opacity: 1;
        background-color: rgb(15 23 42 / var(--tw-bg-opacity));
    }
    .dark .tab-btn.active { background: #0f172a; border-color: rgba(255,255,255,0.1); border-bottom-color: #0f172a; color: #fed65b; }
    .tab-btn:hover:not(.active) { color: #800020; background: rgba(128,0,32,0.05); }

    .drop-zone.drag-over .drop-zone-display {
        border-color: #800020;
        background-color: rgba(128,0,32,0.05);
    }
</style>

<script>
    function showTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById('tab-' + tabName).classList.remove('hidden');
        document.querySelector('[data-tab="' + tabName + '"]').classList.add('active');
    }

    // Drag and Drop Logic for multiple zones
    document.querySelectorAll('.drop-zone').forEach(dropZone => {
        const input = dropZone.querySelector('.file-input');
        const container = dropZone.querySelector('.preview-container');
        const preview = dropZone.querySelector('.img-preview');
        const text = dropZone.querySelector('.drop-text');
        const urlInput = dropZone.closest('.space-y-4').querySelector('.url-input');

        dropZone.addEventListener('click', () => input.click());

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(name => {
            dropZone.addEventListener(name, e => {
                e.preventDefault();
                e.stopPropagation();
            });
        });

        ['dragenter', 'dragover'].forEach(name => {
            dropZone.addEventListener(name, () => dropZone.classList.add('drag-over'));
        });

        ['dragleave', 'drop'].forEach(name => {
            dropZone.addEventListener(name, () => dropZone.classList.remove('drag-over'));
        });

        dropZone.addEventListener('drop', e => {
            const files = e.dataTransfer.files;
            if (files.length) {
                input.files = files;
                handlePreview(files[0], preview, container, text, urlInput);
            }
        });

        input.addEventListener('change', e => {
            if (e.target.files.length) {
                handlePreview(e.target.files[0], preview, container, text, urlInput);
            }
        });

        if(urlInput) {
            urlInput.addEventListener('input', e => {
                if(e.target.value.startsWith('http')) {
                    preview.src = e.target.value;
                    container.classList.remove('hidden');
                    text.classList.add('hidden');
                    input.value = '';
                }
            });
        }
    });

    function handlePreview(file, img, container, text, urlInput) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
                container.classList.remove('hidden');
                text.classList.add('hidden');
                if (urlInput) urlInput.value = '';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
