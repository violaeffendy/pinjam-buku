<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel;
use App\Models\UserModel;
use App\Models\PaymentModel;

class PaymentController extends BaseController
{
    protected $peminjamanModel;
    protected $userModel;
    protected $paymentModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->userModel = new UserModel();
        $this->paymentModel = new PaymentModel();
    }

    public function pay($id)
    {
        $pinjam = $this->peminjamanModel->select('peminjaman.*, buku.judul')
            ->join('buku', 'buku.id = peminjaman.buku_id')
            ->find($id);

        if (!$pinjam || $pinjam['denda'] <= 0) {
            session()->setFlashdata('error', 'Transaksi tidak valid atau denda Rp 0');
            return redirect()->back();
        }

        // Check if there is already a pending payment
        $existingPayment = $this->paymentModel->where('peminjaman_id', $id)
            ->where('status', 'pending')
            ->first();

        if ($existingPayment) {
            $transaction_code = $existingPayment['transaction_code'];
        } else {
            $transaction_code = 'TRX' . strtoupper(uniqid());
            $this->paymentModel->insert([
                'user_id' => session()->get('user_id'),
                'peminjaman_id' => $id,
                'transaction_code' => $transaction_code,
                'amount' => (int) $pinjam['denda'],
                'status' => 'pending'
            ]);
        }

        $data = [
            'title' => 'Pilih Metode Pembayaran',
            'pinjam' => $pinjam,
            'transaction_code' => $transaction_code,
            'amount' => $pinjam['denda']
        ];

        return view('payment/index', $data);
    }

    public function process($trx)
    {
        $payment = $this->paymentModel->where('transaction_code', $trx)->first();
        if (!$payment) {
            return redirect()->to('/pinjaman-saya')->with('error', 'Transaksi tidak ditemukan');
        }

        $method = $this->request->getPost('payment_method');
        $this->paymentModel->update($payment['id'], ['payment_method' => $method]);

        $pinjam = $this->peminjamanModel->select('peminjaman.*, buku.judul')
            ->join('buku', 'buku.id = peminjaman.buku_id')
            ->find($payment['peminjaman_id']);

        $data = [
            'title' => 'Proses Pembayaran',
            'payment' => $payment,
            'method' => $method,
            'pinjam' => $pinjam
        ];

        return view('payment/process', $data);
    }

    public function success($trx)
    {
        $payment = $this->paymentModel->where('transaction_code', $trx)->first();
        if (!$payment) {
            return redirect()->to('/pinjaman-saya')->with('error', 'Transaksi tidak ditemukan');
        }

        // Update Payment Status
        $this->paymentModel->update($payment['id'], ['status' => 'paid']);

        // Update Peminjaman Status
        $this->peminjamanModel->update($payment['peminjaman_id'], [
            'pembayaran_status' => 'Lunas'
        ]);

        session()->setFlashdata('success', 'Pembayaran denda berhasil. Terima kasih!');
        return redirect()->to('/pinjaman-saya');
    }

    /**
     * Legacy Midtrans Methods (Commented Out for Reference)
     */
    /*
    public function getToken() { ... }
    public function notification() { ... }
    */
}
