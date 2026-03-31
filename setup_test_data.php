<?php

require_once 'app/Config/Constants.php';
require_once 'vendor/autoload.php';

$config = new \Config\Database();
$db = \Config\Database::connect();

// Add a denda to a loan for member1 (user_id 3)
$db->table('peminjaman')
    ->where('id', 3)
    ->update([
        'denda' => 15000,
        'pembayaran_status' => 'Belum Dibayar',
        'status' => 'Dikembalikan'
    ]);

echo "Denda updated for loan ID 3. Amount: 15000\n";
