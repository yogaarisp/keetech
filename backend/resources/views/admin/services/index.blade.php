@extends('admin.layouts.app')
@section('title', 'Layanan')
@section('content')

<div style="margin-bottom:28px; display:flex; align-items:flex-end; justify-content:space-between; gap:16px; flex-wrap:wrap;">
    <div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:var(--teal);margin-bottom:6px;">
            Katalog Layanan
        </div>
        <h2 style="font-size:26px;font-weight:800;color:#fff;letter-spacing:-0.02em;margin:0 0 6px;">
            Daftar Layanan
        </h2>
        <p style="font-size:13px;color:var(--text-dim);margin:0;">
            Kelola layanan yang ditawarkan kepada klien.
        </p>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="{{ route('admin.services.create') }}" class="btn-primary">
            <span class="material-symbols-outlined" style="font-size:16px">add</span>
            Tambah Layanan
        </a>
    </div>
</div>

<div class="admin-card" style="overflow:hidden;">
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 80px;">Icon</th>
                    <th>Informasi Layanan</th>
                    <th style="text-align:center; width:100px;">Urutan</th>
                    <th style="width: 120px;">Status</th>
                    <th style="text-align:right; width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>
                        <div style="width:40px;height:40px;border-radius:10px;background:var(--teal-dim);display:flex;align-items:center;justify-content:center;color:var(--teal);">
                            <span class="material-symbols-outlined">{{ $service->icon }}</span>
                        </div>
                    </td>
                    <td>
                        <div style="font-size:14px;font-weight:700;color:#fff;">{{ $service->title }}</div>
                        <div style="font-size:11px;color:var(--text-dim);margin-top:2px;">{{ Str::limit($service->description, 60) }}</div>
                    </td>
                    <td style="text-align:center;">
                        <span class="badge badge-gray" style="font-size:12px;padding:4px 12px;">{{ $service->sort_order }}</span>
                    </td>
                    <td>
                        @if($service->is_active)
                            <span class="badge badge-teal">Aktif</span>
                        @else
                            <span class="badge badge-gray">Draft</span>
                        @endif
                    </td>
                    <td style="text-align:right;">
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;">
                            <a href="{{ route('admin.services.edit', $service) }}" class="icon-btn" title="Edit">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            <form id="delete-form-{{ $service->id }}" action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="icon-btn" style="color:var(--red);border-color:rgba(239,68,68,0.2);" 
                                data-destroy
                                data-form-id="delete-form-{{ $service->id }}"
                                data-confirm="Apakah Anda yakin ingin menghapus layanan '{{ $service->title }}'?"
                                title="Hapus">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:40px;color:var(--text-faint);">
                        <span class="material-symbols-outlined" style="font-size:32px;display:block;margin-bottom:8px;opacity:0.4;">inbox</span>
                        Belum ada data layanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
