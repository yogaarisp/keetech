@extends('admin.layouts.app')
@section('title', 'Pengaturan Situs')
@section('content')

<div style="margin-bottom:24px;">
    <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:var(--teal);margin-bottom:6px;">Konfigurasi</div>
    <h2 style="font-size:22px;font-weight:800;color:#fff;margin:0 0 4px;">Pengaturan Situs</h2>
    <p style="font-size:13px;color:var(--text-dim);margin:0;">Kelola semua konten landing page dari sini.</p>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Tab Navigation --}}
    <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:20px;border-bottom:1px solid var(--border);padding-bottom:0;">
        @php
            $tabs = [
                ['id' => 'hero',     'label' => 'Hero',       'icon' => 'rocket_launch'],
                ['id' => 'about',    'label' => 'About',      'icon' => 'info'],
                ['id' => 'general',  'label' => 'General',    'icon' => 'tune'],
                ['id' => 'contact',  'label' => 'Kontak',     'icon' => 'call'],
                ['id' => 'social',   'label' => 'Social',     'icon' => 'share'],
                ['id' => 'stats',    'label' => 'Statistik',  'icon' => 'monitoring'],
                ['id' => 'features', 'label' => 'Keunggulan', 'icon' => 'star'],
                ['id' => 'footer',   'label' => 'Footer',     'icon' => 'bottom_navigation'],
                ['id' => 'webhook',  'label' => 'Webhook',    'icon' => 'hub'],
            ];
        @endphp

        @foreach($tabs as $tab)
        <button type="button" onclick="showTab('{{ $tab['id'] }}')"
            id="tab-btn-{{ $tab['id'] }}"
            style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:8px 8px 0 0;font-size:12px;font-weight:600;border:1px solid transparent;border-bottom:none;cursor:pointer;transition:all 0.15s;background:none;color:var(--text-dim);margin-bottom:-1px;">
            <span class="material-symbols-outlined" style="font-size:15px">{{ $tab['icon'] }}</span>
            {{ $tab['label'] }}
        </button>
        @endforeach
    </div>

    {{-- ===== HERO TAB ===== --}}
    <div class="tab-panel admin-card" id="tab-hero">
        <div style="padding:18px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">rocket_launch</span>
            <div>
                <div style="font-size:14px;font-weight:700;color:#fff;">Hero Section</div>
                <div style="font-size:11px;color:var(--text-faint);">Bagian pertama yang dilihat pengunjung.</div>
            </div>
        </div>
        <div style="padding:24px;display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            @foreach($settings['hero'] as $setting)
                @php
                    $label = ucwords(str_replace(['hero_', '_'], ['', ' '], $setting->key));
                    $isLong = in_array($setting->key, ['hero_description', 'hero_image', 'hero_title']);
                @endphp
                <div style="{{ $isLong ? 'grid-column:1/-1;' : '' }}">
                    <label class="admin-label">{{ $label }}</label>
                    @if($setting->key === 'hero_description')
                        <textarea name="{{ $setting->key }}" rows="3" class="admin-input" style="resize:none;">{{ $setting->value }}</textarea>
                    @elseif($setting->key === 'hero_image')
                        <div class="space-y-3">
                            <div class="drop-zone" data-target="hero_image" style="border:2px dashed var(--border);border-radius:12px;padding:20px;cursor:pointer;position:relative;min-height:140px;display:flex;align-items:center;justify-content:center;text-align:center;transition:border-color 0.2s;">
                                <input type="file" name="hero_image_file" class="hidden file-input" accept="image/*">
                                @php
                                    $heroImg = $setting->value;
                                    $heroPreview = $heroImg ? (str_starts_with($heroImg, 'http') ? $heroImg : asset('storage/' . $heroImg)) : null;
                                @endphp
                                <div class="preview-container {{ $heroPreview ? '' : 'hidden' }}" style="position:absolute;inset:0;border-radius:10px;overflow:hidden;">
                                    <img src="{{ $heroPreview }}" class="img-preview" style="width:100%;height:100%;object-fit:cover;">
                                    <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity 0.2s;" class="hover-overlay">
                                        <span style="background:#fff;color:#000;font-size:10px;font-weight:700;padding:4px 10px;border-radius:6px;text-transform:uppercase;">Ganti</span>
                                    </div>
                                </div>
                                <div class="drop-text {{ $heroPreview ? 'hidden' : '' }}" style="pointer-events:none;">
                                    <span class="material-symbols-outlined" style="font-size:28px;color:var(--text-faint);display:block;margin-bottom:6px;">image</span>
                                    <p style="font-size:11px;color:var(--text-faint);">Drag & drop atau klik untuk upload</p>
                                </div>
                            </div>
                            <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="admin-input url-input" placeholder="Atau tempel URL gambar..." style="font-size:11px;font-family:monospace;">
                        </div>
                    @elseif($setting->key === 'hero_title')
                        <textarea name="{{ $setting->key }}" rows="2" class="admin-input" style="resize:none;">{{ $setting->value }}</textarea>
                    @else
                        <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="admin-input">
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== ABOUT TAB ===== --}}
    <div class="tab-panel admin-card hidden" id="tab-about">
        <div style="padding:18px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">info</span>
            <div>
                <div style="font-size:14px;font-weight:700;color:#fff;">About / Tentang Kami</div>
                <div style="font-size:11px;color:var(--text-faint);">Gambar tim dan tahun pengalaman.</div>
            </div>
        </div>
        <div style="padding:24px;display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            @foreach($settings['about'] as $setting)
                @php $label = ucwords(str_replace(['about_', '_'], ['', ' '], $setting->key)); @endphp
                <div style="{{ $setting->key === 'about_image' ? 'grid-column:1/-1;' : '' }}">
                    <label class="admin-label">{{ $label }}</label>
                    @if($setting->key === 'about_image')
                        <div class="space-y-3">
                            <div class="drop-zone" data-target="about_image" style="border:2px dashed var(--border);border-radius:12px;padding:20px;cursor:pointer;position:relative;min-height:140px;display:flex;align-items:center;justify-content:center;text-align:center;">
                                <input type="file" name="about_image_file" class="hidden file-input" accept="image/*">
                                @php
                                    $aboutImg = $setting->value;
                                    $aboutPreview = $aboutImg ? (str_starts_with($aboutImg, 'http') ? $aboutImg : asset('storage/' . $aboutImg)) : null;
                                @endphp
                                <div class="preview-container {{ $aboutPreview ? '' : 'hidden' }}" style="position:absolute;inset:0;border-radius:10px;overflow:hidden;">
                                    <img src="{{ $aboutPreview }}" class="img-preview" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                                <div class="drop-text {{ $aboutPreview ? 'hidden' : '' }}" style="pointer-events:none;">
                                    <span class="material-symbols-outlined" style="font-size:28px;color:var(--text-faint);display:block;margin-bottom:6px;">group</span>
                                    <p style="font-size:11px;color:var(--text-faint);">Upload gambar tim</p>
                                </div>
                            </div>
                            <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="admin-input url-input" placeholder="Atau URL gambar..." style="font-size:11px;font-family:monospace;">
                        </div>
                    @else
                        <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="admin-input">
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== GENERAL TAB ===== --}}
    <div class="tab-panel admin-card hidden" id="tab-general">
        <div style="padding:18px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">tune</span>
            <div>
                <div style="font-size:14px;font-weight:700;color:#fff;">Identitas & General</div>
                <div style="font-size:11px;color:var(--text-faint);">Logo, favicon, dan informasi umum perusahaan.</div>
            </div>
        </div>
        <div style="padding:24px;">
            {{-- Logo & Favicon --}}
            <div style="background:rgba(255,255,255,0.02);border:1px solid var(--border);border-radius:12px;padding:20px;margin-bottom:20px;">
                <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.15em;color:var(--teal);margin-bottom:16px;">Logo & Favicon</div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    {{-- Logo --}}
                    <div>
                        <label class="admin-label">Logo Perusahaan</label>
                        <div class="drop-zone" data-target="company_logo" style="border:2px dashed var(--border);border-radius:12px;padding:16px;cursor:pointer;position:relative;min-height:120px;display:flex;align-items:center;justify-content:center;text-align:center;margin-bottom:10px;">
                            <input type="file" name="company_logo" class="hidden file-input" accept="image/*">
                            @php
                                $logo = \App\Models\SiteSetting::where('key', 'company_logo')->first()?->value;
                                $logoPreview = $logo ? (str_starts_with($logo, 'http') ? $logo : asset('storage/' . $logo)) : null;
                            @endphp
                            <div class="preview-container {{ $logoPreview ? '' : 'hidden' }}" style="position:absolute;inset:0;border-radius:10px;overflow:hidden;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.03);">
                                <img src="{{ $logoPreview }}" class="img-preview" style="max-height:70%;max-width:70%;object-fit:contain;">
                            </div>
                            <div class="drop-text {{ $logoPreview ? 'hidden' : '' }}" style="pointer-events:none;">
                                <span class="material-symbols-outlined" style="font-size:24px;color:var(--text-faint);display:block;margin-bottom:4px;">image</span>
                                <p style="font-size:10px;color:var(--text-faint);">Upload Logo</p>
                            </div>
                        </div>
                        <input type="text" name="company_logo_url" value="{{ $logo }}" class="admin-input url-input" placeholder="Atau URL logo..." style="font-size:11px;font-family:monospace;">
                    </div>

                    {{-- Favicon --}}
                    <div>
                        <label class="admin-label">Favicon</label>
                        <div class="drop-zone" data-target="company_favicon" style="border:2px dashed var(--border);border-radius:12px;padding:16px;cursor:pointer;position:relative;min-height:120px;display:flex;align-items:center;justify-content:center;text-align:center;margin-bottom:10px;">
                            <input type="file" name="company_favicon" class="hidden file-input" accept="image/x-icon,image/png">
                            @php
                                $favicon = \App\Models\SiteSetting::where('key', 'company_favicon')->first()?->value;
                                $faviconPreview = $favicon ? (str_starts_with($favicon, 'http') ? $favicon : asset('storage/' . $favicon)) : null;
                            @endphp
                            <div class="preview-container {{ $faviconPreview ? '' : 'hidden' }}" style="position:absolute;inset:0;border-radius:10px;overflow:hidden;display:flex;align-items:center;justify-content:center;">
                                <img src="{{ $faviconPreview }}" class="img-preview" style="width:32px;height:32px;object-fit:contain;">
                            </div>
                            <div class="drop-text {{ $faviconPreview ? 'hidden' : '' }}" style="pointer-events:none;">
                                <span class="material-symbols-outlined" style="font-size:24px;color:var(--text-faint);display:block;margin-bottom:4px;">favicon</span>
                                <p style="font-size:10px;color:var(--text-faint);">Upload Favicon</p>
                            </div>
                        </div>
                        <input type="text" name="company_favicon_url" value="{{ $favicon }}" class="admin-input url-input" placeholder="Atau URL favicon..." style="font-size:11px;font-family:monospace;">
                    </div>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                @foreach($settings['general'] as $setting)
                    @php $label = ucwords(str_replace(['company_', '_'], ['', ' '], $setting->key)); @endphp
                    <div style="{{ $setting->key === 'company_description' ? 'grid-column:1/-1;' : '' }}">
                        <label class="admin-label">{{ $label }}</label>
                        @if(strlen($setting->value) > 100 || $setting->key === 'company_description')
                            <textarea name="{{ $setting->key }}" rows="4" class="admin-input" style="resize:none;">{{ $setting->value }}</textarea>
                        @else
                            <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="admin-input">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===== CONTACT TAB ===== --}}
    <div class="tab-panel admin-card hidden" id="tab-contact">
        <div style="padding:18px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">call</span>
            <div>
                <div style="font-size:14px;font-weight:700;color:#fff;">Informasi Kontak</div>
                <div style="font-size:11px;color:var(--text-faint);">Alamat, telepon, email, dan WhatsApp.</div>
            </div>
        </div>
        <div style="padding:24px;display:flex;flex-direction:column;gap:16px;">
            @foreach($settings['contact'] as $setting)
                @php $label = ucwords(str_replace(['company_', '_'], ['', ' '], $setting->key)); @endphp
                <div>
                    <label class="admin-label">{{ $label }}</label>
                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="admin-input">
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== SOCIAL TAB ===== --}}
    <div class="tab-panel admin-card hidden" id="tab-social">
        <div style="padding:18px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">share</span>
            <div>
                <div style="font-size:14px;font-weight:700;color:#fff;">Media Sosial</div>
                <div style="font-size:11px;color:var(--text-faint);">Link media sosial yang tampil di footer.</div>
            </div>
        </div>
        <div style="padding:24px;display:flex;flex-direction:column;gap:16px;">
            @foreach($settings['social'] as $setting)
                @php $label = ucwords(str_replace(['social_', '_'], ['', ' '], $setting->key)); @endphp
                <div>
                    <label class="admin-label">{{ $label }}</label>
                    <input type="url" name="{{ $setting->key }}" value="{{ $setting->value }}" class="admin-input" placeholder="https://...">
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== STATS TAB ===== --}}
    <div class="tab-panel admin-card hidden" id="tab-stats">
        <div style="padding:18px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">monitoring</span>
            <div>
                <div style="font-size:14px;font-weight:700;color:#fff;">Statistik Perusahaan</div>
                <div style="font-size:11px;color:var(--text-faint);">Angka pencapaian di seksi About.</div>
            </div>
        </div>
        <div style="padding:24px;display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;">
            @foreach($settings['stats'] as $setting)
                @php $label = ucwords(str_replace(['stat_', '_'], ['', ' '], $setting->key)); @endphp
                <div style="text-align:center;background:rgba(255,255,255,0.02);border:1px solid var(--border);border-radius:12px;padding:20px;">
                    <label class="admin-label" style="text-align:center;display:block;">{{ $label }}</label>
                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="admin-input" style="text-align:center;font-size:22px;font-weight:800;">
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== FEATURES TAB ===== --}}
    <div class="tab-panel admin-card hidden" id="tab-features">
        <div style="padding:18px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">star</span>
            <div>
                <div style="font-size:14px;font-weight:700;color:#fff;">Keunggulan / Why Choose Us</div>
                <div style="font-size:11px;color:var(--text-faint);">3 alasan utama di seksi tentang kami.</div>
            </div>
        </div>
        <div style="padding:24px;display:flex;flex-direction:column;gap:16px;">
            @for($i = 1; $i <= 3; $i++)
                @php
                    $titleSetting = $settings['features']->firstWhere('key', "why_title_{$i}");
                    $descSetting  = $settings['features']->firstWhere('key', "why_desc_{$i}");
                @endphp
                @if($titleSetting && $descSetting)
                <div style="background:rgba(255,255,255,0.02);border:1px solid var(--border);border-radius:12px;padding:18px;">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px;">
                        <div style="width:28px;height:28px;border-radius:8px;background:var(--teal-dim);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:var(--teal);">{{ $i }}</div>
                        <span style="font-size:12px;font-weight:600;color:var(--text-dim);">Keunggulan #{{ $i }}</span>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 2fr;gap:12px;">
                        <div>
                            <label class="admin-label">Judul</label>
                            <input type="text" name="why_title_{{ $i }}" value="{{ $titleSetting->value }}" class="admin-input">
                        </div>
                        <div>
                            <label class="admin-label">Deskripsi</label>
                            <input type="text" name="why_desc_{{ $i }}" value="{{ $descSetting->value }}" class="admin-input">
                        </div>
                    </div>
                </div>
                @endif
            @endfor
        </div>
    </div>

    {{-- ===== FOOTER TAB ===== --}}
    <div class="tab-panel admin-card hidden" id="tab-footer">
        <div style="padding:18px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">bottom_navigation</span>
            <div>
                <div style="font-size:14px;font-weight:700;color:#fff;">Footer</div>
                <div style="font-size:11px;color:var(--text-faint);">Teks deskripsi dan copyright di footer.</div>
            </div>
        </div>
        <div style="padding:24px;display:flex;flex-direction:column;gap:16px;">
            @foreach($settings['footer'] as $setting)
                @php $label = ucwords(str_replace(['footer_', '_'], ['', ' '], $setting->key)); @endphp
                <div>
                    <label class="admin-label">{{ $label }}</label>
                    @if($setting->key === 'footer_description')
                        <textarea name="{{ $setting->key }}" rows="3" class="admin-input" style="resize:none;">{{ $setting->value }}</textarea>
                    @else
                        <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="admin-input">
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- ===== WEBHOOK TAB ===== --}}
    <div class="tab-panel admin-card hidden" id="tab-webhook">
        <div style="padding:18px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">hub</span>
            <div>
                <div style="font-size:14px;font-weight:700;color:#fff;">Webhook (n8n)</div>
                <div style="font-size:11px;color:var(--text-faint);">Endpoint penerus data kontak masuk.</div>
            </div>
        </div>
        <div style="padding:24px;">
            @foreach($settings['webhook'] as $setting)
            <div>
                <label class="admin-label">Webhook Endpoint URL</label>
                <input type="url" name="{{ $setting->key }}" value="{{ $setting->value }}" class="admin-input" placeholder="https://n8n.domain.id/webhook/..." style="font-family:monospace;">
                <div style="margin-top:10px;display:flex;align-items:flex-start;gap:10px;padding:12px 14px;background:rgba(251,191,36,0.06);border:1px solid rgba(251,191,36,0.2);border-radius:10px;">
                    <span class="material-symbols-outlined" style="color:#FBBF24;font-size:16px;margin-top:1px;">warning</span>
                    <p style="font-size:12px;color:rgba(251,191,36,0.8);line-height:1.5;margin:0;">Data dari form kontak publik akan diteruskan ke endpoint ini secara real-time.</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Floating Save --}}
    <div style="position:fixed;bottom:24px;right:24px;z-index:150;">
        <button type="submit" class="btn-primary" style="padding:12px 24px;font-size:13px;box-shadow:0 8px 32px rgba(45,212,191,0.35);">
            <span class="material-symbols-outlined" style="font-size:18px">save</span>
            Simpan Semua Perubahan
        </button>
    </div>
</form>

<style>
.tab-panel.hidden { display: none !important; }
.drop-zone:hover { border-color: var(--teal) !important; }
</style>

<script>
    // ── Tabs ──
    const tabIds = ['hero','about','general','contact','social','stats','features','footer','webhook'];

    function showTab(id) {
        tabIds.forEach(t => {
            const panel = document.getElementById('tab-' + t);
            const btn   = document.getElementById('tab-btn-' + t);
            if (t === id) {
                panel.classList.remove('hidden');
                btn.style.background = 'var(--teal-dim)';
                btn.style.color = 'var(--teal)';
                btn.style.borderColor = 'var(--border-active)';
            } else {
                panel.classList.add('hidden');
                btn.style.background = 'none';
                btn.style.color = 'var(--text-dim)';
                btn.style.borderColor = 'transparent';
            }
        });
    }

    // Init first tab
    document.addEventListener('DOMContentLoaded', () => showTab('hero'));

    // ── Drop zones ──
    document.querySelectorAll('.drop-zone').forEach(zone => {
        const input = zone.querySelector('.file-input');
        const container = zone.querySelector('.preview-container');
        const preview = zone.querySelector('.img-preview');
        const text = zone.querySelector('.drop-text');
        const urlInput = zone.closest('div').querySelector('.url-input');

        zone.addEventListener('click', () => input.click());

        ['dragenter','dragover','dragleave','drop'].forEach(n => {
            zone.addEventListener(n, e => { e.preventDefault(); e.stopPropagation(); });
        });

        ['dragenter','dragover'].forEach(n => zone.addEventListener(n, () => { zone.style.borderColor = 'var(--teal)'; }));
        ['dragleave','drop'].forEach(n => zone.addEventListener(n, () => { zone.style.borderColor = 'var(--border)'; }));

        zone.addEventListener('drop', e => {
            const files = e.dataTransfer.files;
            if (files.length) { input.files = files; handlePreview(files[0]); }
        });

        input.addEventListener('change', e => {
            if (e.target.files.length) handlePreview(e.target.files[0]);
        });

        if (urlInput) {
            urlInput.addEventListener('input', e => {
                if (e.target.value.startsWith('http')) {
                    preview.src = e.target.value;
                    container.classList.remove('hidden');
                    if (text) text.classList.add('hidden');
                    input.value = '';
                }
            });
        }

        function handlePreview(file) {
            if (!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                container.classList.remove('hidden');
                if (text) text.classList.add('hidden');
                if (urlInput) urlInput.value = '';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
