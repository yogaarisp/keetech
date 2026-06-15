@extends('admin.layouts.app')
@section('title', 'Portofolio')
@section('content')

<div style="margin-bottom:28px; display:flex; align-items:flex-end; justify-content:space-between; gap:16px; flex-wrap:wrap;">
    <div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:var(--teal);margin-bottom:6px;">
            Showcase Proyek
        </div>
        <h2 style="font-size:26px;font-weight:800;color:#fff;letter-spacing:-0.02em;margin:0 0 6px;">
            Portofolio
        </h2>
        <p style="font-size:13px;color:var(--text-dim);margin:0;">
            Kelola daftar portofolio proyek yang pernah dikerjakan.
        </p>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="{{ route('admin.portfolios.create') }}" class="btn-primary">
            <span class="material-symbols-outlined" style="font-size:16px">add</span>
            Tambah Proyek
        </a>
    </div>
</div>

<div class="admin-card" style="overflow:hidden;">
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 120px;">Media</th>
                    <th>Detail Proyek</th>
                    <th style="text-align:center;">Kategori</th>
                    <th style="width: 120px;">Status</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($portfolios as $portfolio)
                <tr>
                    <td>
                        @if($portfolio->image)
                            <div style="width:80px;height:56px;border-radius:10px;overflow:hidden;border:1px solid var(--border);">
                                <img src="{{ $portfolio->image }}" alt="{{ $portfolio->title }}" style="width:100%;height:100%;object-fit:cover;">
                            </div>
                        @else
                            <div style="width:80px;height:56px;border-radius:10px;background:var(--bg-hover);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-faint);">
                                <span class="material-symbols-outlined" style="font-size:18px;">image_not_supported</span>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-size:14px;font-weight:700;color:#fff;">{{ $portfolio->title }}</div>
                        <div style="font-size:11px;color:var(--teal);margin-top:2px;font-weight:600;display:flex;align-items:center;gap:4px;">
                            <span class="material-symbols-outlined" style="font-size:12px;">corporate_fare</span>
                            {{ $portfolio->client_name ?? 'Klien Internal' }}
                        </div>
                    </td>
                    <td style="text-align:center;">
                        <span class="badge badge-gray" style="text-transform:none;letter-spacing:0;font-weight:600;">{{ $portfolio->category->name ?? 'Tanpa Kategori' }}</span>
                    </td>
                    <td>
                        @if($portfolio->is_active)
                            <span class="badge badge-teal">Publish</span>
                        @else
                            <span class="badge badge-gray">Draft</span>
                        @endif
                    </td>
                    <td style="text-align:right;">
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;">
                            <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="icon-btn" title="Edit">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            <form id="delete-form-{{ $portfolio->id }}" action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="icon-btn" style="color:var(--red);border-color:rgba(239,68,68,0.2);" 
                                data-destroy
                                data-form-id="delete-form-{{ $portfolio->id }}"
                                data-confirm="Apakah Anda yakin ingin menghapus proyek '{{ $portfolio->title }}'?"
                                title="Hapus">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:40px;color:var(--text-faint);">
                        <span class="material-symbols-outlined" style="font-size:32px;display:block;margin-bottom:8px;opacity:0.4;">auto_awesome_motion</span>
                        Belum ada data portofolio
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
