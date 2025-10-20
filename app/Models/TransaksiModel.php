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

     public function getDataKeluar($kategori, $periode = 'week')
    {
        $builder = $this->db->table('transaksi t')
            ->select('p.nama_produk, SUM(t.stok_keluar) as total_keluar')
            ->join('produk p', 'p.id_produk = t.id_produk')
            ->join('kategori_produk k', 'k.id_kategori = p.id_kategori')
            ->where('k.nama_kategori', ucfirst($kategori));

        // Filter berdasarkan waktu
        if ($periode === 'month') {
            $builder->where('t.tanggal >=', date('Y-m-d', strtotime('-30 days')));
        } else {
            $builder->where('t.tanggal >=', date('Y-m-d', strtotime('-7 days')));
        }

        $builder->groupBy('p.nama_produk');
        $builder->orderBy('p.nama_produk', 'ASC');

        $result = $builder->get()->getResultArray();

        $labels = array_column($result, 'nama_produk');
        $data = array_map('intval', array_column($result, 'total_keluar'));

        return ['labels' => $labels, 'data' => $data];
    }

// Prediksi stok keluar minggu depan
public function getPrediksiKeluar()
{
    $result = $this->select("AVG(stok_keluar) AS rata")
                   ->where("tanggal >=", date('Y-m-d', strtotime('-7 days')))
                   ->first();

    return round($result['rata'] ?? 0);
}

public function getStokHarianByKategori($kategori)
{
    return $this->db->table('produk p')
        ->select('p.nama_produk,
                  IFNULL(SUM(CASE WHEN DATE(t.tanggal) = CURDATE() THEN t.stok_masuk ELSE 0 END), 0) AS `in`,
                  IFNULL(SUM(CASE WHEN DATE(t.tanggal) = CURDATE() THEN t.stok_keluar ELSE 0 END), 0) AS `out`,
                  IFNULL(p.stok, 0) AS stok_akhir')
        ->join('kategori_produk k', 'k.id_kategori = p.id_kategori')
        ->join('transaksi t', 't.id_produk = p.id_produk', 'left')
        ->where('k.nama_kategori', $kategori)
        ->groupBy('p.id_produk')
        ->orderBy('p.nama_produk', 'ASC')
        ->get()
        ->getResultArray();
}
 public function getPrediksiMingguan()
    {
        return $this->db->table('transaksi t')
            ->select('k.nama_kategori, p.nama_produk, ROUND(AVG(t.stok_keluar), 0) AS prediksi')
            ->join('produk p', 'p.id_produk = t.id_produk')
            ->join('kategori_produk k', 'k.id_kategori = p.id_kategori')
            ->where('t.tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)')
            ->groupBy('p.id_produk')
            ->orderBy('k.nama_kategori', 'ASC')
            ->get()
            ->getResultArray();
    }
    public function getWeeklyChartData()
{
    return $this->db->table('transaksi t')
        ->select('DATE(t.tanggal) as tanggal, SUM(t.stok_keluar) as total_keluar')
        ->where('t.tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)')
        ->groupBy('DATE(t.tanggal)')
        ->orderBy('t.tanggal', 'ASC')
        ->get()
        ->getResultArray();
}

}