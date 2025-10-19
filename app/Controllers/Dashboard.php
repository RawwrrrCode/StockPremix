<?php

namespace App\Controllers;
use App\Models\DashboardModel;
use App\Models\TransaksiModel;

class Dashboard extends BaseController
{
    protected $dashboardModel;
    protected $transaksiModel;

    public function __construct()
    {
        $this->dashboardModel = new DashboardModel();
        $this->transaksiModel = new TransaksiModel();
    }

    public function index()
    {
        $kategori = $this->request->getGet('kategori') ?? 'Premix';

        // Ambil data stok
        $produk = $this->dashboardModel->getStokByKategori($kategori);

        // Grafik stok keluar mingguan
        $grafikData = $this->transaksiModel->getGrafikKeluarPerMinggu();

        // Prediksi: rata-rata stok keluar 7 hari terakhir
        $prediksi = $this->transaksiModel->getPrediksiKeluar();

        $data = [
            'title' => 'Dashboard Stok Harian',
            'kategori' => $kategori,
            'produk' => $produk,
            'tanggal' => date('d/m/Y'),
            'grafik' => $grafikData,
            'prediksi' => $prediksi
        ];

        return view('dashboard/index', $data);
    }
}
