@extends('admin.layouts.app')
@section('title', 'Kategori Proyek')
@section('content')

<div style="margin-bottom:28px; display:flex; align-items:flex-end; justify-content:space-between; gap:16px; flex-wrap:wrap;">
    <div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:var(--teal);margin-bottom:6px;">
            Sistem Klasifikasi
        </div>
        <h2 style="font-size:26px;font-weight:800;color:#fff;letter-spacing:-0.02em;margin:0 0 6px;">
            Kategori Proyek
        </h2>
        <p style="font-size:13px;color:var(--text-dim);margin:0;">
            Kelola kategori untuk mengelompokkan portofolio.
        </p>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="{{ route('admin.portfolio-categories.create') }}" class="btn-primary">
            <span class="material-symbols-outlined" style="font-size:16px">add</span>
            Tambah Kategori
        </a>
    </div>
</div>

<div class="admin-card" style="overflow:hidden;">
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 100px;">Media</th>
                    <th>Nama Kategori</th>
                    <th style="text-align:center;">Slug</th>
                    <th style="text-align:center;">Jumlah Proyek</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>
                        @if($category->image)
                            <div style="width:64px;height:48px;border-radius:10px;overflow:hidden;border:1px solid var(--border);">
                                <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                        @else
                            <div style="width:64px;height:48px;border-radius:10px;background:var(--bg-hover);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-faint);">
                                <span class="material-symbols-outlined" style="font-size:18px;">image_not_supported</span>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-size:14px;font-weight:700;color:#fff;">{{ $category->name }}</div>
                        <div style="font-size:11px;color:var(--text-dim);margin-top:2px;">{{ Str::limit($category->description, 60) ?: 'Tidak ada deskripsi' }}</div>
                    </td>
                    <td style="text-align:center;">
                        <span class="badge badge-gray" style="text-transform:none;font-weight:600;letter-spacing:0;">{{ $category->slug }}</span>
                    </td>
                    <td style="text-align:center;">
                        <div style="display:flex;align-items:center;justify-content:center;gap:6px;">
                            <span class="material-symbols-outlined" style="color:var(--teal);font-size:16px;">inventory_2</span>
                            <span style="font-size:13px;font-weight:700;color:#fff;">{{ $category->portfolios->count() }}</span>
                        </div>
                    </td>
                    <td style="text-align:right;">
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;">
                            <a href="{{ route('admin.portfolio-categories.edit', $category) }}" class="icon-btn" title="Edit">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            <form id="delete-form-{{ $category->id }}" action="{{ route('admin.portfolio-categories.destroy', $category) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="icon-btn" style="color:var(--red);border-color:rgba(239,68,68,0.2);" 
                                data-destroy
                                data-form-id="delete-form-{{ $category->id }}"
                                data-confirm="Apakah Anda yakin ingin menghapus kategori '{{ $category->name }}'?"
                                title="Hapus">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:40px;color:var(--text-faint);">
                        <span class="material-symbols-outlined" style="font-size:32px;display:block;margin-bottom:8px;opacity:0.4;">category</span>
                        Belum ada data kategori
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
