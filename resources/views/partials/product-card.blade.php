@php
    $f = config('dummy.farmers')[$p['farmer']];
    $rp = fn ($n) => 'Rp' . number_format($n, 0, ',', '.');
@endphp
<div class="pcard" data-cat="{{ $p['cat'] }}" data-organik="{{ $p['organik'] ? 1 : 0 }}" data-name="{{ strtolower($p['name']) }}">
  <div class="img">
    @if($p['organik'])<span class="badge">Organik</span>@endif
    {{ $p['emoji'] }}
  </div>
  <div class="body">
    <div class="pname">{{ $p['name'] }}</div>
    <div class="pfarmer">{{ $f['name'] }} · {{ explode(',', $f['loc'])[0] }}</div>
    <div class="prow">
      <div class="price">{{ $rp($p['price']) }}<br><small>/{{ $p['unit'] }}</small></div>
      <button class="addbtn" type="button">+</button>
    </div>
  </div>
</div>