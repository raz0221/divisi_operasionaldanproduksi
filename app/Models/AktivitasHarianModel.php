<?php

namespace App\Models;

use CodeIgniter\Model;

class AktivitasHarianModel extends Model
{
    protected $table = 'aktivitas_harian';
    protected $primaryKey = 'id_aktivitas';
    protected $allowedFields = ['tanggal', 'jam', 'nama_aktivitas', 'media_file', 'jenis_media'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAktivitas($search = null, $filter_tanggal = null, $limit = 10, $offset = 0, $sort_column = 'tanggal', $sort_order = 'desc')
    {
        $builder = $this->db->table($this->table);
        
        if ($search) {
            $builder->groupStart()
                    ->like('nama_aktivitas', $search)
                    ->orLike('jam', $search)
                    ->groupEnd();
        }
        
        if ($filter_tanggal) {
            $builder->where('tanggal', $filter_tanggal);
        }
        
        $builder->orderBy($sort_column, $sort_order);
        $builder->limit($limit, $offset);
        
        return $builder->get()->getResultArray();
    }
    
    public function countAktivitas($search = null, $filter_tanggal = null)
    {
        $builder = $this->db->table($this->table);
        
        if ($search) {
            $builder->groupStart()
                    ->like('nama_aktivitas', $search)
                    ->orLike('jam', $search)
                    ->groupEnd();
        }
        
        if ($filter_tanggal) {
            $builder->where('tanggal', $filter_tanggal);
        }
        
        return $builder->countAllResults();
    }
}