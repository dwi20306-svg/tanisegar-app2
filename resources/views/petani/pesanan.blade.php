@extends('layouts.app')

@section('title', 'Pesanan Masuk')

@section('content')
@php $rp = fn ($n) => 'Rp' . number_format($n, 0, ',', '.'); @endphp

<div class="chips" id="orderFilterChips">
  @foreach(['Semua', 'Baru', 'Dikemas', 'Dikirim', 'Selesai'] as $f)
  <div class="chip {{ $f === 'Semua' ? 'active' : '' }}" data-f="{{ $f }}">{{ $f }}</div>
  @endforeach
</div>

<div id="incomingList">
  @foreach(config('dummy.incoming') as $o)
  <div class="order-card" data-status="{{ $o['status'] }}">
    <div class="row"><b>#{{ $o['id'] }} · {{ $o['buyer'] }}</b><span class="status {{ $o['status'] === 'Selesai' ? 'selesai' : 'proses' }}">{{ $o['status'] }}</span></div>
    <div class="row" style="color:var(--ink-soft)"><span>{{ $o['items'] }}</span></div>
    <div class="row" style="align-items:center"><b style="color:var(--green)">{{ $rp($o['total']) }}</b><div class="actions"></div></div>
  </div>
  @endforeach
  <div class="empty" id="orderEmpty" style="display:none"><div class="ic">📦</div>Tidak ada pesanan di status ini</div>
</div>
@endsection

@push('scripts')
<script>TaniSegar.initOrders();</script>
@endpush