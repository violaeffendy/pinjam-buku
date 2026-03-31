<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use App\Models\RoleModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $roleModel = new RoleModel();
        $data = [
            'title' => 'User Management',
            'users' => $model->select('users.*, roles.nama_role')
                ->join('roles', 'roles.id = users.role_id')
                ->findAll(),
            'roles' => $roleModel->findAll()
        ];
        return view('users/index', $data);
    }

    public function store()
    {
        $model = new UserModel();
        $password = $this->request->getVar('password');

        $model->save([
            'username' => $this->request->getVar('username'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'role_id' => $this->request->getVar('role_id'),
            'alamat' => $this->request->getVar('alamat')
        ]);

        session()->setFlashdata('success', 'User berhasil ditambahkan');
        return redirect()->to('/users');
    }

    public function update($id)
    {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getVar('username'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'role_id' => $this->request->getVar('role_id'),
            'alamat' => $this->request->getVar('alamat')
        ];

        $password = $this->request->getVar('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $model->update($id, $data);

        session()->setFlashdata('success', 'User berhasil diupdate');
        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        session()->setFlashdata('success', 'User berhasil dihapus');
        return redirect()->to('/users');
    }
}
