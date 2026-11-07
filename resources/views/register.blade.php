@extends('layouts.guest')

@section('content')
<div class="auth-shell">
  <div class="auth-wrap">

    <div class="auth-side">
      <div class="brand disp">🌿 TaniSegar</div>
      <h2 class="disp">Gabung sebagai<br>pembeli atau petani</h2>
      <p>Pembeli bisa langsung belanja. Calon petani bisa langsung mulai menyiapkan toko dan produknya.</p>
    </div>

    <div class="auth-form">
      <h1 class="disp">Buat Akun</h1>
      <div class="sub">Pilih peran, lalu isi datamu</div>

      <form method="POST" action="/register">
        @csrf

        <div class="role-pick dua">
          <div>
            <input type="radio" name="role" value="pembeli" id="role-pembeli" checked>
            <label class="role-card" for="role-pembeli">
              <div class="e">🛒</div><b>Pembeli</b><span>Langsung bisa belanja</span>
            </label>
          </div>
          <div>
            <input type="radio" name="role" value="calon" id="role-calon">
            <label class="role-card" for="role-calon">
              <div class="e">🌾</div><b>Calon Petani</b><span>Mulai jualan hasil panen</span>
            </label>
          </div>
        </div>

        <div class="notice" id="petaniNotice" style="display:none">
          Setelah daftar, kamu langsung masuk ke beranda petani dan bisa mulai menambah produk.
        </div>

        <div class="field">
          <label>Nama Lengkap</label>
          <input name="name" placeholder="Nama kamu" required>
        </div>
        <div class="field">
          <label>Email</label>
          <input name="email" type="email" placeholder="email@contoh.com" required>
        </div>
        <div class="field">
          <label id="locLabel">Kota/Kabupaten</label>
          <input name="location" placeholder="Jakarta Selatan" required>
        </div>
        <div class="field" id="cropField" style="display:none">
          <label>Komoditas Utama</label>
          <input name="crop" placeholder="cth. Sayur, jeruk, padi organik">
        </div>
        <div class="field">
          <label>Kata Sandi</label>
          <input name="password" type="password" placeholder="Minimal 6 karakter" minlength="6" required>
        </div>

        <button class="btn" type="submit"><span id="btnLabel">Daftar sebagai Pembeli</span></button>
      </form>

      <div class="switch-line">Sudah punya akun? <a href="/login">Masuk di sini</a></div>
    </div>

  </div>
</div>

<script>
  // tampilkan/sembunyikan bagian khusus calon petani
  document.querySelectorAll('input[name="role"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
      var petani = this.value === 'calon';
      document.getElementById('petaniNotice').style.display = petani ? 'block' : 'none';
      document.getElementById('cropField').style.display   = petani ? 'block' : 'none';
      document.getElementById('locLabel').textContent      = petani ? 'Lokasi Kebun/Lahan' : 'Kota/Kabupaten';
      document.getElementById('btnLabel').textContent      = petani ? 'Daftar sebagai Calon Petani' : 'Daftar sebagai Pembeli';
    });
  });
</script>
@endsection