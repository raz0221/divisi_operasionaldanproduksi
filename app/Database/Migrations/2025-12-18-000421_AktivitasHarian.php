<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AktivitasHarian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_aktivitas' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type'       => 'DATE',
                'null'       => false,
            ],
            'jam' => [
                'type'       => 'TIME',
                'null'       => false,
            ],
            'nama_aktivitas' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null'       => false,
            ],
            'media_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'jenis_media' => [
                'type'       => 'ENUM',
                'constraint' => ['foto', 'video'],
                'null'       => true,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
        
        $this->forge->addPrimaryKey('id_aktivitas');
        $this->forge->createTable('aktivitas_harian');
    }

    public function down()
    {
        $this->forge->dropTable('aktivitas_harian');
    }
}