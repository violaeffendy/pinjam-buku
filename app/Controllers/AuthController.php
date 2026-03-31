<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function login()
    {
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role_id' => $user['role_id'],
                    'nama' => $user['nama_lengkap'],
                    'logged_in' => true,
                ];
                session()->set($sessionData);
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('error', 'Password Salah');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
