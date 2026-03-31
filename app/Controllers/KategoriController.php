<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    public function index()
    {
        $model = new KategoriModel();
        $data = [
            'title' => 'Kelola Kategori',
            'kategori' => $model->findAll()
        ];
        return view('kategori/index', $data);
    }

    public function store()
    {
        $model = new KategoriModel();
        $model->save([
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);
        session()->setFlashdata('success', 'Kategori berhasil ditambahkan');
        return redirect()->to('/kategori');
    }

    public function update($id)
    {
        $model = new KategoriModel();
        $model->update($id, [
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);
        session()->setFlashdata('success', 'Kategori berhasil diupdate');
        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $model = new KategoriModel();
        $model->delete($id);
        session()->setFlashdata('success', 'Kategori berhasil dihapus');
        return redirect()->to('/kategori');
    }
}
