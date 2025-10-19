<?php

namespace App\Models;
use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table = 'produk';

    public function getStokByKategori($kategori)
    {
        return $this->select('produk.nama_produk, produk.stok, kategori_produk.nama_kategori')
                    ->join('kategori_produk', 'kategori_produk.id_kategori = produk.id_kategori')
                    ->where('kategori_produk.nama_kategori', $kategori)
                    ->orderBy('produk.nama_produk', 'ASC')
                    ->findAll();
    }
}
