<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PeminjamanModel;
use App\Models\BukuModel;
use App\Models\UserModel;

class PeminjamanController extends BaseController
{
    public function index()
    {
        $model = new PeminjamanModel();
        $data = [
            'title' => 'Data Transaksi',
            'transaksi' => $model->select('peminjaman.*, buku.judul, users.nama_lengkap')
                ->join('buku', 'buku.id = peminjaman.buku_id')
                ->join('users', 'users.id = peminjaman.user_id')
                ->orderBy('peminjaman.created_at', 'DESC')
                ->findAll()
        ];
        return view('peminjaman/index', $data);
    }

    public function pinjam()
    {
        $bukuModel = new BukuModel();
        $userModel = new UserModel();
        $data = [
            'title' => 'Tambah Peminjaman',
            'buku' => $bukuModel->where('stok >', 0)->findAll(),
            'users' => $userModel->where('role_id', 3)->findAll() // Only members
        ];
        return view('peminjaman/pinjam', $data);
    }

    public function store()
    {
        $pModel = new PeminjamanModel();
        $bModel = new BukuModel();

        $buku_id = $this->request->getVar('buku_id');
        $buku = $bModel->find($buku_id);

        if ($buku['stok'] <= 0) {
            session()->setFlashdata('error', 'Stok buku habis');
            return redirect()->back();
        }

        $pModel->save([
            'user_id' => $this->request->getVar('user_id'),
            'buku_id' => $buku_id,
            'tgl_pinjam' => date('Y-m-d'),
            'tgl_kembali' => date('Y-m-d', strtotime('+7 days')),
            'status' => 'Dipinjam',
            'denda' => 0
        ]);

        // Reduce stock
        $bModel->update($buku_id, ['stok' => $buku['stok'] - 1]);

        session()->setFlashdata('success', 'Peminjaman berhasil dicatat');
        return redirect()->to('/transaksi');
    }

    public function kembali($id)
    {
        $pModel = new PeminjamanModel();
        $bModel = new BukuModel();

        $pinjam = $pModel->find($id);
        $buku = $bModel->find($pinjam['buku_id']);

        $tgl_kembali = strtotime($pinjam['tgl_kembali']);
        $tgl_sekarang = strtotime(date('Y-m-d'));

        $denda = 0;
        if ($tgl_sekarang > $tgl_kembali) {
            $selisih = ($tgl_sekarang - $tgl_kembali) / (60 * 60 * 24);
            $denda = $selisih * 1000; // Rp 1,000 per day
        }

        $pModel->update($id, [
            'tgl_dikembalikan' => date('Y-m-d'),
            'status' => 'Dikembalikan',
            'denda' => $denda
        ]);

        // Increase stock
        $bModel->update($pinjam['buku_id'], ['stok' => $buku['stok'] + 1]);

        session()->setFlashdata('success', 'Buku berhasil dikembalikan' . ($denda > 0 ? '. Denda: Rp ' . number_format($denda, 0, ',', '.') : ''));
        return redirect()->to('/transaksi');
    }

    public function pinjamanSaya()
    {
        $model = new PeminjamanModel();
        $user_id = session()->get('user_id');
        $data = [
            'title' => 'Riwayat Pinjaman Saya',
            'transaksi' => $model->select('peminjaman.*, buku.judul, users.nama_lengkap')
                ->join('buku', 'buku.id = peminjaman.buku_id')
                ->join('users', 'users.id = peminjaman.user_id')
                ->where('peminjaman.user_id', $user_id)
                ->orderBy('peminjaman.created_at', 'DESC')
                ->findAll()
        ];
        return view('peminjaman/index', $data); // We can reuse the index view
    }
}
