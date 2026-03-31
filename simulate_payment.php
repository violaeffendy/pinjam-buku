<?php
// Bootstrap CI4
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
define('ENVIRONMENT', 'development');
defined('ROOTPATH') || define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);
defined('APPPATH') || define('APPPATH', ROOTPATH . 'app' . DIRECTORY_SEPARATOR);
defined('SYSTEMPATH') || define('SYSTEMPATH', ROOTPATH . 'vendor' . DIRECTORY_SEPARATOR . 'codeigniter4' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR);

require_once SYSTEMPATH . 'bootstrap.php';
require_once APPPATH . 'Config/Constants.php';
require_once ROOTPATH . 'vendor/autoload.php';

$app = Config\Services::codeigniter();
$app->initialize();

use App\Models\PeminjamanModel;
use Midtrans\Config;
use Midtrans\Snap;

// 1. Setup Midtrans (Mocking config if keys not real)
Config::$serverKey = env('MIDTRANS_SERVER_KEY') ?: 'SB-Mid-server-XXXXX';
Config::$isProduction = false;

$model = new PeminjamanModel();
$id = 6; // Our test transaction
$pinjam = $model->find($id);

echo "--- SIMULASI PAYMENT GATWAY MIDTRANS ---\n";
if (!$pinjam) {
    die("Transaksi ID 6 tidak ditemukan. Silakan cek tabel peminjaman.\n");
}
echo "Transaksi ID: " . $pinjam['id'] . "\n";
echo "Judul Buku  : [ID: " . $pinjam['buku_id'] . "]\n";
echo "Denda       : Rp " . number_format($pinjam['denda'], 0, ',', '.') . "\n";
echo "Status Awal : " . (isset($pinjam['pembayaran_status']) ? $pinjam['pembayaran_status'] : 'N/A') . "\n\n";

// STEP 1: Generate Snap Token
echo "1. Menghasilkan Snap Token...\n";
try {
    // We try to get token, but if keys are invalid, we'll catch and simulate
    $snapToken = "MOCK-SNAP-TOKEN-" . bin2hex(random_bytes(8));
    echo "   [SUCCESS] Snap Token: " . $snapToken . "\n";

    // Save to DB
    $model->update($id, [
        'snap_token' => $snapToken,
        'pembayaran_status' => 'Pending'
    ]);
    echo "   [DB UPDATE] Status diubah menjadi 'Pending', Token disimpan.\n\n";
} catch (\Exception $e) {
    echo "   [ERROR] " . $e->getMessage() . "\n\n";
}

// STEP 2: Simulate Notification Callback (The Webhook)
echo "2. Mensimulasikan Notifikasi Webhook (Pembayaran Berhasil)...\n";
echo "   Menerima callback 'settlement' dari Midtrans...\n";

// Simulation logic from PaymentController
$simulation_status = 'settlement';
$status_pembayaran = 'Pending';

if ($simulation_status == 'settlement') {
    $status_pembayaran = 'Lunas';
}

$model->update($id, [
    'pembayaran_status' => $status_pembayaran
]);

echo "   [DB UPDATE] Status diubah menjadi '" . $status_pembayaran . "'\n\n";

// Final Check
$final = $model->find($id);
echo "--- HASIL AKHIR ---\n";
echo "ID: " . $final['id'] . " | Pembayaran: " . $final['pembayaran_status'] . " | Token: " . $final['snap_token'] . "\n";
echo "----------------------------------------\n";
