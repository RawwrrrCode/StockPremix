<?php

namespace App\Models;
use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_produk', 'stok_masuk', 'stok_keluar', 'tanggal'];
    protected $useTimestamps = false;

    // 🔹 Ambil semua transaksi (untuk halaman transaksi)
    public function getAllTransaksi()
    {
        return $this->select('transaksi.*, produk.nama_produk, kategori_produk.nama_kategori')
                    ->join('produk', 'produk.id_produk = transaksi.id_produk', 'left')
                    ->join('kategori_produk', 'kategori_produk.id_kategori = produk.id_kategori', 'left')
                    ->orderBy('transaksi.tanggal', 'DESC')
                    ->findAll();
    }

    // 🔹 Ambil data stok harian untuk dashboard
   public function getGrafikKeluarPerMinggu()
{
    return $this->select("WEEK(tanggal, 1) AS minggu, SUM(stok_keluar) AS total_keluar")
                ->groupBy("minggu")
                ->orderBy("minggu", "ASC")
                ->limit(8)
                ->findAll();
}

// Prediksi stok keluar minggu depan
public function getPrediksiKeluar()
{
    $result = $this->select("AVG(stok_keluar) AS rata")
                   ->where("tanggal >=", date('Y-m-d', strtotime('-7 days')))
                   ->first();

    return round($result['rata'] ?? 0);
}
}