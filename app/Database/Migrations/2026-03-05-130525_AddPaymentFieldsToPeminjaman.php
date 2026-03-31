<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPaymentFieldsToPeminjaman extends Migration
{
    public function up()
    {
        $fields = [
            'pembayaran_status' => [
                'type' => 'ENUM',
                'constraint' => ['Belum Dibayar', 'Pending', 'Lunas', 'Gagal'],
                'default' => 'Belum Dibayar',
                'after' => 'denda'
            ],
            'snap_token' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'pembayaran_status'
            ],
        ];
        $this->forge->addColumn('peminjaman', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('peminjaman', ['pembayaran_status', 'snap_token']);
    }
}
