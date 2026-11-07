@extends('layouts.app')

@section('title', 'Profil')

@section('content')
@php
    $farmerId = 1; // sementara: Pak Budi
    $farmer = config('dummy.farmers')[$farmerId];
    $myProducts = collect(config('dummy.products'))->where('farmer', $farmerId)->values();
@endphp
<div class="profile-layout">

  <div class="profile-card">
    <div class="av">🧑‍🌾</div>
    <h3 style="margin:0">{{ $farmer['name'] }}</h3>
    <span style="font-size:12px;color:var(--ink-soft)">{{ $farmer['loc'] }} · ★ {{ $farmer['rating'] }}</span>
    <div class="role-tag">🌾 Akun Petani</div>
  </div>

  <div>
    <div class="stat-row">
      <div class="stat"><b>{{ $myProducts->count() }}</b><span>Produk</span></div>
      <div class="stat"><b>{{ count(config('dummy.incoming')) }}</b><span>Pesanan Masuk</span></div>
      <div class="stat"><b>{{ count(config('dummy.buyer_chats')) }}</b><span>Percakapan</span></div>
    </div>

    <div class="section-head"><h3>Kelola Produk</h3><a style="cursor:pointer" onclick="openProductForm()">+ Tambah</a></div>
    @forelse($myProducts as $p)
      @include('partials.product-row', ['p' => $p])
    @empty
      <div class="empty" style="padding:24px"><div class="ic">🌱</div>Belum ada produk, mulai tambahkan</div>
    @endforelse

    <div class="menu-item" onclick="location.href='/petani/pesanan'">📦 Pesanan Masuk <span>›</span></div>
    <div class="menu-item">💰 Pendapatan <span>›</span></div>
    <div class="menu-item">❓ Bantuan <span>›</span></div>
    <div class="menu-item" onclick="location.href='/login'" style="color:var(--danger)">🚪 Keluar <span>›</span></div>
  </div>

</div>
@endsection

@section('modals')
  @include('partials.product-modal')
@endsection