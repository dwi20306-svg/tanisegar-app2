@php
    // Sementara: petani = alamat diawali /petani. Nanti diganti auth()->user()->role
    $isPetani = request()->is('petani/*');
    $base = $isPetani ? '/petani' : '';
    $on = fn ($path) => request()->is(ltrim($base . $path, '/')) ? 'active' : '';
    $cartCount = collect(config('dummy.cart'))->sum('qty');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') — TaniSegar</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="app-shell">
 <aside class="sidebar">
  <div class="brand disp">🌿 TaniSegar</div>
  <a class="nav-link {{ $on('/beranda') }}" href="{{ $base }}/beranda"><span class="ic">🏠</span>Beranda</a>
  @unless($isPetani)
  <a class="nav-link {{ $on('/jelajahi') }}" href="/jelajahi"><span class="ic">🔍</span>Jelajahi</a>
  @endunless
  <a class="nav-link {{ $on('/pesanan') }}" href="{{ $base }}/pesanan"><span class="ic">📦</span>Pesanan
    @unless($isPetani)<span class="count" id="navCartCount" style="{{ $cartCount ? '' : 'display:none' }}">{{ $cartCount }}</span>@endunless
  </a>
  <a class="nav-link {{ $on('/chat') }}" href="{{ $base }}/chat"><span class="ic">💬</span>Chat</a>
  <a class="nav-link {{ $on('/profil') }}" href="{{ $base }}/profil"><span class="ic">👤</span>Profil</a>
  <div class="foot">© 2026 TaniSegar<br>Petani &amp; Pembeli Indonesia</div>
 </aside>

 <main class="main">
  <div class="topbar">
   <div>
    @yield('topleft')
    <h1>@yield('title')</h1>
   </div>
   @yield('topright')
  </div>
  <div class="content" style="@yield('contentstyle')">
   @yield('content')
  </div>
 </main>
</div>

@yield('modals')

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>