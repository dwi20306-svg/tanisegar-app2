@extends('layouts.guest')

@section('title', 'Masuk')

@section('content')
<div class="auth-shell">
    <div class="auth-wrap">

        <div class="auth-side">
            <div class="brand disp">🌿 TaniSegar</div>
            <h2 class="disp">Segar dari kebun,<br>langsung ke mejamu</h2>
            <p>Pilih cara masukmu: sebagai <b>Pembeli</b> untuk belanja, sebagai <b>Petani</b> untuk mengelola tokomu, atau sebagai <b>Calon Petani</b> kalau kamu baru mau mulai berjualan.</p>
        </div>

        <div class="auth-form">
            <h1 class="disp">Masuk</h1>
            <div class="sub">Pilih peran lalu masuk ke akunmu</div>

            <form method="POST" action="/login">
                @csrf

                <div class="role-pick">
                    <div>
                        <input type="radio" name="role" id="role-pembeli" value="pembeli" checked>
                        <label class="role-card" for="role-pembeli"><div class="e">🛒</div><b>Pembeli</b><span>Belanja hasil panen</span></label>
                    </div>
                    <div>
                        <input type="radio" name="role" id="role-petani" value="petani">
                        <label class="role-card" for="role-petani"><div class="e">🌾</div><b>Petani</b><span>Jual hasil panen</span></label>
                    </div>
                    <div>
                        <input type="radio" name="role" id="role-calon" value="calon">
                        <label class="role-card" for="role-calon"><div class="e">🌱</div><b>Calon Petani</b><span>Baru mulai jualan</span></label>
                    </div>
                </div>

                <div class="field">
                    <label for="email">Email / No. HP</label>
                    <input id="email" name="email" placeholder="email@contoh.com">
                </div>
                <div class="field">
                    <label for="password">Kata Sandi</label>
                    <input id="password" name="password" type="password" placeholder="••••••••">
                </div>

                <button class="btn" type="submit">Masuk</button>
            </form>

            <div class="switch-line">Belum punya akun? <a href="/register">Daftar di sini</a></div>
        </div>

    </div>
</div>
@endsection