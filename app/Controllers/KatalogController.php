<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\BukuModel;
use App\Models\PeminjamanModel;

class KatalogController extends BaseController
{
    public function index()
    {
        $model = new BukuModel();
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $buku = $model->select('buku.*, kategori.nama_kategori')
                ->join('kategori', 'kategori.id = buku.kategori_id')
                ->like('judul', $keyword)
                ->orLike('penulis', $keyword)
                ->findAll();
        } else {
            $buku = $model->select('buku.*, kategori.nama_kategori')
                ->join('kategori', 'kategori.id = buku.kategori_id')
                ->findAll();
        }

        $data = [
            'title' => 'Katalog Buku',
            'buku' => $buku,
            'keyword' => $keyword
        ];
        return view('katalog/index', $data);
    }

    public function history()
    {
        $model = new PeminjamanModel();
        $user_id = session()->get('user_id');

        $data = [
            'title' => 'Riwayat Pinjaman Saya',
            'transaksi' => $model->select('peminjaman.*, buku.judul')
                ->join('buku', 'buku.id = peminjaman.buku_id')
                ->where('user_id', $user_id)
                ->orderBy('peminjaman.created_at', 'DESC')
                ->findAll()
        ];
        return view('katalog/history', $data);
    }
}
