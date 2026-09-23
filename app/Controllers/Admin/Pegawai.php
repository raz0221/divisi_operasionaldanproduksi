<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;

class Pegawai extends BaseController
{
    protected $pegawaiModel;
    protected $perPage = 10; // Jumlah data per halaman

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        // Ambil parameter filter dan sorting
        $search = $this->request->getGet('search');
        $filterJenisKelamin = $this->request->getGet('filter_jenis_kelamin');
        $sortColumn = $this->request->getGet('sort_column') ?? 'nama_pegawai';
        $sortOrder = $this->request->getGet('sort_order') ?? 'asc';
        $page = $this->request->getGet('page') ?? 1;

        // Hitung offset untuk pagination
        $offset = ($page - 1) * $this->perPage;

        // Ambil data dengan filter dan sorting
        $pegawaiData = $this->pegawaiModel->getPegawai($search, $filterJenisKelamin, $this->perPage, $offset, $sortColumn, $sortOrder);
        
        // Hitung total data untuk pagination
        $totalData = $this->pegawaiModel->countPegawai($search, $filterJenisKelamin);
        $totalPages = ceil($totalData / $this->perPage);

        $data = [
            'title' => 'Data Pegawai',
            'pegawai' => $pegawaiData,
            'pager' => [
                'current_page' => (int)$page,
                'total_pages' => $totalPages,
                'total_items' => $totalData,
                'per_page' => $this->perPage
            ],
            'search' => $search,
            'filter_jenis_kelamin' => $filterJenisKelamin,
            'sort_column' => $sortColumn,
            'sort_order' => $sortOrder,
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ]
        ];

        return view('admin/pegawai/index', $data);
    }

    public function create()
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Data Pegawai',
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'validation' => \Config\Services::validation()
        ];

        return view('admin/pegawai/create', $data);
    }

    public function store()
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        // Validasi input
        $rules = [
            'nama_pegawai' => 'required|min_length[3]|max_length[100]',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[laki-laki,perempuan]',
            'foto_pegawai' => [
                'uploaded[foto_pegawai]',
                'mime_in[foto_pegawai,image/jpg,image/jpeg,image/png]',
                'max_size[foto_pegawai,1024]',
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $file = $this->request->getFile('foto_pegawai');
        $fileName = '';

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/pegawai', $fileName);
        }

        $data = [
            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'foto_pegawai' => $fileName
        ];

        if ($this->pegawaiModel->save($data)) {
            return redirect()->to('/admin/pegawai')->with('success', 'Data pegawai berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan data pegawai.');
        }
    }

    public function edit($id)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Edit Data Pegawai',
            'pegawai' => $this->pegawaiModel->find($id),
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'validation' => \Config\Services::validation()
        ];

        return view('admin/pegawai/edit', $data);
    }

    public function update($id)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        // Validasi input
        $rules = [
            'nama_pegawai' => 'required|min_length[3]|max_length[100]',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[laki-laki,perempuan]',
            'foto_pegawai' => [
                'mime_in[foto_pegawai,image/jpg,image/jpeg,image/png]',
                'max_size[foto_pegawai,1024]',
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $pegawai = $this->pegawaiModel->find($id);
        $file = $this->request->getFile('foto_pegawai');
        $fileName = $pegawai['foto_pegawai'];

        // Jika ada file baru yang diupload
        if ($file->isValid() && !$file->hasMoved()) {
            // Hapus file lama jika ada
            if ($fileName && file_exists('uploads/pegawai/' . $fileName)) {
                unlink('uploads/pegawai/' . $fileName);
            }
            $fileName = $file->getRandomName();
            $file->move('uploads/pegawai', $fileName);
        }

        $data = [
            'id_pegawai' => $id,
            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'foto_pegawai' => $fileName
        ];

        if ($this->pegawaiModel->save($data)) {
            return redirect()->to('/admin/pegawai')->with('success', 'Data pegawai berhasil diupdate.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengupdate data pegawai.');
        }
    }

    public function delete($id)
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $pegawai = $this->pegawaiModel->find($id);

        // Hapus file foto jika ada
        if ($pegawai['foto_pegawai'] && file_exists('uploads/pegawai/' . $pegawai['foto_pegawai'])) {
            unlink('uploads/pegawai/' . $pegawai['foto_pegawai']);
        }

        $this->pegawaiModel->delete($id);
        return redirect()->to('/admin/pegawai')->with('success', 'Data pegawai berhasil dihapus.');
    }
}