<?php

namespace App\Models;
use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori_produk';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['nama_kategori', 'deskripsi', 'created_at'];
    protected $useTimestamps = false;
}
