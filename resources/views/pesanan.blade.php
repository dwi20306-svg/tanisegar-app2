@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
@php
    $rp = fn ($n) => 'Rp' . number_format($n, 0, ',', '.');
    $products = collect(config('dummy.products'))->keyBy('id');
    $subtotal = 0;
@endphp

<div class="pesanan-layout">
  <div>
    <div class="section-head"><h3>Keranjang</h3></div>
    <div id="cartList">
      @foreach(config('dummy.cart') as $item)
        @php
            $p = $products[$item['product']];
            $subtotal += $p['price'] * $item['qty'];
        @endphp
        <div class="cart-item" data-price="{{ $p['price'] }}">
          <div class="img">{{ $p['emoji'] }}</div>
          <div class="info">
            <b style="font-size:14px">{{ $p['name'] }}</b>
            <div style="font-size:12px;color:var(--ink-soft)">{{ $rp($p['price']) }}/{{ $p['unit'] }}</div>
          </div>
          <div class="qty">
            <button type="button" data-d="-1">−</button>
            <span>{{ $item['qty'] }}</span>
            <button type="button" data-d="1">+</button>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div id="summary">
    <div class="summary-card">
      <div class="row"><span>Subtotal</span><span id="subtotal">{{ $rp($subtotal) }}</span></div>
      <div class="row"><span>Ongkos Kirim</span><span>Gratis</span></div>
      <div class="row"><span>Pembayaran</span><span>Bayar di Tempat (COD)</span></div>
      <div class="total"><span>Total</span><span id="total">{{ $rp($subtotal) }}</span></div>
      <button class="btn" type="button" id="checkoutBtn">Checkout</button>
    </div>
  </div>
</div>

<div class="section-head" style="margin-top:36px"><h3>Riwayat Pesanan</h3></div>
<div id="history">
  @foreach(config('dummy.orders') as $o)
  <div class="order-card">
    <div class="row"><b>#{{ $o['id'] }}</b><span class="status {{ $o['status'] === 'Selesai' ? 'selesai' : 'proses' }}">{{ $o['status'] }}</span></div>
    <div class="row" style="color:var(--ink-soft)"><span>{{ $o['items'] }}</span></div>
    <div class="row"><span style="color:var(--ink-soft)">{{ $o['date'] }}</span><b>{{ $rp($o['total']) }}</b></div>
  </div>
  @endforeach
</div>
@endsection

@push('scripts')
<script>TaniSegar.initCart();</script>
@endpush