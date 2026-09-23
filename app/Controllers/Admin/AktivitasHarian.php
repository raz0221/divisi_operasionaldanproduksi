<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AktivitasHarianModel;

class AktivitasHarian extends BaseController
{
    protected $aktivitasModel;
    protected $perPage = 10;

    public function __construct()
    {
        $this->aktivitasModel = new AktivitasHarianModel();
        
        // PERBAIKAN: Pastikan folder uploads ada saat inisialisasi
        $this->ensureUploadDirectory();
    }
    
    /**
     * Pastikan folder uploads/aktivitas ada dan bisa ditulis
     */
    private function ensureUploadDirectory()
    {
        $uploadPath = FCPATH . 'uploads/aktivitas';
        
        // Buat folder uploads jika belum ada
        if (!is_dir(FCPATH . 'uploads')) {
            mkdir(FCPATH . 'uploads', 0777, true);
        }
        
        // Buat folder aktivitas jika belum ada
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        
        // Buat file .htaccess untuk proteksi
        $htaccessPath = $uploadPath . '/.htaccess';
        if (!file_exists($htaccessPath)) {
            $htaccessContent = "Order deny,allow\nDeny from all";
            file_put_contents($htaccessPath, $htaccessContent);
        }
    }

    public function index()
    {
        // Cek apakah user sudah login dan role admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $search = $this->request->getGet('search');
        $filter_tanggal = $this->request->getGet('filter_tanggal');
        $sort_column = $this->request->getGet('sort_column') ?? 'tanggal';
        $sort_order = $this->request->getGet('sort_order') ?? 'desc';
        $page = $this->request->getGet('page') ?? 1;
        
        $offset = ($page - 1) * $this->perPage;
        
        $aktivitas = $this->aktivitasModel->getAktivitas($search, $filter_tanggal, $this->perPage, $offset, $sort_column, $sort_order);
        $total = $this->aktivitasModel->countAktivitas($search, $filter_tanggal);
        
        $pager = [
            'current_page' => (int)$page,
            'total_pages' => ceil($total / $this->perPage),
            'total_items' => $total,
            'per_page' => $this->perPage
        ];

        $data = [
            'title' => 'Data Aktivitas Harian',
            'aktivitas' => $aktivitas,
            'pager' => $pager,
            'search' => $search,
            'filter_tanggal' => $filter_tanggal,
            'sort_column' => $sort_column,
            'sort_order' => $sort_order,
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ]
        ];

        return view('admin/aktivitas_harian/index', $data);
    }

    public function create()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Aktivitas Harian',
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'validation' => \Config\Services::validation()
        ];

        return view('admin/aktivitas_harian/create', $data);
    }

    public function store()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        // Validasi input - PERBAIKAN: Validasi dulu tanpa file, lalu handle file terpisah
        $rules = [
            'tanggal' => 'required|valid_date',
            'jam' => 'required',
            'nama_aktivitas' => 'required|min_length[3]|max_length[200]',
        ];

        // Validasi tanpa file dulu
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload dengan pengecekan manual
        $file = $this->request->getFile('media_file');
        $fileName = '';
        $jenisMedia = '';

        // PERBAIKAN: Validasi file secara manual
        if (!$file || !$file->isValid()) {
            return redirect()->back()->withInput()->with('error', 'File tidak valid atau tidak diupload.');
        }

        // Cek ukuran file
        if ($file->getSize() > 5120000) { // 5MB in bytes
            return redirect()->back()->withInput()->with('error', 'Ukuran file melebihi 5MB.');
        }

        // Cek tipe file
        $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'video/mp4', 'video/avi', 'video/mkv'];
        $mimeType = $file->getMimeType();
        
        if (!in_array($mimeType, $allowedTypes)) {
            return redirect()->back()->withInput()->with('error', 'Format file tidak didukung. Gunakan JPG, JPEG, PNG, MP4, AVI, atau MKV.');
        }

        // Pastikan folder ada
        $uploadPath = FCPATH . 'uploads/aktivitas';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Generate random name
        $fileName = $file->getRandomName();
        
        // Pindahkan file dengan error handling
        if (!$file->move($uploadPath, $fileName)) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan file. Coba lagi atau gunakan file yang berbeda.');
        }
        
        // Tentukan jenis media
        if (strpos($mimeType, 'image/') === 0) {
            $jenisMedia = 'foto';
        } elseif (strpos($mimeType, 'video/') === 0) {
            $jenisMedia = 'video';
        }

        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
            'nama_aktivitas' => $this->request->getPost('nama_aktivitas'),
            'media_file' => $fileName,
            'jenis_media' => $jenisMedia
        ];

        if ($this->aktivitasModel->save($data)) {
            return redirect()->to('/admin/aktivitas-harian')->with('success', 'Aktivitas harian berhasil ditambahkan.');
        } else {
            // Hapus file yang sudah diupload jika gagal simpan ke database
            if ($fileName && file_exists($uploadPath . '/' . $fileName)) {
                @unlink($uploadPath . '/' . $fileName);
            }
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan aktivitas.');
        }
    }

    public function edit($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Edit Aktivitas Harian',
            'aktivitas' => $this->aktivitasModel->find($id),
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ],
            'validation' => \Config\Services::validation()
        ];

        return view('admin/aktivitas_harian/edit', $data);
    }

    public function update($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/login');
        }

        // Validasi input tanpa file wajib
        $rules = [
            'tanggal' => 'required|valid_date',
            'jam' => 'required',
            'nama_aktivitas' => 'required|min_length[3]|max_length[200]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $aktivitas = $this->aktivitasModel->find($id);
        $file = $this->request->getFile('media_file');
        $fileName = $aktivitas['media_file'];
        $jenisMedia = $aktivitas['jenis_media'];

        // Jika ada file baru yang diupload
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validasi file baru
            if ($file->getSize() > 5120000) {
                return redirect()->back()->withInput()->with('error', 'Ukuran file melebihi 5MB.');
            }

            $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'video/mp4', 'video/avi', 'video/mkv'];
            $mimeType = $file->getMimeType();
            
            if (!in_array($mimeType, $allowedTypes)) {
                return redirect()->back()->withInput()->with('error', 'Format file tidak didukung.');
            }

            $uploadPath = FCPATH . 'uploads/aktivitas';
            
            // Hapus file lama jika ada
            if ($fileName && file_exists($uploadPath . '/' . $fileName)) {
                @unlink($uploadPath . '/' . $fileName);
            }
            
            // Generate new filename
            $fileName = $file->getRandomName();
            
            // Pindahkan file
            if (!$file->move($uploadPath, $fileName)) {
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan file.');
            }
            
            // Tentukan jenis media
            if (strpos($mimeType, 'image/') === 0) {
                $jenisMedia = 'foto';
            } elseif (strpos($mimeType, 'video/') === 0) {
                $jenisMedia = 'video';
            }
        }

        $data = [
            'id_aktivitas' => $id,
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
            'nama_aktivitas' => $this->request->getPost('nama_aktivitas'),
            'media_file' => $fileName,
            'jenis_media' => $jenisMedia
        ];

        if ($this->aktivitasModel->save($data)) {
            return redirect()->to('/admin/aktivitas-harian')->with('success', 'Aktivitas harian berhasil diupdate.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengupdate aktivitas.');
        }
    }

    // PERBAIKAN: Function delete disederhanakan
    public function delete($id)
{
    if (!session()->get('logged_in') || session()->get('role') != 'admin') {
        return redirect()->to('/login');
    }

    $aktivitas = $this->aktivitasModel->find($id);
    $uploadPath = FCPATH . 'uploads/aktivitas';

    // Hapus file jika ada
    if ($aktivitas['media_file'] && file_exists($uploadPath . '/' . $aktivitas['media_file'])) {
        @unlink($uploadPath . '/' . $aktivitas['media_file']);
    }

    $this->aktivitasModel->delete($id);
    return redirect()->to('/admin/aktivitas-harian')->with('success', 'Aktivitas harian berhasil dihapus.');
}
}