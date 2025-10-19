<?= $this->include('layout/header'); ?>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Data Transaksi</h1>

  <a href="/transaksi/create" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Transaksi</a>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
  <?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
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
              <th>Masuk</th>
              <th>Keluar</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($transaksi)): $no=1; foreach($transaksi as $t): ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= esc($t['nama_produk']); ?></td>
                <td><?= esc($t['nama_kategori']); ?></td>
                <td><?= esc($t['stok_masuk']); ?></td>
                <td><?= esc($t['stok_keluar']); ?></td>
                <td><?= date('d/m/Y', strtotime($t['tanggal'])); ?></td>
                <td>
                  <a href="/transaksi/delete/<?= $t['id_transaksi']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
            <?php endforeach; else: ?>
              <tr><td colspan="7">Belum ada transaksi.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->include('layout/footer'); ?>
