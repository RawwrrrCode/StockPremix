<?= $this->include('layout/header'); ?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Edit Produk</h1>

  <div class="card shadow mb-4">
    <div class="card-body">
     <form action="/produk/update/<?= $produk['id_produk']; ?>" method="post">
    <input type="text" name="nama_produk" value="<?= esc($produk['nama_produk']); ?>" required>
    
    <select name="id_kategori" required>
        <?php foreach ($kategori as $k): ?>
            <option value="<?= $k['id_kategori']; ?>" <?= $produk['id_kategori'] == $k['id_kategori'] ? 'selected' : ''; ?>>
                <?= esc($k['nama_kategori']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="number" name="stok" value="<?= esc($produk['stok']); ?>" min="0">
    
    <button type="submit">Update</button>
</form>

    </div>
  </div>
</div>

<?= $this->include('layout/footer'); ?>
