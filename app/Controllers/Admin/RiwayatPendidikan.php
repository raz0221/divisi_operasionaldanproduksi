<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RiwayatPendidikanModel;

class RiwayatPendidikan extends BaseController
{
    protected $riwayatPendidikanModel;
    protected $perPage = 10;
    
    private $jenjangList = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];

    public function __construct()
    {
        $this->riwayatPendidikanModel = new RiwayatPendidikanModel();
    }

    public function index()
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $search = $this->request->getGet('search');
        $filter_jenjang = $this->request->getGet('filter_jenjang');
        $sort_column = $this->request->getGet('sort_column') ?? 'tahun_masuk';
        $sort_order = $this->request->getGet('sort_order') ?? 'desc';
        $page = $this->request->getGet('page') ?? 1;
        
        $offset = ($page - 1) * $this->perPage;
        
        $riwayat = $this->riwayatPendidikanModel->getPendidikan($search, $filter_jenjang, $this->perPage, $offset, $sort_column, $sort_order);
        $total = $this->riwayatPendidikanModel->countPendidikan($search, $filter_jenjang);
        
        $pager = [
            'current_page' => (int)$page,
            'total_pages' => ceil($total / $this->perPage),
            'total_items' => $total,
            'per_page' => $this->perPage
        ];

        $data = [
            'title' => 'Data Riwayat Pendidikan',
            'riwayat' => $riwayat,
            'pager' => $pager,
            'search' => $search,
            'filter_jenjang' => $filter_jenjang,
            'sort_column' => $sort_column,
            'sort_order' => $sort_order,
            'jenjangList' => $this->jenjangList,
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ]
        ];

        return view('admin/riwayat_pendidikan/index', $data);
    }

    public function create()
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Riwayat Pendidikan',
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'jenjangList' => $this->jenjangList,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/riwayat_pendidikan/create', $data);
    }

    public function store()
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        // Validasi input
        $rules = [
            'jenjang' => 'required|in_list[SD,SMP,SMA,D3,S1,S2,S3]',
            'nama_sekolah' => 'required|min_length[3]|max_length[200]',
            'jurusan' => 'permit_empty|min_length[2]|max_length[100]',
            'tahun_masuk' => 'required|numeric|min_length[4]|max_length[4]',
            'tahun_lulus' => 'required|numeric|min_length[4]|max_length[4]',
            'nilai_akhir' => 'permit_empty|decimal',
            'keterangan' => 'permit_empty|max_length[500]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'jenjang' => $this->request->getPost('jenjang'),
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'jurusan' => $this->request->getPost('jurusan'),
            'tahun_masuk' => $this->request->getPost('tahun_masuk'),
            'tahun_lulus' => $this->request->getPost('tahun_lulus'),
            'nilai_akhir' => $this->request->getPost('nilai_akhir'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        if ($this->riwayatPendidikanModel->save($data)) {
            return redirect()->to('/admin/riwayat-pendidikan')->with('success', 'Data riwayat pendidikan berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan data riwayat pendidikan.');
        }
    }

    public function edit($id)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Edit Riwayat Pendidikan',
            'riwayat' => $this->riwayatPendidikanModel->find($id),
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'jenjangList' => $this->jenjangList,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/riwayat_pendidikan/edit', $data);
    }

    public function update($id)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        // Validasi input
        $rules = [
            'jenjang' => 'required|in_list[SD,SMP,SMA,D3,S1,S2,S3]',
            'nama_sekolah' => 'required|min_length[3]|max_length[200]',
            'jurusan' => 'permit_empty|min_length[2]|max_length[100]',
            'tahun_masuk' => 'required|numeric|min_length[4]|max_length[4]',
            'tahun_lulus' => 'required|numeric|min_length[4]|max_length[4]',
            'nilai_akhir' => 'permit_empty|decimal',
            'keterangan' => 'permit_empty|max_length[500]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_pendidikan' => $id,
            'jenjang' => $this->request->getPost('jenjang'),
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'jurusan' => $this->request->getPost('jurusan'),
            'tahun_masuk' => $this->request->getPost('tahun_masuk'),
            'tahun_lulus' => $this->request->getPost('tahun_lulus'),
            'nilai_akhir' => $this->request->getPost('nilai_akhir'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        if ($this->riwayatPendidikanModel->save($data)) {
            return redirect()->to('/admin/riwayat-pendidikan')->with('success', 'Data riwayat pendidikan berhasil diupdate.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengupdate data riwayat pendidikan.');
        }
    }

    // PERBAIKAN: Function delete disederhanakan
    public function delete($id)
{
    // Cek apakah user sudah login dan role admin
    if (!session()->get('logged_in') || session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }

    $this->riwayatPendidikanModel->delete($id);
    return redirect()->to('/admin/riwayat-pendidikan')->with('success', 'Data riwayat pendidikan berhasil dihapus.');
}
}