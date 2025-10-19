<?= $this->include('layout/header'); ?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Tambah Transaksi</h1>

  <div class="card shadow mb-4">
    <div class="card-body">
      <form action="/transaksi/store" method="post">
        <div class="form-group">
          <label>Nama Produk</label>
          <select name="id_produk" class="form-control" required>
            <option value="">-- Pilih Produk --</option>
            <?php foreach($produk as $p): ?>
              <option value="<?= $p['id_produk']; ?>"><?= $p['nama_produk']; ?> (<?= $p['nama_kategori']; ?>)</option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label>Stok Masuk</label>
          <input type="number" name="stok_masuk" class="form-control" placeholder="0" min="0" required>
        </div>

        <div class="form-group">
          <label>Stok Keluar</label>
          <input type="number" name="stok_keluar" class="form-control" placeholder="0" min="0" required>
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        <a href="/transaksi" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>

<?= $this->include('layout/footer'); ?>
