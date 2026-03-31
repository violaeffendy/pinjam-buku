<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\BukuModel;
use App\Models\KategoriModel;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class BukuController extends BaseController
{
    public function index()
    {
        $model = new BukuModel();
        $data = [
            'title' => 'Kelola Buku',
            'buku' => $model->select('buku.*, kategori.nama_kategori')
                ->join('kategori', 'kategori.id = buku.kategori_id')
                ->findAll()
        ];
        return view('buku/index', $data);
    }

    public function create()
    {
        $katModel = new KategoriModel();
        $data = [
            'title' => 'Tambah Buku',
            'kategori' => $katModel->findAll()
        ];
        return view('buku/create', $data);
    }

    public function store()
    {
        $model = new BukuModel();

        $fileCover = $this->request->getFile('cover');
        $namaCover = 'default.jpg';
        if ($fileCover->isValid() && !$fileCover->hasMoved()) {
            $namaCover = $fileCover->getRandomName();
            $fileCover->move('uploads/covers', $namaCover);
        }

        $judul = $this->request->getVar('judul');
        // Generate QR Code
        $options = new QROptions([
            'version' => 5,
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel' => QRCode::ECC_L,
        ]);

        $qrName = time() . '.svg';
        $qrPath = 'uploads/qrcodes/' . $qrName;
        (new QRCode($options))->render($judul, $qrPath);

        $model->save([
            'judul' => $judul,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'kategori_id' => $this->request->getVar('kategori_id'),
            'stok' => $this->request->getVar('stok'),
            'cover' => $namaCover,
            'qr_code' => $qrName
        ]);

        session()->setFlashdata('success', 'Buku berhasil ditambahkan');
        return redirect()->to('/buku');
    }

    public function edit($id)
    {
        $model = new BukuModel();
        $katModel = new KategoriModel();
        $data = [
            'title' => 'Edit Buku',
            'buku' => $model->find($id),
            'kategori' => $katModel->findAll()
        ];
        return view('buku/edit', $data);
    }

    public function update($id)
    {
        $model = new BukuModel();
        $bukuLama = $model->find($id);

        $fileCover = $this->request->getFile('cover');
        if ($fileCover->getError() == 4) {
            $namaCover = $this->request->getVar('coverLama');
        } else {
            $namaCover = $fileCover->getRandomName();
            $fileCover->move('uploads/covers', $namaCover);
            if ($bukuLama['cover'] != 'default.jpg') {
                unlink('uploads/covers/' . $bukuLama['cover']);
            }
        }

        $model->update($id, [
            'judul' => $this->request->getVar('judul'),
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'kategori_id' => $this->request->getVar('kategori_id'),
            'stok' => $this->request->getVar('stok'),
            'cover' => $namaCover
        ]);

        session()->setFlashdata('success', 'Buku berhasil diupdate');
        return redirect()->to('/buku');
    }

    public function delete($id)
    {
        $model = new BukuModel();
        $buku = $model->find($id);
        if ($buku['cover'] != 'default.jpg') {
            unlink('uploads/covers/' . $buku['cover']);
        }
        unlink('uploads/qrcodes/' . $buku['qr_code']);
        $model->delete($id);

        session()->setFlashdata('success', 'Buku berhasil dihapus');
        return redirect()->to('/buku');
    }
}
