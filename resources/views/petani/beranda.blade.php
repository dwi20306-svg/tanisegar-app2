@extends('layouts.app')

@section('title', 'Dashboard Petani')

@section('content')
@php
    $rp = fn ($n) => 'Rp' . number_format($n, 0, ',', '.');
    $farmerId = 1; // sementara: Pak Budi. Nanti dari akun yang login
    $myProducts = collect(config('dummy.products'))->where('farmer', $farmerId)->values();
    $incoming = collect(config('dummy.incoming'));
    $pendapatan = $incoming->where('status', '!=', 'Ditolak')->sum('total');
    $rating = config('dummy.farmers')[$farmerId]['rating'];
@endphp

<div class="hero" style="padding:28px 36px">
  <div>
    <span class="tag" id="greetTag">👋 Selamat Datang</span>
    <h2 class="disp" style="font-size:24px">{{ config('dummy.farmers')[$farmerId]['name'] }}</h2>
    <p>Begini ringkasan lapakmu hari ini</p>
    <button class="btn" type="button" onclick="openProductForm()">+ Tambah Produk</button>
  </div>
  <div class="art">🧑‍🌾🌾</div>
</div>

<div class="stat-row">
  <div class="stat"><b>{{ $myProducts->count() }}</b><span>Produk Aktif</span></div>
  <div class="stat"><b>{{ $incoming->where('status', 'Baru')->count() }}</b><span>Pesanan Baru</span></div>
  <div class="stat"><b>{{ $rp($pendapatan) }}</b><span>Pendapatan Bulan Ini</span></div>
  <div class="stat"><b>★ {{ $rating }}</b><span>Rating Toko</span></div>
</div>

<div class="section-head"><h3>Pesanan Masuk Terbaru</h3><a href="/petani/pesanan">Lihat Semua →</a></div>
@forelse($incoming->take(3) as $o)
<div class="order-card">
  <div class="row"><b>#{{ $o['id'] }} · {{ $o['buyer'] }}</b><span class="status {{ $o['status'] === 'Selesai' ? 'selesai' : 'proses' }}">{{ $o['status'] }}</span></div>
  <div class="row" style="color:var(--ink-soft)"><span>{{ $o['items'] }}</span></div>
  <div class="row"><span style="color:var(--ink-soft)">{{ $o['date'] }}</span><b>{{ $rp($o['total']) }}</b></div>
</div>
@empty
<div class="empty"><div class="ic">📦</div>Belum ada pesanan masuk</div>
@endforelse

<div class="section-head"><h3>Produk Saya</h3><a style="cursor:pointer" onclick="openProductForm()">+ Tambah Produk</a></div>
@forelse($myProducts as $p)
  @include('partials.product-row', ['p' => $p])
@empty
<div class="empty" style="padding:24px"><div class="ic">🌱</div>Belum ada produk, mulai tambahkan</div>
@endforelse
@endsection

@section('modals')
  @include('partials.product-modal')
@endsection

@push('scripts')
<script>TaniSegar.initGreeting('greetTag');</script>
@endpush