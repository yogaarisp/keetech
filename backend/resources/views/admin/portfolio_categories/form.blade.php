@extends('admin.layouts.app')
@section('title', isset($portfolioCategory) ? 'Edit Kategori' : 'Tambah Kategori')
@section('content')

<div style="margin-bottom:28px;">
    <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:var(--teal);margin-bottom:6px;">
        Konfigurasi Kategori
    </div>
    <h2 style="font-size:26px;font-weight:800;color:#fff;letter-spacing:-0.02em;margin:0 0 6px;">
        {{ isset($portfolioCategory) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
    </h2>
    <p style="font-size:13px;color:var(--text-dim);margin:0;">
        Kategori digunakan untuk mengelompokkan proyek di halaman portofolio.
    </p>
</div>

<div class="admin-card">
    <div style="padding:18px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
        <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">{{ isset($portfolioCategory) ? 'edit_square' : 'add_circle' }}</span>
        <div style="font-size:14px;font-weight:700;color:#fff;">Form Kategori Proyek</div>
    </div>
    
    <form action="{{ isset($portfolioCategory) ? route('admin.portfolio-categories.update', $portfolioCategory) : route('admin.portfolio-categories.store') }}" method="POST" style="padding:24px;">
        @csrf
        @if(isset($portfolioCategory)) @method('PUT') @endif

        <div style="background:rgba(45,212,191,0.06);border:1px solid rgba(45,212,191,0.2);padding:16px;border-radius:12px;display:flex;gap:12px;align-items:flex-start;margin-bottom:24px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px;">info</span>
            <div>
                <div style="font-size:12px;font-weight:700;color:var(--teal);margin-bottom:4px;text-transform:uppercase;letter-spacing:0.1em;">Info Slug SEO</div>
                <div style="font-size:12px;color:var(--text-dim);line-height:1.5;">Sistem akan otomatis membuat "Slug" URL yang ramah SEO berdasarkan Nama Kategori yang Anda masukkan.</div>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:20px;">
            <div>
                <label class="admin-label">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $portfolioCategory->name ?? '') }}" required class="admin-input" placeholder="Contoh: Web Development">
                @error('name') <p style="color:var(--red);font-size:11px;margin-top:6px;">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="admin-label">URL Gambar Sampul (Opsional)</label>
                <div style="position:relative;">
                    <span class="material-symbols-outlined" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:18px;color:var(--text-faint);">image</span>
                    <input type="url" name="image" value="{{ old('image', $portfolioCategory->image ?? '') }}" class="admin-input" placeholder="https://..." style="padding-left:42px;">
                </div>
                @error('image') <p style="color:var(--red);font-size:11px;margin-top:6px;">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="admin-label">Deskripsi Singkat</label>
                <textarea name="description" rows="4" class="admin-input" style="resize:none;" placeholder="Jelaskan jenis portofolio dalam kategori ini...">{{ old('description', $portfolioCategory->description ?? '') }}</textarea>
                @error('description') <p style="color:var(--red);font-size:11px;margin-top:6px;">{{ $message }}</p> @enderror
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:30px;padding-top:20px;border-top:1px solid var(--border);">
            <button type="submit" class="btn-primary">
                <span class="material-symbols-outlined" style="font-size:18px;">save</span> Simpan Kategori
            </button>
            <a href="{{ route('admin.portfolio-categories.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
