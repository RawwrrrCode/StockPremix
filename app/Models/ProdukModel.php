<?php

namespace App\Models;
use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = ['nama_produk', 'id_kategori', 'stok'];
    protected $useTimestamps = false; // nonaktifkan timestamps

    public function getAllProduk()
    {
        return $this->select('produk.*, kategori_produk.nama_kategori')
                    ->join('kategori_produk', 'kategori_produk.id_kategori = produk.id_kategori', 'left')
                    ->orderBy('produk.nama_produk', 'ASC')
                    ->findAll();
    }
}
