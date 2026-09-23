<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BiodataModel;

class Biodata extends BaseController
{
    protected $biodataModel;
    protected $perPage = 10;
    
    // Daftar agama dan status perkawinan
    private $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
    private $statusPerkawinanList = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];

    public function __construct()
    {
        $this->biodataModel = new BiodataModel();
    }

    public function index()
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $search = $this->request->getGet('search');
        $filter_jenis_kelamin = $this->request->getGet('filter_jenis_kelamin');
        $filter_agama = $this->request->getGet('filter_agama');
        $filter_status = $this->request->getGet('filter_status');
        $sort_column = $this->request->getGet('sort_column') ?? 'nama';
        $sort_order = $this->request->getGet('sort_order') ?? 'asc';
        $page = $this->request->getGet('page') ?? 1;
        $offset = ($page - 1) * $this->perPage;
        $biodata = $this->biodataModel->getBiodata(
            $search, 
            $filter_jenis_kelamin, 
            $filter_agama, 
            $filter_status,
            $this->perPage, 
            $offset, 
            $sort_column, 
            $sort_order
        );
        
        $total = $this->biodataModel->countBiodata(
            $search, 
            $filter_jenis_kelamin, 
            $filter_agama,
            $filter_status
        );
        
        $pager = [
            'current_page' => (int)$page,
            'total_pages' => ceil($total / $this->perPage),
            'total_items' => $total,
            'per_page' => $this->perPage
        ];

        $data = [
            'title' => 'Data Biodata',
            'biodata' => $biodata,
            'pager' => $pager,
            'search' => $search,
            'filter_jenis_kelamin' => $filter_jenis_kelamin,
            'filter_agama' => $filter_agama,
            'filter_status' => $filter_status,
            'sort_column' => $sort_column,
            'sort_order' => $sort_order,
            'agamaList' => $this->agamaList,
            'statusList' => $this->statusPerkawinanList,
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ]
        ];

        return view('admin/biodata/index', $data);
    }

    public function create()
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Biodata',
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'agamaList' => $this->agamaList,
            'statusList' => $this->statusPerkawinanList,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/biodata/create', $data);
    }

    public function store()
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        // Validasi input
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'tempat_lahir' => 'required|min_length[3]|max_length[100]',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[laki-laki,perempuan]',
            'agama' => 'required|in_list[Islam,Kristen,Katolik,Hindu,Buddha,Konghucu]',
            'alamat' => 'required|min_length[10]|max_length[500]',
            'email' => 'required|valid_email|max_length[100]',
            'no_telpon' => 'required|min_length[10]|max_length[15]',
            'status_perkawinan' => 'required|in_list[Belum Kawin,Kawin,Cerai Hidup,Cerai Mati]',
            'pekerjaan' => 'required|min_length[3]|max_length[100]',
            'pendidikan_terakhir' => 'required|min_length[2]|max_length[50]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'no_telpon' => $this->request->getPost('no_telpon'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'pendidikan_terakhir' => $this->request->getPost('pendidikan_terakhir')
        ];

        if ($this->biodataModel->save($data)) {
            return redirect()->to('/admin/biodata')->with('success', 'Data biodata berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan data biodata.');
        }
    }

    public function edit($id)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Edit Biodata',
            'biodata' => $this->biodataModel->find($id),
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'agamaList' => $this->agamaList,
            'statusList' => $this->statusPerkawinanList,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/biodata/edit', $data);
    }

    public function update($id)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        // Validasi input
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'tempat_lahir' => 'required|min_length[3]|max_length[100]',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[laki-laki,perempuan]',
            'agama' => 'required|in_list[Islam,Kristen,Katolik,Hindu,Buddha,Konghucu]',
            'alamat' => 'required|min_length[10]|max_length[500]',
            'email' => 'required|valid_email|max_length[100]',
            'no_telpon' => 'required|min_length[10]|max_length[15]',
            'status_perkawinan' => 'required|in_list[Belum Kawin,Kawin,Cerai Hidup,Cerai Mati]',
            'pekerjaan' => 'required|min_length[3]|max_length[100]',
            'pendidikan_terakhir' => 'required|min_length[2]|max_length[50]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_biodata' => $id,
            'nama' => $this->request->getPost('nama'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'no_telpon' => $this->request->getPost('no_telpon'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'pendidikan_terakhir' => $this->request->getPost('pendidikan_terakhir')
        ];

        if ($this->biodataModel->save($data)) {
            return redirect()->to('/admin/biodata')->with('success', 'Data biodata berhasil diupdate.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengupdate data biodata.');
        }
    }

    // PERBAIKAN: Function delete disederhanakan
    public function delete($id)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $this->biodataModel->delete($id);
        return redirect()->to('/admin/biodata')->with('success', 'Data biodata berhasil dihapus.');
    }
}