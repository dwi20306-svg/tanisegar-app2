@extends('layouts.app')

@section('title', 'Profil')

@section('content')
@php
    $unread = collect(config('dummy.notifications'))->where('read', false)->count();
    $cartCount = collect(config('dummy.cart'))->sum('qty');
@endphp
<div class="profile-layout">

  <div class="profile-card">
    <div class="av">🧑</div>
    <h3 style="margin:0">Andi Wijaya</h3>
    <span style="font-size:12px;color:var(--ink-soft)">Jakarta Selatan</span>
    <div class="role-tag">🛒 Akun Pembeli</div>
  </div>

  <div>
    <div class="stat-row">
      <div class="stat"><b>{{ count(config('dummy.orders')) }}</b><span>Pesanan</span></div>
      <div class="stat"><b>{{ $cartCount }}</b><span>Di Keranjang</span></div>
      <div class="stat"><b>3</b><span>Petani Favorit</span></div>
    </div>

    <div class="menu-item" onclick="openModal('modalAlamat')">📍 Alamat Pengiriman <span>›</span></div>
    <div class="menu-item" onclick="openModal('modalBayar')">💳 Metode Pembayaran <span>›</span></div>
    <div class="menu-item" onclick="openModal('modalUlasan')">⭐ Ulasan Saya <span>›</span></div>
    <div class="menu-item" onclick="openModal('modalNotif')">🔔 Notifikasi
      @if($unread)<span class="edit-b" style="border-color:var(--danger);color:var(--danger)">{{ $unread }} baru</span>@endif
      <span>›</span></div>
    <div class="menu-item" onclick="openModal('modalBantuan')">❓ Bantuan <span>›</span></div>
    <div class="menu-item" onclick="location.href='/login'" style="color:var(--danger)">🚪 Keluar <span>›</span></div>
  </div>

</div>
@endsection

@section('modals')

{{-- ALAMAT PENGIRIMAN --}}
<div class="modal-overlay" id="modalAlamat">
 <div class="modal-card" style="max-width:520px">
  <div class="modal-head"><h3 class="disp">Alamat Pengiriman</h3><button class="modal-close" type="button" onclick="closeModal('modalAlamat')">✕</button></div>

  @foreach(config('dummy.addresses') as $a)
  <div class="prod-manage">
    <div class="img">📍</div>
    <div class="info">
      <b style="font-size:14px">{{ $a['label'] }}@if($a['default']) <span style="color:var(--green);font-size:11px;font-weight:600">· Utama</span>@endif</b>
      <div class="stok">{{ $a['name'] }} · {{ $a['phone'] }}<br>{{ $a['address'] }}</div>
    </div>
    <div style="display:flex;flex-direction:column;gap:6px">
      @unless($a['default'])<button class="edit-b" type="button" onclick="toast('Alamat dijadikan utama')">Utamakan</button>@endunless
      <button class="edit-b" type="button" style="color:var(--danger)" onclick="toast('Alamat dihapus')">Hapus</button>
    </div>
  </div>
  @endforeach

  <div class="section-head" style="margin-top:18px"><h3>Tambah Alamat Baru</h3></div>
  <form onsubmit="event.preventDefault();toast('Alamat ditambahkan (belum tersimpan ke database)');return false;">
    <div class="field"><label>Label Alamat</label><input placeholder="Rumah / Kantor" required></div>
    <div class="field-row">
      <div class="field"><label>Nama Penerima</label><input placeholder="Nama lengkap" required></div>
      <div class="field"><label>No. HP</label><input placeholder="0812xxxxxxxx" required></div>
    </div>
    <div class="field"><label>Alamat Lengkap</label><input placeholder="Jalan, no rumah, kelurahan, kota" required></div>
    <button class="btn" type="submit">Simpan Alamat</button>
  </form>
 </div>
</div>

{{-- METODE PEMBAYARAN (hanya COD) --}}
<div class="modal-overlay" id="modalBayar">
 <div class="modal-card" style="max-width:520px">
  <div class="modal-head"><h3 class="disp">Metode Pembayaran</h3><button class="modal-close" type="button" onclick="closeModal('modalBayar')">✕</button></div>
  <div class="prod-manage">
    <div class="img">💵</div>
    <div class="info">
      <b style="font-size:14px">Bayar di Tempat (COD) <span style="color:var(--green);font-size:11px;font-weight:600">· Aktif</span></b>
      <div class="stok">Bayar tunai ke kurir saat pesanan sampai di alamatmu.</div>
    </div>
  </div>
  <div class="empty" style="padding:22px 10px 8px;font-size:13px"><div class="ic">🔜</div>Transfer bank dan e-wallet segera hadir.</div>
 </div>
</div>

{{-- ULASAN SAYA --}}
<div class="modal-overlay" id="modalUlasan">
 <div class="modal-card" style="max-width:520px">
  <div class="modal-head"><h3 class="disp">Ulasan Saya</h3><button class="modal-close" type="button" onclick="closeModal('modalUlasan')">✕</button></div>
  @forelse(config('dummy.reviews') as $r)
  <div class="order-card">
    <div class="row"><b>{{ $r['product'] }}</b><span style="color:var(--mango)">{{ str_repeat('★', $r['rating']) }}{{ str_repeat('☆', 5 - $r['rating']) }}</span></div>
    <div class="row" style="color:var(--ink-soft)"><span>Petani: {{ $r['farmer'] }}</span><span>{{ $r['date'] }}</span></div>
    <div style="font-size:13px;color:var(--ink-soft);margin-top:4px">"{{ $r['comment'] }}"</div>
  </div>
  @empty
  <div class="empty"><div class="ic">⭐</div>Kamu belum menulis ulasan</div>
  @endforelse
 </div>
</div>

{{-- NOTIFIKASI --}}
<div class="modal-overlay" id="modalNotif">
 <div class="modal-card" style="max-width:520px">
  <div class="modal-head"><h3 class="disp">Notifikasi</h3><button class="modal-close" type="button" onclick="closeModal('modalNotif')">✕</button></div>
  @foreach(config('dummy.notifications') as $n)
  <div class="menu-item notif-item" style="align-items:flex-start;{{ $n['read'] ? 'opacity:.6' : '' }}" onclick="this.style.opacity='.6'">
    <div style="display:flex;gap:12px">
      <span style="font-size:18px">{{ $n['icon'] }}</span>
      <div><b style="font-size:13.5px">{{ $n['title'] }}</b><div style="font-size:12.5px;color:var(--ink-soft)">{{ $n['desc'] }}</div></div>
    </div>
    <span style="font-size:11px;color:var(--ink-soft);white-space:nowrap">{{ $n['time'] }}</span>
  </div>
  @endforeach
  <button class="btn outline" type="button" style="width:100%;margin-top:14px"
    onclick="document.querySelectorAll('.notif-item').forEach(function(e){e.style.opacity='.6'});toast('Semua ditandai terbaca')">Tandai semua terbaca</button>
 </div>
</div>

{{-- BANTUAN --}}
<div class="modal-overlay" id="modalBantuan">
 <div class="modal-card" style="max-width:520px">
  <div class="modal-head"><h3 class="disp">Bantuan</h3><button class="modal-close" type="button" onclick="closeModal('modalBantuan')">✕</button></div>
  <div class="menu-item" onclick="toast('Menghubungkan ke Live Chat CS...')">💬 Chat dengan Customer Service <span>›</span></div>
  <details style="padding:14px 4px;border-bottom:1px solid var(--line)"><summary style="cursor:pointer;font-size:14px;font-weight:500">Bagaimana cara melacak pesanan saya?</summary><p style="font-size:13px;color:var(--ink-soft);margin:8px 0 0">Buka menu Pesanan untuk melihat status pesananmu secara langsung.</p></details>
  <details style="padding:14px 4px;border-bottom:1px solid var(--line)"><summary style="cursor:pointer;font-size:14px;font-weight:500">Bagaimana cara membatalkan pesanan?</summary><p style="font-size:13px;color:var(--ink-soft);margin:8px 0 0">Hubungi petani lewat menu Chat sebelum pesanan diproses untuk membatalkan.</p></details>
  <details style="padding:14px 4px;border-bottom:1px solid var(--line)"><summary style="cursor:pointer;font-size:14px;font-weight:500">Metode pembayaran apa saja yang tersedia?</summary><p style="font-size:13px;color:var(--ink-soft);margin:8px 0 0">Saat ini hanya bayar di tempat (COD). Metode lain segera hadir.</p></details>
  <div class="menu-item" onclick="toast('Membuka halaman FAQ lengkap...')">📖 Lihat semua FAQ <span>›</span></div>
 </div>
</div>

@endsection