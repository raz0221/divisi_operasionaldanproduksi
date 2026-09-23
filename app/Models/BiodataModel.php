<?php

namespace App\Models;

use CodeIgniter\Model;

class BiodataModel extends Model
{
    protected $table = 'biodata';
    protected $primaryKey = 'id_biodata';
    protected $allowedFields = [
        'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 
        'agama', 'alamat', 'email', 'no_telpon', 'status_perkawinan', 
        'pekerjaan', 'pendidikan_terakhir'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    public function getBiodata($search = null, $filter_jenis_kelamin = null, $filter_agama = null, $filter_status = null, $limit = 10, $offset = 0, $sort_column = 'nama', $sort_order = 'asc')
    {
        $builder = $this->db->table($this->table);
        
        if ($search) {
            $builder->groupStart()
                    ->like('nama', $search)
                    ->orLike('tempat_lahir', $search)
                    ->orLike('email', $search)
                    ->orLike('alamat', $search)
                    ->orLike('pekerjaan', $search)
                    ->orLike('pendidikan_terakhir', $search)
                    ->orLike('no_telpon', $search)
                    ->groupEnd();
        }
        
        if ($filter_jenis_kelamin) {
            $builder->where('jenis_kelamin', $filter_jenis_kelamin);
        }
        
        if ($filter_agama) {
            $builder->where('agama', $filter_agama);
        }
        
        if ($filter_status) {
            $builder->where('status_perkawinan', $filter_status);
        }
        
        $builder->orderBy($sort_column, $sort_order);
        $builder->limit($limit, $offset);
        
        return $builder->get()->getResultArray();
    }
    
    public function countBiodata($search = null, $filter_jenis_kelamin = null, $filter_agama = null, $filter_status = null)
    {
        $builder = $this->db->table($this->table);
        
        if ($search) {
            $builder->groupStart()
                    ->like('nama', $search)
                    ->orLike('tempat_lahir', $search)
                    ->orLike('email', $search)
                    ->orLike('alamat', $search)
                    ->orLike('pekerjaan', $search)
                    ->orLike('pendidikan_terakhir', $search)
                    ->orLike('no_telpon', $search)
                    ->groupEnd();
        }
        
        if ($filter_jenis_kelamin) {
            $builder->where('jenis_kelamin', $filter_jenis_kelamin);
        }
        
        if ($filter_agama) {
            $builder->where('agama', $filter_agama);
        }
        
        if ($filter_status) {
            $builder->where('status_perkawinan', $filter_status);
        }
        
        return $builder->countAllResults();
    }
}