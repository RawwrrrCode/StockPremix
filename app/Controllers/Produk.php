<?php

namespace App\Controllers;
use App\Models\ProdukModel;
use App\Models\KategoriModel;

class Produk extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }

    // ✅ Halaman daftar produk
    public function index()
    {
        $data = [
            'title' => 'Data Produk',
            'produk' => $this->produkModel->getAllProduk()
        ];
        return view('produk/index', $data);
    }

    // ✅ Form tambah produk
    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('produk/create', $data);
    }

    // ✅ Simpan produk baru
    public function store()
    {
        $this->produkModel->insert([
            'nama_produk' => $this->request->getPost('nama_produk'),
            'id_kategori' => $this->request->getPost('id_kategori'),
        ]);

        return redirect()->to('/produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    // ✅ Form edit produk
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Produk',
            'produk' => $this->produkModel->find($id),
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('produk/edit', $data);
    }

    // ✅ Update data produk
public function update($id)
{
    $data = [
        'nama_produk' => $this->request->getPost('nama_produk'),
        'id_kategori' => $this->request->getPost('id_kategori'),
        'stok'        => $this->request->getPost('stok') ?? 0
    ];

    // ✅ Cek data sebelum update
    if (empty(array_filter($data))) {
        return redirect()->back()->with('error', 'Data tidak boleh kosong!');
    }

    // ✅ Update data
    $this->produkModel->update($id, $data);

    return redirect()->to('/produk')->with('success', 'Produk berhasil diperbarui.');
}




    // ✅ Hapus produk
    public function delete($id)
    {
        $this->produkModel->delete($id);
        return redirect()->to('/produk')->with('success', 'Produk berhasil dihapus.');
    }
}
