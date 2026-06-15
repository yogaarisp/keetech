@extends('admin.layouts.app')
@section('title', 'Pesan Masuk')
@section('content')

<div style="margin-bottom:28px; display:flex; align-items:flex-end; justify-content:space-between; gap:16px; flex-wrap:wrap;">
    <div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:var(--teal);margin-bottom:6px;">
            Komunikasi Klien
        </div>
        <h2 style="font-size:26px;font-weight:800;color:#fff;letter-spacing:-0.02em;margin:0 0 6px;">
            Pesan Masuk
        </h2>
        <p style="font-size:13px;color:var(--text-dim);margin:0;">
            Kelola pesan dan pertanyaan dari pengunjung website.
        </p>
    </div>
    <div style="display:flex;align-items:center;gap:10px;">
        <div style="font-size:12px;font-weight:700;color:var(--teal);background:rgba(45,212,191,0.1);border:1px solid rgba(45,212,191,0.2);padding:8px 16px;border-radius:10px;">
            Total: {{ $contacts->total() }} Pesan
        </div>
    </div>
</div>

<div class="admin-card" style="overflow:hidden;">
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Pengirim</th>
                    <th>Layanan Diminati</th>
                    <th style="width:140px;">Waktu Masuk</th>
                    <th style="width:120px;text-align:center;">Status</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr style="{{ !$contact->is_read ? 'background:rgba(45,212,191,0.03);' : '' }}">
                    <td>
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:16px;flex-shrink:0;{{ !$contact->is_read ? 'background:var(--teal);color:#000;box-shadow:0 0 12px rgba(45,212,191,0.3);' : 'background:var(--bg-hover);color:var(--text-faint);border:1px solid var(--border);' }}">
                                {{ substr($contact->name, 0, 1) }}
                            </div>
                            <div>
                                <div style="font-size:14px;font-weight:700;color:#fff;display:flex;align-items:center;gap:8px;">
                                    {{ $contact->name }}
                                    @if(!$contact->is_read)
                                        <span style="background:rgba(239,68,68,0.1);color:var(--red);border:1px solid rgba(239,68,68,0.2);font-size:9px;font-weight:800;text-transform:uppercase;padding:2px 6px;border-radius:4px;">Baru</span>
                                    @endif
                                </div>
                                <div style="font-size:11px;color:var(--text-dim);margin-top:2px;">{{ $contact->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-gray" style="text-transform:none;font-weight:600;letter-spacing:0;">{{ $contact->service_type }}</span>
                    </td>
                    <td>
                        <div style="font-size:12px;font-weight:700;color:#fff;">{{ $contact->created_at->format('d M Y') }}</div>
                        <div style="font-size:10px;color:var(--text-dim);margin-top:2px;font-weight:600;">{{ $contact->created_at->format('H:i') }} WIB</div>
                    </td>
                    <td style="text-align:center;">
                        @if(!$contact->is_read)
                            <span class="badge badge-teal" style="display:inline-flex;align-items:center;gap:4px;">
                                <div style="width:6px;height:6px;background:#fff;border-radius:50%;"></div> Belum Dibaca
                            </span>
                        @else
                            <span class="badge badge-gray" style="display:inline-flex;align-items:center;gap:4px;">
                                <span class="material-symbols-outlined" style="font-size:12px;">done_all</span> Dibaca
                            </span>
                        @endif
                    </td>
                    <td style="text-align:right;">
                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="icon-btn" style="color:var(--teal);border-color:rgba(45,212,191,0.2);" title="Lihat Detail">
                                <span class="material-symbols-outlined">visibility</span>
                            </a>
                            <form id="delete-form-{{ $contact->id }}" action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="icon-btn" style="color:var(--red);border-color:rgba(239,68,68,0.2);" 
                                data-destroy
                                data-form-id="delete-form-{{ $contact->id }}"
                                data-confirm="Apakah Anda yakin ingin menghapus pesan dari '{{ $contact->name }}'?"
                                title="Hapus">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:60px 20px;">
                        <div style="width:64px;height:64px;border-radius:20px;background:var(--bg-hover);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                            <span class="material-symbols-outlined" style="font-size:32px;color:var(--text-faint);">mark_email_read</span>
                        </div>
                        <h4 style="font-size:16px;font-weight:800;color:#fff;margin:0 0 4px;">Kotak Masuk Kosong</h4>
                        <p style="font-size:12px;color:var(--text-dim);margin:0;">Belum ada pesan yang masuk dari pengunjung.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($contacts->hasPages())
        <div style="padding:20px 24px;border-top:1px solid var(--border);">
            {{ $contacts->links() }}
        </div>
    @endif
</div>
@endsection
