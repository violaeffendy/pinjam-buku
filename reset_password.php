<?php

// Define constants needed by CI4
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);

require_once ROOTPATH . 'vendor/autoload.php';

$config = new \Config\Database();
$db = \Config\Database::connect();

$password = password_hash('password123', PASSWORD_DEFAULT);

$db->table('users')
    ->where('username', 'member1')
    ->update(['password' => $password]);

$db->table('peminjaman')
    ->where('id', 3)
    ->update([
        'denda' => 15000,
        'pembayaran_status' => 'Belum Dibayar',
        'status' => 'Dikembalikan'
    ]);

echo "Member1 password reset to 'password123'. Denda updated for loan ID 3.\n";
