@extends('admin.layouts.app')
@section('title', isset($service) ? 'Edit Layanan' : 'Tambah Layanan')
@section('content')

<div style="margin-bottom:28px;">
    <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:var(--teal);margin-bottom:6px;">
        Konfigurasi Layanan
    </div>
    <h2 style="font-size:26px;font-weight:800;color:#fff;letter-spacing:-0.02em;margin:0 0 6px;">
        {{ isset($service) ? 'Edit Layanan' : 'Tambah Layanan Baru' }}
    </h2>
    <p style="font-size:13px;color:var(--text-dim);margin:0;">
        Silakan lengkapi formulir di bawah ini untuk mengelola layanan.
    </p>
</div>

<div class="admin-card">
    <div style="padding:18px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
        <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">{{ isset($service) ? 'edit_square' : 'add_circle' }}</span>
        <div style="font-size:14px;font-weight:700;color:#fff;">Form Layanan</div>
    </div>
    
    <form action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST" style="padding:24px;">
        @csrf
        @if(isset($service)) @method('PUT') @endif

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
            <div>
                <label class="admin-label">Nama Layanan</label>
                <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}" required class="admin-input" placeholder="Contoh: Web Development">
                @error('title') <p style="color:var(--red);font-size:11px;margin-top:6px;">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="admin-label">Ikon (Material Symbols)</label>
                <div style="position:relative;">
                    <input type="text" name="icon" value="{{ old('icon', $service->icon ?? 'dns') }}" required class="admin-input" placeholder="dns">
                    <a href="https://fonts.google.com/icons" target="_blank" style="position:absolute;right:14px;top:50%;transform:translateY(-50%);font-size:10px;font-weight:700;text-transform:uppercase;color:var(--teal);text-decoration:none;">Cari Ikon</a>
                </div>
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label class="admin-label">Deskripsi Singkat</label>
            <textarea name="description" rows="3" required class="admin-input" style="resize:none;" placeholder="Deskripsikan layanan ini...">{{ old('description', $service->description ?? '') }}</textarea>
        </div>

        <div style="margin-bottom:20px;">
            <label class="admin-label">Fitur / Keunggulan</label>
            <div id="features-container" style="display:flex;flex-direction:column;gap:10px;margin-bottom:10px;">
                @php
                    $features = old('features', $service->features ?? ['']);
                    if (!is_array($features) || empty($features)) $features = [''];
                @endphp
                @foreach($features as $index => $feature)
                    <div style="display:flex;gap:10px;align-items:center;">
                        <input type="text" name="features[]" value="{{ $feature }}" class="admin-input" placeholder="Contoh: Keamanan Data Tingkat Tinggi">
                        @if($index > 0)
                        <button type="button" onclick="this.parentElement.remove()" class="icon-btn" style="flex-shrink:0;color:var(--red);border-color:rgba(239,68,68,0.2);">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                        @endif
                    </div>
                @endforeach
            </div>
            <button type="button" onclick="addFeatureField()" style="background:none;border:none;color:var(--teal);font-size:11px;font-weight:700;text-transform:uppercase;cursor:pointer;display:flex;align-items:center;gap:6px;padding:0;">
                <span class="material-symbols-outlined" style="font-size:14px;">add_circle</span> Tambah Fitur
            </button>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;padding-top:20px;border-top:1px solid var(--border);">
            <div>
                <label class="admin-label">Urutan Tampil</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" required class="admin-input" style="max-width:120px;text-align:center;">
            </div>
            <div style="display:flex;align-items:center;">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:12px 16px;border:1px solid var(--border);border-radius:10px;background:rgba(255,255,255,0.02);width:100%;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--teal);">
                    <span style="font-size:12px;font-weight:600;color:var(--text-dim);">Aktif (Tampilkan di Publik)</span>
                </label>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:30px;">
            <button type="submit" class="btn-primary">
                <span class="material-symbols-outlined" style="font-size:18px;">save</span> Simpan
            </button>
            <a href="{{ route('admin.services.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
    function addFeatureField() {
        const container = document.getElementById('features-container');
        const div = document.createElement('div');
        div.style.cssText = 'display:flex;gap:10px;align-items:center;';
        div.innerHTML = `
            <input type="text" name="features[]" class="admin-input" placeholder="Fitur baru...">
            <button type="button" onclick="this.parentElement.remove()" class="icon-btn" style="flex-shrink:0;color:var(--red);border-color:rgba(239,68,68,0.2);">
                <span class="material-symbols-outlined">delete</span>
            </button>
        `;
        container.appendChild(div);
    }
</script>
@endsection
