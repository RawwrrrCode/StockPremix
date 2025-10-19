<?= $this->include('layout/header'); ?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Data Produk</h1>

  <a href="/produk/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Produk</a>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
  <?php endif; ?>

  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-center">
          <thead class="bg-primary text-white">
            <tr>
              <th>No</th>
              <th>Nama Produk</th>
              <th>Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($produk)): $no=1; foreach($produk as $p): ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= esc($p['nama_produk']); ?></td>
                <td><?= esc($p['nama_kategori']); ?></td>
                <td>
                  <a href="/produk/edit/<?= $p['id_produk']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                  <a href="/produk/delete/<?= $p['id_produk']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
            <?php endforeach; else: ?>
              <tr><td colspan="4">Belum ada data produk.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->include('layout/footer'); ?>
