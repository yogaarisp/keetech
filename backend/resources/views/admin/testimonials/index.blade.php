@extends('admin.layouts.app')
@section('title', 'Testimoni Klien')
@section('content')

<div style="margin-bottom:28px; display:flex; align-items:flex-end; justify-content:space-between; gap:16px; flex-wrap:wrap;">
    <div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:var(--teal);margin-bottom:6px;">
            Review Pelanggan
        </div>
        <h2 style="font-size:26px;font-weight:800;color:#fff;letter-spacing:-0.02em;margin:0 0 6px;">
            Testimoni Klien
        </h2>
        <p style="font-size:13px;color:var(--text-dim);margin:0;">
            Kelola ulasan dan testimoni dari klien yang pernah bekerja sama.
        </p>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="{{ route('admin.testimonials.create') }}" class="btn-primary">
            <span class="material-symbols-outlined" style="font-size:16px">add</span>
            Tambah Testimoni
        </a>
    </div>
</div>

<div class="admin-card" style="overflow:hidden;">
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 80px; text-align:center;">Foto</th>
                    <th>Identitas Klien</th>
                    <th>Isi Testimoni</th>
                    <th style="width: 120px; text-align:center;">Status</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                <tr>
                    <td style="text-align:center;">
                        @if($testimonial->client_photo)
                            <div style="width:40px;height:40px;border-radius:50%;overflow:hidden;border:1px solid var(--border);margin:0 auto;">
                                <img src="{{ str_starts_with($testimonial->client_photo, 'http') ? $testimonial->client_photo : asset('storage/' . $testimonial->client_photo) }}" alt="{{ $testimonial->client_name }}" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                        @else
                            <div style="width:40px;height:40px;border-radius:50%;background:var(--bg-hover);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--teal);font-weight:800;margin:0 auto;">
                                {{ substr($testimonial->client_name, 0, 1) }}
                            </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-size:14px;font-weight:700;color:#fff;">{{ $testimonial->client_name }}</div>
                        <div style="font-size:11px;color:var(--teal);margin-top:2px;display:flex;align-items:center;gap:4px;font-weight:600;">
                            <span class="material-symbols-outlined" style="font-size:12px;">star_half</span>
                            {{ $testimonial->client_role ?? 'Klien' }} ({{ $testimonial->rating }} Bintang)
                        </div>
                    </td>
                    <td>
                        <div style="font-size:12px;color:var(--text-dim);font-style:italic;line-height:1.5;">
                            "{{ Str::limit($testimonial->content, 60) }}"
                        </div>
                    </td>
                    <td style="text-align:center;">
                        @if($testimonial->is_active)
                            <span class="badge badge-teal">Tampil</span>
                        @else
                            <span class="badge badge-gray">Sembunyi</span>
                        @endif
                    </td>
                    <td style="text-align:right;">
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="icon-btn" title="Edit">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            <form id="delete-form-{{ $testimonial->id }}" action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="icon-btn" style="color:var(--red);border-color:rgba(239,68,68,0.2);" 
                                data-destroy
                                data-form-id="delete-form-{{ $testimonial->id }}"
                                data-confirm="Apakah Anda yakin ingin menghapus testimoni dari '{{ $testimonial->client_name }}'?"
                                title="Hapus">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:40px;color:var(--text-faint);">
                        <span class="material-symbols-outlined" style="font-size:32px;display:block;margin-bottom:8px;opacity:0.4;">reviews</span>
                        Belum ada data testimoni
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
