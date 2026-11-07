@extends('layouts.app')

@section('title', 'Jelajahi Produk')

@section('topleft')
<span class="loc">📍 Antar ke Jakarta Selatan ▾</span>
@endsection

@section('topright')
<div class="search"><span>🔍</span><input id="searchbox" placeholder="Cari sayur, buah, beras..."></div>
@endsection

@section('content')
<div class="chips" id="chips">
  @foreach(config('dummy.categories') as $c)
  <div class="chip {{ $c === 'Semua' ? 'active' : '' }}" data-cat="{{ $c }}">{{ $c }}</div>
  @endforeach
</div>

<div class="section-head"><h3 id="catTitle">Semua</h3></div>

<div class="grid" id="products">
  @foreach(config('dummy.products') as $p)
    @include('partials.product-card', ['p' => $p])
  @endforeach
  <div class="empty" id="emptyMsg" style="grid-column:1/-1;display:none"><div class="ic">🌾</div>Produk tidak ditemukan</div>
</div>
@endsection

@push('scripts')
<script>TaniSegar.initJelajahi();</script>
@endpush