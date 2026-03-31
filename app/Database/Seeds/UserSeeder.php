<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role_id' => 1, // Admin
                'nama_lengkap' => 'Administrator',
                'alamat' => 'Kantor Pusat',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'petugas1',
                'email' => 'petugas1@example.com',
                'password' => password_hash('petugas123', PASSWORD_DEFAULT),
                'role_id' => 2, // Petugas
                'nama_lengkap' => 'Budi Staff',
                'alamat' => 'Jl. Pustaka No. 10',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'member1',
                'email' => 'member1@example.com',
                'password' => password_hash('member123', PASSWORD_DEFAULT),
                'role_id' => 3, // Anggota
                'nama_lengkap' => 'Siti Member',
                'alamat' => 'Jl. Buku No. 5',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
