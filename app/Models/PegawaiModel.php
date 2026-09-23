<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id_pegawai';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_pegawai', 'tanggal_lahir', 'jenis_kelamin', 'foto_pegawai'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'nama_pegawai' => 'required|min_length[3]|max_length[100]',
        'tanggal_lahir' => 'required|valid_date',
        'jenis_kelamin' => 'required|in_list[laki-laki,perempuan]',
        'foto_pegawai' => 'permit_empty'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getPegawai($search = null, $gender = null, $limit = 10, $offset = 0, $sort_column = 'nama_pegawai', $sort_order = 'asc')
{
    $builder = $this->builder();
    
    if ($search) {
        $builder->groupStart()
                ->like('nama_pegawai', $search)
                ->orLike('jenis_kelamin', $search)
                ->orLike('tanggal_lahir', $search)
                ->groupEnd();
    }
    
    if ($gender) {
        $builder->where('jenis_kelamin', $gender);
    }
    
    $builder->orderBy($sort_column, $sort_order)
            ->limit($limit, $offset);
    
    return $builder->get()->getResultArray();
}

public function countPegawai($search = null, $gender = null)
{
    $builder = $this->builder();
    
    if ($search) {
        $builder->groupStart()
                ->like('nama_pegawai', $search)
                ->orLike('jenis_kelamin', $search)
                ->orLike('tanggal_lahir', $search)
                ->groupEnd();
    }
    
    if ($gender) {
        $builder->where('jenis_kelamin', $gender);
    }
    
    return $builder->countAllResults();
}
}