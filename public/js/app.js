/* TaniSegar - JavaScript tampilan (sementara, belum terhubung ke database) */

function qs(sel, root) { return (root || document).querySelector(sel); }
function qsa(sel, root) { return Array.prototype.slice.call((root || document).querySelectorAll(sel)); }
function rp(n) { return 'Rp' + Number(n).toLocaleString('id-ID'); }

/* ---------- Toast ---------- */
function toast(msg) {
  var t = document.getElementById('toast');
  if (!t) {
    t = document.createElement('div');
    t.id = 'toast';
    t.className = 'toast';
    document.body.appendChild(t);
  }
  t.textContent = msg;
  t.classList.add('show');
  clearTimeout(window._tt);
  window._tt = setTimeout(function () { t.classList.remove('show'); }, 1600);
}

/* ---------- Modal ---------- */
function openModal(id) { var m = document.getElementById(id); if (m) m.classList.add('show'); }
function closeModal(id) { var m = document.getElementById(id); if (m) m.classList.remove('show'); }
document.addEventListener('click', function (e) {
  // klik area gelap di luar kartu = tutup modal
  if (e.target.classList && e.target.classList.contains('modal-overlay')) e.target.classList.remove('show');
});

/* ---------- Form tambah / edit produk ---------- */
var EMOJIS = ['\uD83C\uDF4A', '\uD83C\uDF4C', '\uD83C\uDF47', '\uD83C\uDF45', '\uD83E\uDD6C', '\uD83C\uDF3E', '\uD83E\uDED8', '\uD83E\uDDFA', '\uD83E\uDD55', '\uD83C\uDF46', '\uD83C\uDF49', '\uD83E\uDD54'];
var pickedEmoji = EMOJIS[0];

function renderEmojis(selected) {
  var box = document.getElementById('emojiPicks');
  if (!box) return;
  pickedEmoji = selected;
  box.innerHTML = '';
  EMOJIS.forEach(function (e) {
    var b = document.createElement('button');
    b.type = 'button';
    b.textContent = e;
    if (e === selected) b.className = 'active';
    b.onclick = function () {
      pickedEmoji = e;
      qsa('button', box).forEach(function (x) { x.classList.remove('active'); });
      b.classList.add('active');
    };
    box.appendChild(b);
  });
}

function openProductForm(btn) {
  var editing = !!(btn && btn.dataset);
  var d = editing ? btn.dataset : {};
  document.getElementById('modalTitle').textContent = editing ? 'Edit Produk' : 'Tambah Produk';
  document.getElementById('pf_submit').textContent = editing ? 'Simpan Perubahan' : 'Simpan Produk';
  document.getElementById('pf_name').value = d.name || '';
  document.getElementById('pf_cat').value = d.cat || 'Sayur';
  document.getElementById('pf_price').value = d.price || '';
  document.getElementById('pf_unit').value = d.unit || '';
  document.getElementById('pf_stok').value = d.stok || '';
  document.getElementById('pf_organik').checked = d.organik === '1';
  renderEmojis(d.emoji || EMOJIS[0]);
  openModal('productModal');
}

function submitProductForm(e) {
  e.preventDefault();
  closeModal('productModal');
  toast('Produk disimpan (belum tersimpan ke database)');
  return false;
}

/* ---------- Halaman-halaman ---------- */
var TaniSegar = {

  /* Sapaan sesuai jam di dashboard petani */
  initGreeting: function (id) {
    var el = document.getElementById(id);
    if (!el) return;
    var h = new Date().getHours();
    el.textContent = h < 11 ? '\u2600\uFE0F Selamat Pagi' : h < 15 ? '\uD83C\uDF24\uFE0F Selamat Siang' : h < 18 ? '\uD83C\uDF25\uFE0F Selamat Sore' : '\uD83C\uDF19 Selamat Malam';
  },

  /* Jelajahi: filter kategori + pencarian + tombol + keranjang */
  initJelajahi: function () {
    var activeCat = new URLSearchParams(location.search).get('cat') || 'Semua';
    var chips = qsa('#chips .chip');
    var cards = qsa('#products .pcard');
    var box = document.getElementById('searchbox');
    var cartCount = 0;

    function apply() {
      var q = (box.value || '').toLowerCase();
      var shown = 0;
      cards.forEach(function (c) {
        var okCat = activeCat === 'Semua' ? true
                  : activeCat === 'Organik' ? c.dataset.organik === '1'
                  : c.dataset.cat === activeCat;
        var ok = okCat && c.dataset.name.indexOf(q) > -1;
        c.style.display = ok ? '' : 'none';
        if (ok) shown++;
      });
      chips.forEach(function (c) { c.classList.toggle('active', c.dataset.cat === activeCat); });
      document.getElementById('catTitle').textContent = activeCat + ' (' + shown + ')';
      document.getElementById('emptyMsg').style.display = shown ? 'none' : '';
    }

    chips.forEach(function (c) { c.onclick = function () { activeCat = c.dataset.cat; apply(); }; });
    box.addEventListener('input', apply);

    qsa('.addbtn').forEach(function (b) {
      b.onclick = function () {
        var badge = document.getElementById('navCartCount');
        if (badge) {
          cartCount = parseInt(badge.textContent || '0', 10) + 1;
          badge.textContent = cartCount;
          badge.style.display = 'flex';
        }
        toast('Ditambahkan ke keranjang');
      };
    });
    apply();
  },

  /* Pesanan pembeli: ubah jumlah barang, hitung total */
  initCart: function () {
    function recalc() {
      var total = 0, count = 0;
      qsa('.cart-item').forEach(function (it) {
        var q = parseInt(qs('.qty span', it).textContent, 10);
        total += q * Number(it.dataset.price);
        count += q;
      });
      var badge = document.getElementById('navCartCount');
      if (badge) { badge.textContent = count; badge.style.display = count ? 'flex' : 'none'; }

      if (!qsa('.cart-item').length) {
        document.getElementById('cartList').innerHTML =
          '<div class="empty"><div class="ic">\uD83D\uDED2</div>Keranjang masih kosong<br><span style="font-size:13px">Yuk pilih produk segar di Jelajahi</span></div>';
        document.getElementById('summary').innerHTML = '';
        return;
      }
      document.getElementById('subtotal').textContent = rp(total);
      document.getElementById('total').textContent = rp(total);
    }

    qsa('.cart-item .qty button').forEach(function (b) {
      b.onclick = function () {
        var item = b.closest('.cart-item');
        var span = qs('.qty span', item);
        var q = parseInt(span.textContent, 10) + parseInt(b.dataset.d, 10);
        if (q <= 0) item.remove(); else span.textContent = q;
        recalc();
      };
    });

    var co = document.getElementById('checkoutBtn');
    if (co) co.onclick = function () { toast('Pesanan berhasil dibuat! \uD83C\uDF89 (contoh tampilan)'); };
  },

  /* Chat: pindah percakapan + kirim pesan.  param = nama query (?f= atau ?b=) */
  initChat: function (param) {
    var items = qsa('.chat-list-item');
    var threads = qsa('.thread');
    if (!items.length) return;

    function open(id) {
      items.forEach(function (i) { i.classList.toggle('active', i.dataset.thread === id); });
      threads.forEach(function (t) {
        t.style.display = t.dataset.thread === id ? '' : 'none';
        if (t.dataset.thread === id) { var b = qs('.thread-body', t); b.scrollTop = b.scrollHeight; }
      });
    }
    items.forEach(function (i) { i.onclick = function () { open(i.dataset.thread); }; });

    var fromUrl = new URLSearchParams(location.search).get(param);
    if (fromUrl && items.some(function (i) { return i.dataset.thread === fromUrl; })) open(fromUrl);

    var replies = ['Baik kak, ditunggu ya \uD83C\uDF3F', 'Siap, terima kasih infonya', 'Boleh, saya tunggu konfirmasinya', 'Mantap, lanjut ya kak'];
    threads.forEach(function (t) {
      var input = qs('.thread-input input', t);
      var body = qs('.thread-body', t);

      function add(text, me) {
        var empty = qs('.empty', body);
        if (empty) empty.remove();
        var d = document.createElement('div');
        d.className = 'bubble ' + (me ? 'me' : 'them');
        d.textContent = text;
        body.appendChild(d);
        body.scrollTop = body.scrollHeight;
      }
      function send() {
        var v = input.value.trim();
        if (!v) return;
        add(v, true);
        input.value = '';
        setTimeout(function () { add(replies[Math.floor(Math.random() * replies.length)], false); }, 800);
      }
      qs('.thread-input button', t).onclick = send;
      input.addEventListener('keydown', function (e) { if (e.key === 'Enter') send(); });
    });
  },

  /* Pesanan masuk petani: filter status + tombol aksi */
  initOrders: function () {
    var filter = 'Semua';
    var cards = qsa('#incomingList .order-card');

    function actionsFor(status) {
      if (status === 'Baru') return '<div style="display:flex;gap:8px"><button class="btn outline" data-a="Ditolak">Tolak</button><button class="btn" data-a="Dikemas">Terima</button></div>';
      if (status === 'Dikemas') return '<button class="btn" data-a="Dikirim">Tandai Dikirim</button>';
      if (status === 'Dikirim') return '<button class="btn outline" data-a="Selesai">Tandai Selesai</button>';
      return '';
    }
    function paint(card) {
      var st = card.dataset.status;
      var badge = qs('.status', card);
      badge.textContent = st;
      badge.className = 'status ' + (st === 'Selesai' ? 'selesai' : 'proses');
      var box = qs('.actions', card);
      box.innerHTML = actionsFor(st);
      qsa('button', box).forEach(function (b) {
        b.onclick = function () {
          card.dataset.status = b.dataset.a;
          toast('Status pesanan: ' + b.dataset.a);
          paint(card);
          apply();
        };
      });
    }
    function apply() {
      var shown = 0;
      cards.forEach(function (c) {
        var ok = filter === 'Semua' || c.dataset.status === filter;
        c.style.display = ok ? '' : 'none';
        if (ok) shown++;
      });
      document.getElementById('orderEmpty').style.display = shown ? 'none' : '';
      qsa('#orderFilterChips .chip').forEach(function (c) { c.classList.toggle('active', c.dataset.f === filter); });
    }
    qsa('#orderFilterChips .chip').forEach(function (c) { c.onclick = function () { filter = c.dataset.f; apply(); }; });
    cards.forEach(paint);
    apply();
  }
};