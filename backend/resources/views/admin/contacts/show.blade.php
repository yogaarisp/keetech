@extends('admin.layouts.app')
@section('title', 'Detail Pesan Masuk')
@section('content')

<div style="margin-bottom:28px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <a href="{{ route('admin.contacts.index') }}" class="icon-btn" style="width:36px;height:36px;border-radius:10px;">
            <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
        </a>
        <div>
            <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:var(--teal);margin-bottom:4px;">
                Detail Komunikasi
            </div>
            <h2 style="font-size:20px;font-weight:800;color:#fff;margin:0;">
                Baca Pesan Klien
            </h2>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr;gap:24px;">
    @if(!$contact->is_read)
        <div style="background:rgba(45,212,191,0.1);border:1px solid rgba(45,212,191,0.2);padding:16px;border-radius:12px;display:flex;align-items:center;gap:12px;color:var(--teal);">
            <span class="material-symbols-outlined">mark_email_unread</span>
            <div>
                <div style="font-size:13px;font-weight:800;">Pesan Baru</div>
                <div style="font-size:11px;opacity:0.8;">Pesan ini ditandai sebagai belum dibaca. (Kini telah dibuka)</div>
            </div>
        </div>
    @endif

    <div class="admin-card" style="display:grid;grid-template-columns:1fr 2fr;gap:0;">
        <div style="padding:32px;border-right:1px solid var(--border);">
            <div style="display:flex;flex-direction:column;align-items:center;text-align:center;">
                <div style="width:80px;height:80px;border-radius:50%;background:var(--bg-hover);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--teal);font-size:32px;font-weight:800;margin-bottom:16px;">
                    {{ substr($contact->name, 0, 1) }}
                </div>
                <h3 style="font-size:18px;font-weight:800;color:#fff;margin:0 0 4px;">{{ $contact->name }}</h3>
                <a href="mailto:{{ $contact->email }}" style="font-size:12px;font-weight:600;color:var(--teal);text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
                    <span class="material-symbols-outlined" style="font-size:14px;">mail</span> {{ $contact->email }}
                </a>

                <div style="width:100%;height:1px;background:var(--border);margin:24px 0;"></div>

                <div style="width:100%;text-align:left;display:flex;flex-direction:column;gap:16px;">
                    <div>
                        <div style="font-size:10px;font-weight:700;color:var(--text-faint);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:4px;">Layanan Diminati</div>
                        <div style="font-size:13px;font-weight:600;color:#fff;">{{ $contact->service_type }}</div>
                    </div>
                    <div>
                        <div style="font-size:10px;font-weight:700;color:var(--text-faint);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:4px;">Tanggal Masuk</div>
                        <div style="font-size:13px;font-weight:600;color:#fff;">{{ $contact->created_at->format('d M Y') }}</div>
                    </div>
                    <div>
                        <div style="font-size:10px;font-weight:700;color:var(--text-faint);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:4px;">Waktu (WIB)</div>
                        <div style="font-size:13px;font-weight:600;color:#fff;">{{ $contact->created_at->format('H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div style="padding:32px;display:flex;flex-direction:column;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
                <span class="material-symbols-outlined" style="color:var(--teal);">forum</span>
                <div style="font-size:14px;font-weight:700;color:#fff;">Isi Pesan</div>
            </div>

            <div style="background:var(--bg-hover);border:1px solid var(--border);border-radius:16px;padding:24px;flex-grow:1;position:relative;">
                <span class="material-symbols-outlined" style="position:absolute;top:16px;right:16px;font-size:48px;color:var(--text-faint);opacity:0.2;">format_quote</span>
                <p style="font-size:14px;line-height:1.8;color:var(--text-dim);white-space:pre-wrap;margin:0;position:relative;z-index:1;">{{ $contact->message }}</p>
            </div>

            <div style="display:flex;gap:12px;margin-top:24px;">
                <a href="mailto:{{ $contact->email }}" class="btn-primary" style="flex-grow:1;justify-content:center;">
                    <span class="material-symbols-outlined" style="font-size:18px;">reply</span> Balas via Email
                </a>
                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="icon-btn" style="width:44px;height:44px;color:var(--red);border-color:rgba(239,68,68,0.2);">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
