<?php

namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\ProdukModel;

class Transaksi extends BaseController
{
    protected $transaksiModel;
    protected $produkModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->produkModel = new ProdukModel();
    }

    // ✅ Menampilkan daftar transaksi
    public function index()
    {
        $data = [
            'title' => 'Data Transaksi',
            'transaksi' => $this->transaksiModel->getAllTransaksi()
        ];

        return view('transaksi/index', $data);
    }

    // ✅ Form tambah transaksi baru
    public function create()
    {
        $data = [
            'title' => 'Tambah Transaksi',
            'produk' => $this->produkModel->getAllProduk()
        ];

        return view('transaksi/create', $data);
    }

    // ✅ Proses simpan transaksi
    public function store()
    {
        $id_produk = $this->request->getPost('id_produk');
        $stok_masuk = (int)$this->request->getPost('stok_masuk');
        $stok_keluar = (int)$this->request->getPost('stok_keluar');
        $tanggal = date('Y-m-d');

        // Simpan transaksi
        $this->transaksiModel->insert([
            'id_produk' => $id_produk,
            'stok_masuk' => $stok_masuk,
            'stok_keluar' => $stok_keluar,
            'tanggal' => $tanggal
        ]);

        // Ambil stok lama
        $produk = $this->produkModel->find($id_produk);
        $stok_lama = $produk['stok'];

        // Hitung stok baru
        $stok_baru = $stok_lama + $stok_masuk - $stok_keluar;

        // Update ke tabel produk
        $this->produkModel->update($id_produk, ['stok' => $stok_baru]);

        return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil disimpan & stok diperbarui.');
    }
    
    // ✅ Hapus transaksi (opsional)
    public function delete($id)
    {
        $this->transaksiModel->delete($id);
        return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil dihapus.');
    }
}
