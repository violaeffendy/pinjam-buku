<?php
// Simplified PHP script to simulate payment database updates
$host = 'localhost';
$db = 'perpus';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $id = 6; // Transaction ID with fine

    echo "--- SIMULASI PEMBAYARAN DENDA (Sederhana) ---\n";

    // 1. Fetch current status
    $stmt = $pdo->prepare("SELECT id, denda, pembayaran_status FROM peminjaman WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if (!$row) {
        die("Error: Transaksi ID 6 tidak ditemukan.\n");
    }

    echo "ID Transaksi  : " . $row['id'] . "\n";
    echo "Total Denda   : Rp " . number_format($row['denda'], 0, ',', '.') . "\n";
    echo "Status Awal   : " . $row['pembayaran_status'] . "\n\n";

    // 2. Simulate Token Generation (Frontend process)
    echo "1. Simulasi generate Snap Token...\n";
    $token = "MOCK-SNAP-" . bin2hex(random_bytes(8));
    $stmt = $pdo->prepare("UPDATE peminjaman SET snap_token = ?, pembayaran_status = 'Pending' WHERE id = ?");
    $stmt->execute([$token, $id]);
    echo "   [OK] Token: $token. Status -> Pending.\n\n";

    // 3. Simulate Notification Success (Webhook process)
    echo "2. Simulasi Webhook: Notifikasi Lunas diterima...\n";
    $stmt = $pdo->prepare("UPDATE peminjaman SET pembayaran_status = 'Lunas' WHERE id = ?");
    $stmt->execute([$id]);
    echo "   [OK] Status -> Lunas.\n\n";

    // 4. Final verification
    $stmt = $pdo->prepare("SELECT id, pembayaran_status, snap_token FROM peminjaman WHERE id = ?");
    $stmt->execute([$id]);
    $final = $stmt->fetch();

    echo "--- HASIL AKHIR ---\n";
    echo "Status Bayar: " . $final['pembayaran_status'] . "\n";
    echo "Snap Token  : " . $final['snap_token'] . "\n";
    echo "--------------------------------------------\n";
    echo "Simulasi Selesai. Sistem siap digunakan.\n";

} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
