<?php 
namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\AktivitasHarianModel;
use App\Models\BiodataModel;
use App\Models\RiwayatPendidikanModel;

class Page extends BaseController
{
    protected $pegawaiModel;
    protected $aktivitasModel;
    protected $biodataModel;
    protected $pendidikanModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
        $this->aktivitasModel = new AktivitasHarianModel();
        $this->biodataModel = new BiodataModel();
        $this->pendidikanModel = new RiwayatPendidikanModel();
    }

    public function about()
    {
        echo view("about");
    }

    public function contact()
    {
        $data["name"] = "Annas Fazrul Farras";
        echo view("contact", $data);
    }

    public function faqs()
    {
        // membuat data untuk dikirim ke view
        $data['data_faqs'] = [
            [
                'question' => 'Apa itu Codeigniter?',
                'answer' => 'Codeigniter adalah framework untuk membuat web'
            ],
            [
                'question' => 'Siapa yang membuat Codeiginter?',
                'answer' => 'CI awalnya dibuat oleh Ellislab'
            ],
            [
                'question' => 'Codeigniter versi berapakah yang digunakan pada tutoril ini?',
                'answer' => 'Codeigniter versi 4.0.4'
            ]
        ];

        // load view dengan data
        echo view("faqs", $data);
    }

    public function dataKaryawan()
    {
        // Ambil parameter dari GET
        $search = $this->request->getGet('search');
        $filter_jenis_kelamin = $this->request->getGet('filter_jenis_kelamin');
        $sort_column = $this->request->getGet('sort_column') ?? 'nama_pegawai';
        $sort_order = $this->request->getGet('sort_order') ?? 'asc';
        $page = $this->request->getGet('page') ?? 1;
        $per_page = 10;
        
        // Hitung offset
        $offset = ($page - 1) * $per_page;
        
        // Query dengan pencarian, filter, dan sorting
        $builder = $this->pegawaiModel->builder();
        
        // Apply search
        if (!empty($search)) {
            $builder->groupStart()
                    ->like('nama_pegawai', $search)
                    ->orLike('jenis_kelamin', $search)
                    ->orLike('tanggal_lahir', $search)
                    ->groupEnd();
        }
        
        // Apply filter
        if (!empty($filter_jenis_kelamin)) {
            $builder->where('jenis_kelamin', $filter_jenis_kelamin);
        }
        
        // Apply sorting
        $builder->orderBy($sort_column, strtoupper($sort_order));
        
        // Get paginated results
        $pegawai = $builder->get($per_page, $offset)->getResultArray();
        
        // Count total
        $totalBuilder = $this->pegawaiModel->builder();
        if (!empty($search)) {
            $totalBuilder->groupStart()
                        ->like('nama_pegawai', $search)
                        ->orLike('jenis_kelamin', $search)
                        ->orLike('tanggal_lahir', $search)
                        ->groupEnd();
        }
        if (!empty($filter_jenis_kelamin)) {
            $totalBuilder->where('jenis_kelamin', $filter_jenis_kelamin);
        }
        $total_pegawai = $totalBuilder->countAllResults();
        
        // Hitung total halaman
        $total_pages = ceil($total_pegawai / $per_page);
        
        $data = [
            'title' => 'Data Karyawan',
            'pegawai' => $pegawai,
            'total_pegawai' => $total_pegawai,
            'search' => $search,
            'filter_jenis_kelamin' => $filter_jenis_kelamin,
            'sort_column' => $sort_column,
            'sort_order' => $sort_order,
            'pager' => [
                'current_page' => (int)$page,
                'per_page' => $per_page,
                'total_items' => $total_pegawai,
                'total_pages' => $total_pages
            ]
        ];

        return view('data_karyawan', $data);
    }

    // Fungsi untuk halaman Aktivitas Harian dengan pencarian, filter, pagination, dan sorting
    public function aktivitas()
    {
        // Ambil parameter dari GET
        $search = $this->request->getGet('search');
        $filter_tanggal = $this->request->getGet('filter_tanggal');
        $sort_column = $this->request->getGet('sort_column') ?? 'tanggal';
        $sort_order = $this->request->getGet('sort_order') ?? 'desc';
        $page = $this->request->getGet('page') ?? 1;
        $per_page = 10; // 10 data per halaman
        
        // Hitung offset
        $offset = ($page - 1) * $per_page;
        
        // Ambil data dengan pencarian dan filter
        $aktivitas = $this->aktivitasModel->getAktivitas(
            $search, 
            $filter_tanggal, 
            $per_page, 
            $offset, 
            $sort_column, 
            $sort_order
        );
        
        // Hitung total data
        $total_aktivitas = $this->aktivitasModel->countAktivitas($search, $filter_tanggal);
        
        // Hitung total halaman
        $total_pages = ceil($total_aktivitas / $per_page);
        
        $data = [
            'title' => 'Aktivitas Harian',
            'aktivitas' => $aktivitas,
            'total_aktivitas' => $total_aktivitas,
            'search' => $search,
            'filter_tanggal' => $filter_tanggal,
            'sort_column' => $sort_column,
            'sort_order' => $sort_order,
            'pager' => [
                'current_page' => (int)$page,
                'per_page' => $per_page,
                'total_items' => $total_aktivitas,
                'total_pages' => $total_pages
            ]
        ];

        return view('data_aktivitas_harian', $data);
    }

    // Fungsi untuk halaman Biodata dengan pencarian, filter, pagination, dan sorting
    public function biodata()
    {
        // Ambil parameter dari GET
        $search = $this->request->getGet('search');
        $filter_jenis_kelamin = $this->request->getGet('filter_jenis_kelamin');
        $filter_agama = $this->request->getGet('filter_agama');
        $sort_column = $this->request->getGet('sort_column') ?? 'nama';
        $sort_order = $this->request->getGet('sort_order') ?? 'asc';
        $page = $this->request->getGet('page') ?? 1;
        $per_page = 10; // 10 data per halaman
        
        // Hitung offset
        $offset = ($page - 1) * $per_page;
        
        // Daftar agama untuk filter dropdown
        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        
        // Ambil data dengan pencarian dan filter
        $biodata = $this->biodataModel->getBiodata(
            $search, 
            $filter_jenis_kelamin, 
            $filter_agama, 
            null, // filter_status tidak digunakan di view
            $per_page, 
            $offset, 
            $sort_column, 
            $sort_order
        );
        
        // Hitung total data
        $total_biodata = $this->biodataModel->countBiodata(
            $search, 
            $filter_jenis_kelamin, 
            $filter_agama, 
            null // filter_status tidak digunakan di view
        );
        
        // Hitung total halaman
        $total_pages = ceil($total_biodata / $per_page);
        
        $data = [
            'title' => 'Biodata',
            'biodata' => $biodata,
            'total_biodata' => $total_biodata,
            'search' => $search,
            'filter_jenis_kelamin' => $filter_jenis_kelamin,
            'filter_agama' => $filter_agama,
            'agamaList' => $agamaList,
            'sort_column' => $sort_column,
            'sort_order' => $sort_order,
            'pager' => [
                'current_page' => (int)$page,
                'per_page' => $per_page,
                'total_items' => $total_biodata,
                'total_pages' => $total_pages
            ]
        ];

        return view('data_biodata', $data);
    }

    // Fungsi untuk halaman Riwayat Pendidikan dengan pencarian, filter, pagination, dan sorting
    public function riwayatPendidikan()
    {
        // Ambil parameter dari GET
        $search = $this->request->getGet('search');
        $filter_jenjang = $this->request->getGet('filter_jenjang');
        $sort_column = $this->request->getGet('sort_column') ?? 'tahun_masuk';
        $sort_order = $this->request->getGet('sort_order') ?? 'desc';
        $page = $this->request->getGet('page') ?? 1;
        $per_page = 10; // 10 data per halaman
        
        // Hitung offset
        $offset = ($page - 1) * $per_page;
        
        // Daftar jenjang untuk filter dropdown
        $jenjangList = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];
        
        // Ambil data dengan pencarian dan filter
        $pendidikan = $this->pendidikanModel->getPendidikan(
            $search, 
            $filter_jenjang, 
            $per_page, 
            $offset, 
            $sort_column, 
            $sort_order
        );
        
        // Hitung total data
        $total_pendidikan = $this->pendidikanModel->countPendidikan($search, $filter_jenjang);
        
        // Hitung total halaman
        $total_pages = ceil($total_pendidikan / $per_page);
        
        $data = [
            'title' => 'Riwayat Pendidikan',
            'pendidikan' => $pendidikan,
            'total_pendidikan' => $total_pendidikan,
            'search' => $search,
            'filter_jenjang' => $filter_jenjang,
            'jenjangList' => $jenjangList,
            'sort_column' => $sort_column,
            'sort_order' => $sort_order,
            'pager' => [
                'current_page' => (int)$page,
                'per_page' => $per_page,
                'total_items' => $total_pendidikan,
                'total_pages' => $total_pages
            ]
        ];

        return view('data_riwayat_pendidikan', $data);
    }
}