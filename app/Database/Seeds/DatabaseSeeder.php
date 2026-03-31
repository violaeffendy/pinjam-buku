<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->db->disableForeignKeyChecks();

        $this->db->table('peminjaman')->truncate();
        $this->db->table('buku')->truncate();
        $this->db->table('kategori')->truncate();
        $this->db->table('users')->truncate();
        $this->db->table('roles')->truncate();

        $this->call('RoleSeeder');
        $this->call('UserSeeder');
        $this->call('KategoriSeeder');
        $this->call('BukuSeeder');
        $this->call('PeminjamanSeeder');

        $this->db->enableForeignKeyChecks();
    }
}
