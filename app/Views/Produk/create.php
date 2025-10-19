<?= $this->include('layout/header'); ?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Tambah Produk</h1>

  <div class="card shadow mb-4">
    <div class="card-body">
      <form action="/produk/store" method="post">
        <div class="form-group">
          <label>Nama Produk</label>
          <input type="text" name="nama_produk" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Kategori Produk</label>
          <select name="id_kategori" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach($kategori as $k): ?>
              <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        <a href="/produk" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>

<?= $this->include('layout/footer'); ?>
