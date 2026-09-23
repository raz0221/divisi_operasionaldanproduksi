<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RiwayatPendidikan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pendidikan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jenjang' => [
                'type'       => 'ENUM',
                'constraint' => ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'],
                'null'       => false,
            ],
            'nama_sekolah' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null'       => false,
            ],
            'jurusan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'tahun_masuk' => [
                'type'       => 'YEAR',
                'null'       => false,
            ],
            'tahun_lulus' => [
                'type'       => 'YEAR',
                'null'       => false,
            ],
            'nilai_akhir' => [
                'type'       => 'DECIMAL',
                'constraint' => '4,2',
                'null'       => true,
            ],
            'keterangan' => [
                'type'       => 'TEXT',
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
        
        $this->forge->addPrimaryKey('id_pendidikan');
        $this->forge->createTable('riwayat_pendidikan');
    }

    public function down()
    {
        $this->forge->dropTable('riwayat_pendidikan');
    }
}