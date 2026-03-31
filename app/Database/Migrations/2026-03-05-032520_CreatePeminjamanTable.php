<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeminjamanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'buku_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'tgl_pinjam' => [
                'type' => 'DATE',
            ],
            'tgl_kembali' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tgl_dikembalikan' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Dipinjam', 'Dikembalikan', 'Terlambat'],
                'default' => 'Dipinjam',
            ],
            'denda' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('buku_id', 'buku', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman');
    }
}
