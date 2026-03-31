<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Penguin Random House',
                'tahun_terbit' => 2018,
                'stok' => 5,
                'kategori_id' => 5, // Psikologi
                'cover' => 'default.jpg',
                'qr_code' => 'buku1.svg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'The Pragmatic Programmer',
                'penulis' => 'Andrew Hunt, David Thomas',
                'penerbit' => 'Addison-Wesley',
                'tahun_terbit' => 1999,
                'stok' => 3,
                'kategori_id' => 2, // Teknologi
                'cover' => 'default.jpg',
                'qr_code' => 'buku2.svg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Sapiens: A Brief History of Humankind',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'Harper',
                'tahun_terbit' => 2011,
                'stok' => 4,
                'kategori_id' => 4, // Sejarah
                'cover' => 'default.jpg',
                'qr_code' => 'buku3.svg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'Clean Code',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2008,
                'stok' => 2,
                'kategori_id' => 2, // Teknologi
                'cover' => 'default.jpg',
                'qr_code' => 'buku4.svg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul' => 'To Kill a Mockingbird',
                'penulis' => 'Harper Lee',
                'penerbit' => 'J.B. Lippincott & Co.',
                'tahun_terbit' => 1960,
                'stok' => 6,
                'kategori_id' => 3, // Sastra
                'cover' => 'default.jpg',
                'qr_code' => 'buku5.svg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('buku')->insertBatch($data);
    }
}
