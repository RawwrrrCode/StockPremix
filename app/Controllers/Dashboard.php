<?php

namespace App\Controllers;
use App\Models\DashboardModel;
use App\Models\TransaksiModel;
use App\Models\ProdukModel;

class Dashboard extends BaseController
{
    protected $dashboardModel;
    protected $transaksiModel;
    protected $produkModel;

    public function __construct()
    {
        $this->dashboardModel = new DashboardModel();
        $this->transaksiModel = new TransaksiModel();
        $this->produkModel = new ProdukModel();
    }

      public function index()
    {
        $kategori = $this->request->getGet('kategori') ?? 'Premix'; // default kategori
        $produk   = $this->transaksiModel->getStokHarianByKategori($kategori);
        $forecast = $this->transaksiModel->getPrediksiMingguan();
        $chartData = $this->transaksiModel->getWeeklyChartData();

        // Hitung rata-rata prediksi (untuk angka besar di tengah dashboard)
        $avgPrediksi = 0;
        if (!empty($forecast)) {
            $total = array_sum(array_column($forecast, 'prediksi'));
            $avgPrediksi = round($total / count($forecast));
        }

        return view('dashboard/index', [
            'kategori' => $kategori,
            'produk'   => $produk,
            'forecast' => $forecast,
            'chartData' => $chartData,
            'prediksi' => $avgPrediksi, // ✅ kirim ke view
            'tanggal'  => date('Y-m-d')
        ]);
    }
     public function grafikKeluar()
    {
        $transaksiModel = new TransaksiModel();
        $kategori = $this->request->getGet('kategori') ?? 'Premix';
        $periode  = $this->request->getGet('periode') ?? 'week';

        $data = $transaksiModel->getDataKeluar($kategori, $periode);
        return $this->response->setJSON($data);
    }

}
