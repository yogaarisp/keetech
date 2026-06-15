@extends('admin.layouts.app')
@section('title', isset($testimonial) ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('content')

<div style="margin-bottom:28px;">
    <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:var(--teal);margin-bottom:6px;">
        Konfigurasi Review
    </div>
    <h2 style="font-size:26px;font-weight:800;color:#fff;letter-spacing:-0.02em;margin:0 0 6px;">
        {{ isset($testimonial) ? 'Edit Testimoni' : 'Tambah Testimoni Baru' }}
    </h2>
    <p style="font-size:13px;color:var(--text-dim);margin:0;">
        Masukkan detail ulasan klien terhadap layanan Anda.
    </p>
</div>

<div class="admin-card">
    <div style="padding:18px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
        <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">{{ isset($testimonial) ? 'edit_square' : 'add_comment' }}</span>
        <div style="font-size:14px;font-weight:700;color:#fff;">Form Testimoni</div>
    </div>
    
    <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" style="padding:24px;">
        @csrf
        @if(isset($testimonial)) @method('PUT') @endif

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
            <div>
                <label class="admin-label">Nama Klien</label>
                <input type="text" name="client_name" value="{{ old('client_name', $testimonial->client_name ?? '') }}" required class="admin-input" placeholder="Contoh: Budi Santoso">
                @error('client_name') <p style="color:var(--red);font-size:11px;margin-top:6px;">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="admin-label">Peran / Jabatan / Nama Perusahaan</label>
                <input type="text" name="client_role" value="{{ old('client_role', $testimonial->client_role ?? '') }}" class="admin-input" placeholder="Contoh: CEO PT. ABC XYZ">
                @error('client_role') <p style="color:var(--red);font-size:11px;margin-top:6px;">{{ $message }}</p> @enderror
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label class="admin-label">Isi Testimoni</label>
            <textarea name="content" rows="4" required class="admin-input" style="resize:none;" placeholder="Tuliskan ulasan dari klien...">{{ old('content', $testimonial->content ?? '') }}</textarea>
            @error('content') <p style="color:var(--red);font-size:11px;margin-top:6px;">{{ $message }}</p> @enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
            <div style="background:rgba(255,255,255,0.02);border:1px solid var(--border);border-radius:12px;padding:20px;">
                <label class="admin-label">Foto Klien (Avatar)</label>
                <div class="drop-zone" id="drop-zone" style="border:2px dashed var(--border);border-radius:12px;padding:20px;cursor:pointer;position:relative;min-height:160px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;transition:border-color 0.2s;">
                    <input type="file" name="client_photo_file" id="client_photo_file" class="hidden" accept="image/*" style="display:none;">
                    
                    @php
                        $img = old('client_photo', $testimonial->client_photo ?? null);
                        $previewUrl = $img ? (str_starts_with($img, 'http') ? $img : asset('storage/' . $img)) : null;
                    @endphp

                    <div id="preview-container" class="{{ $previewUrl ? '' : 'hidden' }}" style="position:absolute;inset:0;border-radius:10px;overflow:hidden;display:flex;align-items:center;justify-content:center;background:var(--bg-hover);">
                        <img id="image-preview" src="{{ $previewUrl }}" style="width:100px;height:100px;object-fit:cover;border-radius:50%;border:4px solid var(--border);">
                        <div style="position:absolute;inset:0;background:rgba(0,0,0,0.5);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity 0.2s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0">
                            <span style="background:#fff;color:#000;font-size:10px;font-weight:700;padding:4px 10px;border-radius:6px;text-transform:uppercase;">Ganti Foto</span>
                        </div>
                    </div>

                    <div id="drop-text" class="{{ $previewUrl ? 'hidden' : '' }}" style="pointer-events:none;">
                        <span class="material-symbols-outlined" style="font-size:32px;color:var(--text-faint);display:block;margin-bottom:6px;">account_circle</span>
                        <p style="font-size:11px;font-weight:700;color:var(--text-dim);margin:0 0 2px;">Upload Avatar</p>
                        <p style="font-size:9px;color:var(--text-faint);margin:0;">Rasio 1:1 direkomendasikan</p>
                    </div>
                </div>
                
                <div style="margin-top:10px;">
                    <input type="text" name="client_photo" id="client_photo_url" value="{{ $img }}" class="admin-input" placeholder="Atau paste URL foto..." style="font-size:11px;">
                </div>
                @error('client_photo_file') <p style="color:var(--red);font-size:11px;margin-top:6px;">{{ $message }}</p> @enderror
            </div>

            <div style="display:flex;flex-direction:column;gap:20px;">
                <div style="background:rgba(255,255,255,0.02);border:1px solid var(--border);border-radius:12px;padding:20px;">
                    <label class="admin-label">Rating (1-5 Bintang)</label>
                    <input type="number" min="1" max="5" name="rating" value="{{ old('rating', $testimonial->rating ?? 5) }}" required class="admin-input" style="font-size:24px;text-align:center;font-weight:800;color:var(--teal);">
                </div>
                
                <div style="background:rgba(255,255,255,0.02);border:1px solid var(--border);border-radius:12px;padding:20px;">
                    <label class="admin-label">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}" required class="admin-input" style="font-size:24px;text-align:center;font-weight:800;">
                </div>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;padding-top:20px;border-top:1px solid var(--border);">
            <div style="display:flex;align-items:center;">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:12px 16px;border:1px solid var(--border);border-radius:10px;background:rgba(255,255,255,0.02);width:100%;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--teal);">
                    <span style="font-size:12px;font-weight:600;color:var(--text-dim);">Publish (Tampilkan di Publik)</span>
                </label>
            </div>
            
            <div style="display:flex;align-items:center;">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:12px 16px;border:1px solid rgba(251,191,36,0.3);border-radius:10px;background:rgba(251,191,36,0.05);width:100%;">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured ?? false) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:#FBBF24;">
                    <span style="font-size:12px;font-weight:700;color:rgba(251,191,36,0.9);">Tandai sebagai Featured (Bintang Utama)</span>
                </label>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:30px;">
            <button type="submit" class="btn-primary">
                <span class="material-symbols-outlined" style="font-size:18px;">save</span> Simpan Testimoni
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>

<style>
.hidden { display: none !important; }
</style>

<script>
    const dropZone = document.getElementById('drop-zone');
    const imageInput = document.getElementById('client_photo_file');
    const imagePreview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('preview-container');
    const dropText = document.getElementById('drop-text');
    const imageUrlInput = document.getElementById('client_photo_url');

    dropZone.addEventListener('click', () => imageInput.click());

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eName => {
        dropZone.addEventListener(eName, e => { e.preventDefault(); e.stopPropagation(); });
    });

    ['dragenter', 'dragover'].forEach(eName => {
        dropZone.addEventListener(eName, () => dropZone.style.borderColor = 'var(--teal)');
    });

    ['dragleave', 'drop'].forEach(eName => {
        dropZone.addEventListener(eName, () => dropZone.style.borderColor = 'var(--border)');
    });

    dropZone.addEventListener('drop', e => {
        if (e.dataTransfer.files.length) {
            imageInput.files = e.dataTransfer.files;
            handlePreview(e.dataTransfer.files[0]);
        }
    });

    imageInput.addEventListener('change', e => {
        if (e.target.files.length) handlePreview(e.target.files[0]);
    });

    function handlePreview(file) {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = e => {
            imagePreview.src = e.target.result;
            previewContainer.classList.remove('hidden');
            dropText.classList.add('hidden');
            imageUrlInput.value = '';
        };
        reader.readAsDataURL(file);
    }

    imageUrlInput.addEventListener('input', (e) => {
        if (e.target.value.startsWith('http')) {
            imagePreview.src = e.target.value;
            previewContainer.classList.remove('hidden');
            dropText.classList.add('hidden');
            imageInput.value = '';
        }
    });
</script>
@endsection
