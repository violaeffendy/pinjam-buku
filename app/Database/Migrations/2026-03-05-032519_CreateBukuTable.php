<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBukuTable extends Migration
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
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'penulis' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'penerbit' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'tahun_terbit' => [
                'type' => 'YEAR',
            ],
            'kategori_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'stok' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'cover' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'qr_code' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
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
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('buku');
    }

    public function down()
    {
        $this->forge->dropTable('buku');
    }
}
