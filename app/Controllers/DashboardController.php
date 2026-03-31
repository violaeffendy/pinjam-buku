<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use App\Models\BukuModel;
use App\Models\PeminjamanModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $role_id = session()->get('role_id');
        $user_id = session()->get('user_id');

        $bukuModel = new BukuModel();
        $userModel = new UserModel();
        $peminjamanModel = new PeminjamanModel();

        $data = [
            'title' => 'Dashboard Overview',
            'stats' => [
                'total_buku' => $bukuModel->countAllResults(),
                'total_user' => $userModel->countAllResults(),
                'total_pinjam' => $peminjamanModel->where('status', 'Dipinjam')->countAllResults(),
                'total_kembali' => $peminjamanModel->where('status', 'Dikembalikan')->countAllResults(),
            ]
        ];

        if ($role_id == 3) { // Member
            $data['stats']['my_loans'] = $peminjamanModel->where('user_id', $user_id)->countAllResults();
            $data['recent_loans'] = $peminjamanModel->select('peminjaman.*, buku.judul, users.nama_lengkap')
                ->join('buku', 'buku.id = peminjaman.buku_id')
                ->join('users', 'users.id = peminjaman.user_id')
                ->where('peminjaman.user_id', $user_id)
                ->orderBy('peminjaman.created_at', 'DESC')
                ->limit(5)
                ->findAll();
        } else {
            $data['recent_loans'] = $peminjamanModel->select('peminjaman.*, buku.judul, users.nama_lengkap')
                ->join('buku', 'buku.id = peminjaman.buku_id')
                ->join('users', 'users.id = peminjaman.user_id')
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->findAll();
        }

        return view('dashboard/index', $data);
    }
}
