<div class="modal-overlay" id="productModal">
 <div class="modal-card">
  <div class="modal-head">
   <h3 class="disp" id="modalTitle">Tambah Produk</h3>
   <button class="modal-close" type="button" onclick="closeModal('productModal')">✕</button>
  </div>
  <form onsubmit="return submitProductForm(event)">
   <div class="field"><label>Nama Produk</label><input id="pf_name" placeholder="cth. Wortel Segar" required></div>
   <div class="field"><label>Kategori</label>
    <select id="pf_cat" required>
     <option value="Buah">Buah</option>
     <option value="Sayur">Sayur</option>
     <option value="Biji-bijian">Biji-bijian</option>
     <option value="Paket">Paket</option>
    </select>
   </div>
   <div class="field-row">
    <div class="field"><label>Harga (Rp)</label><input id="pf_price" type="number" min="0" placeholder="15000" required></div>
    <div class="field"><label>Satuan</label><input id="pf_unit" placeholder="kg / ikat / paket" required></div>
   </div>
   <div class="field"><label>Stok</label><input id="pf_stok" type="number" min="0" placeholder="20" required></div>
   <div class="field"><label>Ikon Produk</label><div class="emoji-picks" id="emojiPicks"></div></div>
   <div class="checkbox-row">
    <input type="checkbox" id="pf_organik">
    <label for="pf_organik" style="margin:0;font-weight:500;color:var(--ink)">Produk organik</label>
   </div>
   <button class="btn" type="submit" id="pf_submit">Simpan Produk</button>
  </form>
 </div>
</div>