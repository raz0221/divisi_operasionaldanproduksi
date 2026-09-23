<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<div class="dashboard-container">
    <!-- Header dengan Tombol dan Pencarian -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="dashboard-title">Data Pegawai</h1>
            <p class="dashboard-subtitle">Lihat informasi data pegawai (read-only)</p>
        </div>
        
        <!-- Form Pencarian dan Filter -->
        <form method="GET" action="<?= base_url('dataKaryawan') ?>" class="d-flex gap-2">
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" name="search" class="form-control" 
                       placeholder="Cari semua kolom..." 
                       value="<?= esc($search ?? '') ?>">
                <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <select name="filter_jenis_kelamin" class="form-control" style="width: 150px;">
                <option value="">Semua Jenis Kelamin</option>
                <option value="laki-laki" <?= ($filter_jenis_kelamin ?? '') == 'laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="perempuan" <?= ($filter_jenis_kelamin ?? '') == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>

            <input type="hidden" name="sort_column" value="<?= $sort_column ?? 'nama_pegawai' ?>">
            <input type="hidden" name="sort_order" value="<?= $sort_order ?? 'asc' ?>">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter"></i> Filter
            </button>
            <a href="<?= base_url('dataKaryawan') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-redo"></i> Reset
            </a>
        </form>
    </div>

    <!-- Card untuk Konten Utama -->
    <div class="dashboard-card">
        <!-- Informasi Hasil Pencarian -->
        <?php if (!empty($search) || !empty($filter_jenis_kelamin)): ?>
        <div id="searchInfo" class="alert alert-info mb-3">
            <i class="fas fa-info-circle me-2"></i>
            Menampilkan <?= count($pegawai) ?> dari <?= $total_pegawai ?? count($pegawai) ?> data
            <?php if (!empty($search)): ?>
                | Pencarian: "<?= esc($search) ?>" 
            <?php endif; ?>
            <?php if (!empty($filter_jenis_kelamin)): ?>
                | Filter: <?= $filter_jenis_kelamin == 'laki-laki' ? 'Laki-laki' : 'Perempuan' ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <?php if (empty($pegawai)): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Tidak ada data pegawai yang tersedia.
            </div>
        <?php else: ?>
            <!-- Tabel Data Pegawai -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Foto</th>
                            <th>
                                <a href="<?= base_url('dataKaryawan?' . http_build_query([
                                    'search' => $search ?? '',
                                    'filter_jenis_kelamin' => $filter_jenis_kelamin ?? '',
                                    'sort_column' => 'nama_pegawai',
                                    'sort_order' => ($sort_column ?? '') == 'nama_pegawai' && ($sort_order ?? 'asc') == 'asc' ? 'desc' : 'asc',
                                    'page' => $pager['current_page'] ?? 1
                                ])) ?>">
                                    Nama Pegawai
                                    <?php if (($sort_column ?? '') == 'nama_pegawai'): ?>
                                        <i class="fas fa-sort-<?= ($sort_order ?? 'asc') == 'asc' ? 'up' : 'down' ?> ms-1"></i>
                                    <?php else: ?>
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?= base_url('dataKaryawan?' . http_build_query([
                                    'search' => $search ?? '',
                                    'filter_jenis_kelamin' => $filter_jenis_kelamin ?? '',
                                    'sort_column' => 'tanggal_lahir',
                                    'sort_order' => ($sort_column ?? '') == 'tanggal_lahir' && ($sort_order ?? 'asc') == 'asc' ? 'desc' : 'asc',
                                    'page' => $pager['current_page'] ?? 1
                                ])) ?>">
                                    Tanggal Lahir
                                    <?php if (($sort_column ?? '') == 'tanggal_lahir'): ?>
                                        <i class="fas fa-sort-<?= ($sort_order ?? 'asc') == 'asc' ? 'up' : 'down' ?> ms-1"></i>
                                    <?php else: ?>
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>Jenis Kelamin</th>
                            <th>Usia</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php $no = (($pager['current_page'] ?? 1) - 1) * ($pager['per_page'] ?? 10) + 1; ?>
                        <?php foreach ($pegawai as $p): ?>
                        <tr class="data-row">
                            <td><?= $no++ ?></td>
                            <td>
                                <div class="avatar-container">
                                    <?php if ($p['foto_pegawai']): ?>
                                        <img src="/uploads/pegawai/<?= $p['foto_pegawai'] ?>" 
                                             alt="Foto <?= $p['nama_pegawai'] ?>" 
                                             class="avatar rounded-circle">
                                    <?php else: ?>
                                        <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user text-light"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td><?= esc($p['nama_pegawai']) ?></td>
                            <td>
                                <i class="fas fa-calendar me-1 text-primary"></i>
                                <?= date('d/m/Y', strtotime($p['tanggal_lahir'])) ?>
                            </td>
                            <td>
                                <span class="badge gender-badge" data-gender="<?= $p['jenis_kelamin'] ?>">
                                    <i class="fas fa-<?= $p['jenis_kelamin'] == 'laki-laki' ? 'male' : 'female' ?> me-1"></i>
                                    <?= ucfirst($p['jenis_kelamin']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    <?php
                                        $birthDate = new DateTime($p['tanggal_lahir']);
                                        $today = new DateTime();
                                        $age = $today->diff($birthDate)->y;
                                        echo $age . ' tahun';
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if (($pager['total_pages'] ?? 1) > 1): ?>
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= ($pager['current_page'] ?? 1) == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" 
                           href="<?= base_url('dataKaryawan?' . http_build_query([
                               'search' => $search ?? '',
                               'filter_jenis_kelamin' => $filter_jenis_kelamin ?? '',
                               'sort_column' => $sort_column ?? 'nama_pegawai',
                               'sort_order' => $sort_order ?? 'asc',
                               'page' => (($pager['current_page'] ?? 1) - 1)
                           ])) ?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                    
                    <?php for ($i = 1; $i <= ($pager['total_pages'] ?? 1); $i++): ?>
                        <li class="page-item <?= $i == ($pager['current_page'] ?? 1) ? 'active' : '' ?>">
                            <a class="page-link" 
                               href="<?= base_url('dataKaryawan?' . http_build_query([
                                   'search' => $search ?? '',
                                   'filter_jenis_kelamin' => $filter_jenis_kelamin ?? '',
                                   'sort_column' => $sort_column ?? 'nama_pegawai',
                                   'sort_order' => $sort_order ?? 'asc',
                                   'page' => $i
                               ])) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    
                    <li class="page-item <?= ($pager['current_page'] ?? 1) == ($pager['total_pages'] ?? 1) ? 'disabled' : '' ?>">
                        <a class="page-link" 
                           href="<?= base_url('dataKaryawan?' . http_build_query([
                               'search' => $search ?? '',
                               'filter_jenis_kelamin' => $filter_jenis_kelamin ?? '',
                               'sort_column' => $sort_column ?? 'nama_pegawai',
                               'sort_order' => $sort_order ?? 'asc',
                               'page' => (($pager['current_page'] ?? 1) + 1)
                           ])) ?>">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="text-center text-muted mt-2">
                <i class="fas fa-layer-group me-1"></i>
                Halaman <?= $pager['current_page'] ?? 1 ?> dari <?= $pager['total_pages'] ?? 1 ?>
                | Total <?= $pager['total_items'] ?? 0 ?> data
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<style>
:root {
    --primary-blue: #2c3e50;
    --secondary-blue: #3498db;
    --accent-blue: #1a5276;
    --light-blue: #e8f4fc;
    --dark-gray: #2c3e50;
    --medium-gray: #7f8c8d;
    --light-gray: #f8f9fa;
    --white: #ffffff;
    
    --bg-primary: #ffffff;
    --bg-secondary: #f8f9fa;
    --text-primary: #2c3e50;
    --text-secondary: #7f8c8d;
    --card-bg: #ffffff;
    --border-color: #e9ecef;
    --shadow-color: rgba(0, 0, 0, 0.08);
}

[data-theme="dark"] {
    --primary-blue: #4a90e2;
    --secondary-blue: #63b3ed;
    --accent-blue: #2c5282;
    --light-blue: #1a202c;
    --dark-gray: #e2e8f0;
    --medium-gray: #a0aec0;
    --light-gray: #2d3748;
    --white: #1a202c;
    
    --bg-primary: #1a202c;
    --bg-secondary: #2d3748;
    --text-primary: #e2e8f0;
    --text-secondary: #a0aec0;
    --card-bg: #2d3748;
    --border-color: #4a5568;
    --shadow-color: rgba(0, 0, 0, 0.3);
}

body {
    font-family: 'Open Sans', sans-serif;
    background: linear-gradient(135deg, var(--light-blue) 0%, var(--bg-secondary) 100%);
    min-height: 100vh;
    padding: 20px;
    margin: 0;
    transition: background 0.3s ease;
    color: var(--text-primary);
}

.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
}

.dashboard-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 24px;
    color: var(--text-primary);
    margin: 0;
}

.dashboard-subtitle {
    color: var(--text-secondary);
    font-size: 14px;
    margin: 5px 0 0 0;
}

.dashboard-card {
    background: var(--card-bg);
    border: 1.5px solid var(--border-color);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 10px 30px var(--shadow-color);
    transition: all 0.3s ease;
}

/* Tombol style seperti login.php */
.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
    border: none;
    border-radius: 6px;
    padding: 10px 20px;
    font-weight: 600;
    font-size: 14px;
    color: white;
    transition: all 0.2s ease;
    height: 44px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
}

.btn-outline-secondary {
    background: transparent;
    border: 1.5px solid var(--primary-blue);
    color: var(--primary-blue);
    border-radius: 6px;
    padding: 10px 20px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s ease;
    height: 44px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-outline-secondary:hover {
    background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
    color: white;
    border-color: transparent;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
}

/* Form style */
.form-control {
    border: 1.5px solid var(--border-color);
    border-radius: 6px;
    padding: 10px 12px;
    font-size: 13px;
    transition: all 0.2s ease;
    height: 42px;
    background: var(--card-bg);
    color: var(--text-primary);
}

.form-control:focus {
    border-color: var(--secondary-blue);
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.1);
}

.input-group-text {
    background: var(--bg-secondary);
    border: 1.5px solid var(--border-color);
    color: var(--text-secondary);
}

/* Table style */
.table {
    color: var(--text-primary);
    border-color: var(--border-color);
}

.table thead th {
    border-bottom: 2px solid var(--border-color);
    background: var(--bg-secondary);
    font-weight: 600;
    padding: 15px 12px;
    color: var(--text-primary);
}

.table tbody tr {
    border-bottom: 1px solid var(--border-color);
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: var(--bg-secondary);
}

.table td {
    padding: 12px;
    vertical-align: middle;
}

/* Badge style */
.badge {
    padding: 6px 12px;
    font-size: 0.85rem;
    font-weight: 500;
}

.gender-badge[data-gender="laki-laki"] {
    background-color: rgba(13, 110, 253, 0.1) !important;
    color: #0d6efd !important;
    border: 1px solid rgba(13, 110, 253, 0.2);
}

.gender-badge[data-gender="perempuan"] {
    background-color: rgba(25, 135, 84, 0.1) !important;
    color: #198754 !important;
    border: 1px solid rgba(25, 135, 84, 0.2);
}

/* Alert style */
.alert {
    border-radius: 6px;
    border: none;
    font-size: 13px;
    padding: 10px 12px;
    margin-bottom: 15px;
    background: var(--bg-secondary);
    border-left: 3px solid var(--secondary-blue);
    color: var(--text-primary);
}

.alert-info {
    background: rgba(52, 152, 219, 0.1);
    border-left: 3px solid var(--secondary-blue);
}

/* Pagination style */
.page-link {
    background-color: var(--card-bg);
    border-color: var(--border-color);
    color: var(--text-primary);
    padding: 8px 16px;
}

.page-item.active .page-link {
    background-color: var(--primary-blue);
    border-color: var(--primary-blue);
    color: white;
}

.page-link:hover {
    background-color: var(--bg-secondary);
    border-color: var(--border-color);
    color: var(--text-primary);
}

/* Avatar style */
.avatar-container {
    width: 60px;
    height: 60px;
}

.avatar {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 15px;
    }
    
    .dashboard-card {
        padding: 20px;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .d-flex.gap-2 {
        flex-wrap: wrap;
        width: 100%;
    }
    
    .input-group,
    .form-control {
        width: 100% !important;
        margin-bottom: 8px;
    }
}

/* Theme transition */
* {
    transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
}
</style>

<script>
$(document).ready(function() {
    // Tombol clear search
    $('#clearSearch').on('click', function() {
        window.location.href = '<?= base_url('dataKaryawan') ?>';
    });
});
</script>

<?= $this->endSection() ?>