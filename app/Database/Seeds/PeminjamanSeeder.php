<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 3, // member1
                'buku_id' => 1, // Atomic Habits
                'tgl_pinjam' => date('Y-m-d', strtotime('-10 days')),
                'tgl_kembali' => date('Y-m-d', strtotime('-3 days')),
                'tgl_dikembalikan' => date('Y-m-d', strtotime('-2 days')),
                'status' => 'Dikembalikan',
                'denda' => 1000,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 3, // member1
                'buku_id' => 2, // The Pragmatic Programmer
                'tgl_pinjam' => date('Y-m-d', strtotime('-2 days')),
                'tgl_kembali' => date('Y-m-d', strtotime('+5 days')),
                'tgl_dikembalikan' => null,
                'status' => 'Dipinjam',
                'denda' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('peminjaman')->insertBatch($data);
    }
}
