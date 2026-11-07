@extends('layouts.app')

@section('title', 'Beranda')

@section('topleft')
<span class="loc">📍 Antar ke Jakarta Selatan ▾</span>
@endsection

@section('topright')
<div class="search"><span>🔍</span><input placeholder="Cari sayur, buah, beras..."></div>
@endsection

@section('content')
<div class="hero">
  <div>
    <span class="tag">Panen Hari Ini</span><span class="tag">Gratis Ongkir</span>
    <h2 class="disp">Segar dari Kebun,<br>Langsung ke Mejamu</h2>
    <p>200+ petani lokal Indonesia siap kirim ke pintumu</p>
    <button class="btn" onclick="location.href='/jelajahi'">Belanja Sekarang →</button>
  </div>
  <div class="art">🥬🍊🌾</div>
</div>

<div class="chips">
  <div class="chip active">Semua</div>
  <div class="chip" onclick="location.href='/jelajahi?cat=Buah'">Buah</div>
  <div class="chip" onclick="location.href='/jelajahi?cat=Biji-bijian'">Biji-bijian</div>
  <div class="chip" onclick="location.href='/jelajahi?cat=Organik'">Organik</div>
  <div class="chip" onclick="location.href='/jelajahi?cat=Paket'">Paket</div>
</div>

<div class="section-head"><h3>Petani Pilihan</h3><a href="/chat">Lihat Semua →</a></div>
<div class="farmers-row">
  @foreach(config('dummy.farmers') as $f)
  <div class="farmer-card">
    <div class="av">{{ $f['emoji'] }}</div>
    <div class="name">{{ $f['name'] }}</div>
    <div class="loc">{{ $f['loc'] }}</div>
    <div class="rate">★ {{ $f['rating'] }}</div>
    <button class="mini-btn" onclick="location.href='/chat?f={{ $f['id'] }}'">💬 Chat</button>
  </div>
  @endforeach
</div>

<div class="section-head"><h3>Produk Segar</h3><a href="/jelajahi">Semua →</a></div>
<div class="grid">
  @foreach(array_slice(config('dummy.products'), 0, 4) as $p)
    @include('partials.product-card', ['p' => $p])
  @endforeach
</div>
@endsection