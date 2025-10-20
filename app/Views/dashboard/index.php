<?= $this->include('layout/header'); ?>


<div class="container-fluid">
    <h3 class="mb-4">Dashboard Stok Harian</h3>
    <div class="card shadow mb-4">
  <div class="card-header bg-primary text-white">
   <div class="row">

  <div class="row">
  <div class="col-md-12">
    <div class="card shadow-sm">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Grafik Stok Keluar</h6>
        <div class="d-flex align-items-center">
          <div class="btn-group me-2">
            <button class="btn btn-outline-primary btn-kategori active" data-kategori="Premix">Premix</button>
            <button class="btn btn-outline-primary btn-kategori" data-kategori="Filling">Filling</button>
            <button class="btn btn-outline-primary btn-kategori" data-kategori="Fluffy">Fluffy</button>
          </div>
          <select id="periode" class="form-select">
            <option value="week" selected>Per Minggu</option>
            <option value="month">Per Bulan</option>
          </select>
        </div>
      </div>
      <div class="card-body">
        <canvas id="grafikKeluar" height="120"></canvas>
      </div>
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
    <td><?= esc($p['in']); ?></td>
    <td><?= esc($p['out']); ?></td>
    <td><?= esc($p['stok_akhir']); ?></td>
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
document.addEventListener("DOMContentLoaded", function () {
  const ctx = document.getElementById('grafikKeluar').getContext('2d');
  let chart;

  let kategori = 'Premix';
  let periode = 'week';

  function loadChart() {
    fetch(`<?= base_url('dashboard/grafikKeluar'); ?>?kategori=${kategori}&periode=${periode}`)
      .then(res => res.json())
      .then(data => {
        if (chart) chart.destroy();
        chart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: data.labels,
            datasets: [{
              label: `${kategori} Keluar (${periode === 'week' ? 'Minggu Ini' : 'Bulan Ini'})`,
              data: data.data,
              backgroundColor: 'rgba(54, 162, 235, 0.6)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1
            }]
          },
          options: {
            plugins: {
              legend: { display: false }
            },
            scales: {
              y: { beginAtZero: true }
            }
          }
        });
      });
  }

  // load awal
  loadChart();

  // ganti kategori
  document.querySelectorAll('.btn-kategori').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.btn-kategori').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      kategori = this.getAttribute('data-kategori');
      loadChart();
    });
  });

  // ganti periode
  document.getElementById('periode').addEventListener('change', function () {
    periode = this.value;
    loadChart();
  });
});
</script>



<?= $this->include('layout/footer'); ?>
