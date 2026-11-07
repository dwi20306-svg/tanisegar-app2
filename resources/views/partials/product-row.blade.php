@php $rp = fn ($n) => 'Rp' . number_format($n, 0, ',', '.'); @endphp
<div class="prod-manage">
  <div class="img">{{ $p['emoji'] }}</div>
  <div class="info">
    <b style="font-size:14px">{{ $p['name'] }}</b>
    <div class="stok">Stok: {{ $p['stok'] }} {{ $p['unit'] }} · {{ $rp($p['price']) }}@if($p['organik']) · Organik @endif</div>
  </div>
  <button class="edit-b" type="button" onclick="openProductForm(this)"
    data-name="{{ $p['name'] }}" data-cat="{{ $p['cat'] }}" data-price="{{ $p['price'] }}"
    data-unit="{{ $p['unit'] }}" data-stok="{{ $p['stok'] }}" data-emoji="{{ $p['emoji'] }}"
    data-organik="{{ $p['organik'] ? 1 : 0 }}">Edit</button>
</div>