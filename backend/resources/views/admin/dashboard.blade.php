@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')

{{-- Page Header --}}
<div style="margin-bottom:28px; display:flex; align-items:flex-end; justify-content:space-between; gap:16px; flex-wrap:wrap;">
    <div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.18em;color:var(--teal);margin-bottom:6px;">
            Selamat Datang Kembali 👋
        </div>
        <h2 style="font-size:26px;font-weight:800;color:#fff;letter-spacing:-0.02em;margin:0 0 6px;">
            {{ explode(' ', auth()->user()->name)[0] }}
        </h2>
        <p style="font-size:13px;color:var(--text-dim);margin:0;">
            Berikut ringkasan aktivitas sistem KeeTech hari ini.
        </p>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <a href="{{ route('admin.services.create') }}" class="btn-secondary">
            <span class="material-symbols-outlined" style="font-size:16px">add_circle</span>
            Tambah Layanan
        </a>
        <a href="{{ route('admin.portfolios.create') }}" class="btn-primary">
            <span class="material-symbols-outlined" style="font-size:16px">add</span>
            Proyek Baru
        </a>
    </div>
</div>

{{-- Stats Grid --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:28px;">

    {{-- Services --}}
    <div class="admin-card" style="padding:20px;position:relative;overflow:hidden;">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(45,212,191,0.12);display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">build_circle</span>
        </div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.14em;color:var(--text-faint);margin-bottom:6px;">Layanan Aktif</div>
        <div style="display:flex;align-items:baseline;gap:8px;">
            <span style="font-size:32px;font-weight:800;color:#fff;line-height:1">{{ $stats['services'] }}</span>
            <span class="badge badge-teal">Live</span>
        </div>
    </div>

    {{-- Contacts --}}
    <div class="admin-card" style="padding:20px;position:relative;overflow:hidden;">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(45,212,191,0.12);display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">mail</span>
        </div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.14em;color:var(--text-faint);margin-bottom:6px;">Pesan Baru</div>
        <div style="display:flex;align-items:baseline;gap:8px;">
            <span style="font-size:32px;font-weight:800;color:#fff;line-height:1">{{ $stats['unread_contacts'] }}</span>
            @if($stats['unread_contacts'] > 0)
                <span class="badge badge-red">Baru</span>
            @else
                <span class="badge badge-gray">Kosong</span>
            @endif
        </div>
    </div>

    {{-- Portfolio --}}
    <div class="admin-card" style="padding:20px;position:relative;overflow:hidden;">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(45,212,191,0.12);display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">auto_awesome</span>
        </div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.14em;color:var(--text-faint);margin-bottom:6px;">Proyek Portofolio</div>
        <div style="display:flex;align-items:baseline;gap:8px;">
            <span style="font-size:32px;font-weight:800;color:#fff;line-height:1">{{ $stats['portfolios'] }}</span>
            <span class="badge badge-gray">Published</span>
        </div>
    </div>

    {{-- Testimonials --}}
    <div class="admin-card" style="padding:20px;position:relative;overflow:hidden;border-color:rgba(45,212,191,0.2);background:rgba(45,212,191,0.06);">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(45,212,191,0.15);display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
            <span class="material-symbols-outlined" style="color:var(--teal);font-size:20px">format_quote</span>
        </div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.14em;color:var(--teal);margin-bottom:6px;">Testimoni Klien</div>
        <div style="display:flex;align-items:baseline;gap:8px;">
            <span style="font-size:32px;font-weight:800;color:#fff;line-height:1">{{ $stats['testimonials'] }}</span>
            <span class="badge badge-teal">✓ Aktif</span>
        </div>
    </div>

</div>

{{-- Main Grid --}}
<div style="display:grid;grid-template-columns:1fr 320px;gap:20px;" class="dashboard-grid">

    {{-- Recent Contacts --}}
    <div class="admin-card" style="overflow:hidden;">
        <div style="padding:20px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;">
            <div>
                <div style="font-size:15px;font-weight:700;color:#fff;">Pesan Masuk Terbaru</div>
                <div style="font-size:11px;color:var(--text-faint);margin-top:2px;">Permintaan konsultasi dari pengunjung</div>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="btn-secondary" style="padding:7px 14px;font-size:12px;">
                Lihat Semua
            </a>
        </div>
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Pengirim</th>
                        <th>Jenis Layanan</th>
                        <th>Tanggal</th>
                        <th style="text-align:right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_contacts as $contact)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:34px;height:34px;border-radius:8px;background:var(--teal-dim);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:var(--teal);flex-shrink:0;">
                                    {{ strtoupper(substr($contact->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-size:13px;font-weight:600;color:#fff;">{{ $contact->name }}</div>
                                    <div style="font-size:11px;color:var(--text-faint);">{{ $contact->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-teal">{{ $contact->service_type }}</span>
                        </td>
                        <td style="font-size:12px;">{{ $contact->created_at->format('d M Y') }}</td>
                        <td style="text-align:right;">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="btn-secondary" style="padding:6px 14px;font-size:11px;">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center;padding:40px;color:var(--text-faint);">
                            <span class="material-symbols-outlined" style="font-size:32px;display:block;margin-bottom:8px;opacity:0.4;">inbox</span>
                            Belum ada pesan masuk
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Links Panel --}}
    <div style="display:flex;flex-direction:column;gap:16px;">

        {{-- Quick Nav --}}
        <div class="admin-card" style="padding:20px;">
            <div style="font-size:13px;font-weight:700;color:#fff;margin-bottom:16px;">Akses Cepat</div>
            <div style="display:flex;flex-direction:column;gap:4px;">
                @php
                    $quickLinks = [
                        ['label' => 'Kelola Layanan', 'href' => route('admin.services.index'), 'icon' => 'build_circle'],
                        ['label' => 'Tambah Portofolio', 'href' => route('admin.portfolios.create'), 'icon' => 'add_photo_alternate'],
                        ['label' => 'Lihat Testimoni', 'href' => route('admin.testimonials.index'), 'icon' => 'format_quote'],
                        ['label' => 'Pengaturan Situs', 'href' => route('admin.settings.index'), 'icon' => 'tune'],
                    ];
                @endphp

                @foreach($quickLinks as $link)
                <a href="{{ $link['href'] }}" style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:9px;text-decoration:none;color:var(--text-dim);font-size:13px;font-weight:600;transition:all 0.15s;"
                    onmouseenter="this.style.background='var(--bg-hover)';this.style.color='#fff'"
                    onmouseleave="this.style.background='none';this.style.color='var(--text-dim)'">
                    <span class="material-symbols-outlined" style="font-size:17px;color:var(--teal)">{{ $link['icon'] }}</span>
                    {{ $link['label'] }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- System Info --}}
        <div class="admin-card" style="padding:20px;">
            <div style="font-size:13px;font-weight:700;color:#fff;margin-bottom:16px;">Info Sistem</div>
            <div style="display:flex;flex-direction:column;gap:12px;">
                @php
                    $infos = [
                        ['label' => 'Status Server', 'value' => 'Online', 'ok' => true],
                        ['label' => 'Database', 'value' => 'Terhubung', 'ok' => true],
                        ['label' => 'Versi App', 'value' => 'v1.0.0', 'ok' => true],
                    ];
                @endphp
                @foreach($infos as $info)
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:12px;color:var(--text-dim);">{{ $info['label'] }}</span>
                    <span class="badge {{ $info['ok'] ? 'badge-teal' : 'badge-red' }}">{{ $info['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<style>
@media (max-width: 900px) {
    .dashboard-grid { grid-template-columns: 1fr !important; }
}
</style>

@endsection
