<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatPendidikanModel extends Model
{
    protected $table = 'riwayat_pendidikan';
    protected $primaryKey = 'id_pendidikan';
    protected $allowedFields = [
        'jenjang', 'nama_sekolah', 'jurusan', 'tahun_masuk', 
        'tahun_lulus', 'nilai_akhir', 'keterangan'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    public function getPendidikan($search = null, $filter_jenjang = null, $limit = 10, $offset = 0, $sort_column = 'tahun_masuk', $sort_order = 'desc')
    {
        $builder = $this->db->table($this->table);
        
        if ($search) {
            $builder->groupStart()
                    ->like('nama_sekolah', $search)
                    ->orLike('jurusan', $search)
                    ->orLike('keterangan', $search)
                    ->groupEnd();
        }
        
        if ($filter_jenjang) {
            $builder->where('jenjang', $filter_jenjang);
        }
        
        $builder->orderBy($sort_column, $sort_order);
        $builder->limit($limit, $offset);
        
        return $builder->get()->getResultArray();
    }
    
    public function countPendidikan($search = null, $filter_jenjang = null)
    {
        $builder = $this->db->table($this->table);
        
        if ($search) {
            $builder->groupStart()
                    ->like('nama_sekolah', $search)
                    ->orLike('jurusan', $search)
                    ->orLike('keterangan', $search)
                    ->groupEnd();
        }
        
        if ($filter_jenjang) {
            $builder->where('jenjang', $filter_jenjang);
        }
        
        return $builder->countAllResults();
    }
}