<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_kategori' => 'Sains'],
            ['nama_kategori' => 'Teknologi'],
            ['nama_kategori' => 'Sastra'],
            ['nama_kategori' => 'Sejarah'],
            ['nama_kategori' => 'Psikologi'],
            ['nama_kategori' => 'Fiksi'],
            ['nama_kategori' => 'Non-Fiksi'],
        ];

        $this->db->table('kategori')->insertBatch($data);
    }
}
