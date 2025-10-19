<?= $this->include('layout/header'); ?>


<div class="container-fluid">
    <h3 class="mb-4">Dashboard Stok Harian</h3>
    <div class="card shadow mb-4">
  <div class="card-header bg-primary text-white">
   <div class="row">

  <!-- Grafik kecil -->
  <div class="col-md-6 mb-4">
    <div class="card shadow">
      <div class="card-header bg-primary text-white py-2">
        <h6 class="m-0 font-weight-bold">Grafik Stok Keluar (Mingguan)</h6>
      </div>
      <div class="card-body">
        <canvas id="grafikStok" height="150"></canvas>
      </div>
    </div>
  </div>

  <!-- Prediksi stok keluar -->
  <div class="col-md-6 mb-4">
    <div class="card shadow">
      <div class="card-header bg-success text-white py-2">
        <h6 class="m-0 font-weight-bold">Prediksi Stok Keluar Minggu Depan</h6>
      </div>
      <div class="card-body d-flex flex-column align-items-center justify-content-center">
        <h1 class="display-4 text-success mb-2"><?= esc($prediksi); ?></h1>
        <p class="text-muted">Berdasarkan rata-rata 7 hari terakhir</p>
      </div>
    </div>
  </div>

</div>

            <?= esc($kategori) ?> - Stok Harian (<?= esc($tanggal) ?>)
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="bg-primary text-white text-center">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Stok Awal</th>
                        <th>In</th>
                        <th>Out</th>
                        <th>Stok Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($produk)): ?>
                        <tr><td colspan="5" class="text-center text-muted">Belum ada data stok hari ini</td></tr>
                    <?php else: ?>
                        <?php foreach ($produk as $p): ?>
                        <tr class="text-center">
                            <td><?= esc($p['nama_produk']); ?></td>
                            <td><?= rand(100, 300); // contoh stok awal ?></td>
                            <td><?= rand(0, 100); // stok masuk ?></td>
                            <td><?= rand(0, 50);  // stok keluar ?></td>
                            <td><?= esc($p['stok']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('grafikStok');
  const labels = <?= json_encode(array_column($grafik, 'minggu')); ?>;
  const data = <?= json_encode(array_column($grafik, 'total_keluar')); ?>;

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels.map(m => 'Minggu ' + m),
      datasets: [{
        label: 'Stok Keluar',
        data: data,
        fill: true,
        borderColor: '#4e73df',
        backgroundColor: 'rgba(78, 115, 223, 0.2)',
        tension: 0.3
      }]
    },
    options: {
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    }
  });
</script>



<?= $this->include('layout/footer'); ?>
