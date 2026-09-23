<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<div class="dashboard-container">
    <!-- Header dengan Tombol dan Pencarian -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="dashboard-title">Data Riwayat Pendidikan</h1>
            <p class="dashboard-subtitle">Lihat informasi riwayat pendidikan (read-only)</p>
        </div>
        
        <!-- Form Pencarian dan Filter -->
        <form method="GET" action="<?= base_url('riwayat-pendidikan') ?>" class="d-flex gap-2">
            <div class="input-group" style="width: 250px;">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" name="search" class="form-control" 
                       placeholder="Cari riwayat..." 
                       value="<?= esc($search ?? '') ?>">
                <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <select name="filter_jenjang" class="form-control" style="width: 150px;">
                <option value="">Semua Jenjang</option>
                <?php foreach (($jenjangList ?? ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3']) as $jenjang): ?>
                    <option value="<?= $jenjang ?>" <?= ($filter_jenjang ?? '') == $jenjang ? 'selected' : '' ?>>
                        <?= $jenjang ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="hidden" name="sort_column" value="<?= $sort_column ?? 'jenjang' ?>">
            <input type="hidden" name="sort_order" value="<?= $sort_order ?? 'asc' ?>">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter"></i> Filter
            </button>
            <a href="<?= base_url('riwayat-pendidikan') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-redo"></i> Reset
            </a>
        </form>
    </div>

    <!-- Card untuk Konten Utama -->
    <div class="dashboard-card">
        <!-- Informasi Hasil Pencarian -->
        <?php if (!empty($search) || !empty($filter_jenjang)): ?>
        <div id="searchInfo" class="alert alert-info mb-3">
            <i class="fas fa-info-circle me-2"></i>
            Menampilkan <?= count($pendidikan) ?> dari <?= $total_pendidikan ?? count($pendidikan) ?> data
            <?php if (!empty($search)): ?>
                | Pencarian: "<?= esc($search) ?>"
            <?php endif; ?>
            <?php if (!empty($filter_jenjang)): ?>
                | Filter: <?= esc($filter_jenjang) ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <?php if (empty($pendidikan)): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Tidak ada data riwayat pendidikan yang tersedia.
            </div>
        <?php else: ?>
            <!-- Tabel Data Riwayat Pendidikan -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>
                                <a href="<?= base_url('riwayat-pendidikan?' . http_build_query([
                                    'search' => $search ?? '',
                                    'filter_jenjang' => $filter_jenjang ?? '',
                                    'sort_column' => 'jenjang',
                                    'sort_order' => ($sort_column ?? '') == 'jenjang' && ($sort_order ?? 'asc') == 'asc' ? 'desc' : 'asc',
                                    'page' => $pager['current_page'] ?? 1
                                ])) ?>">
                                    Jenjang
                                    <?php if (($sort_column ?? '') == 'jenjang'): ?>
                                        <i class="fas fa-sort-<?= ($sort_order ?? 'asc') == 'asc' ? 'up' : 'down' ?> ms-1"></i>
                                    <?php else: ?>
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?= base_url('riwayat-pendidikan?' . http_build_query([
                                    'search' => $search ?? '',
                                    'filter_jenjang' => $filter_jenjang ?? '',
                                    'sort_column' => 'nama_sekolah',
                                    'sort_order' => ($sort_column ?? '') == 'nama_sekolah' && ($sort_order ?? 'asc') == 'asc' ? 'desc' : 'asc',
                                    'page' => $pager['current_page'] ?? 1
                                ])) ?>">
                                    Nama Sekolah
                                    <?php if (($sort_column ?? '') == 'nama_sekolah'): ?>
                                        <i class="fas fa-sort-<?= ($sort_order ?? 'asc') == 'asc' ? 'up' : 'down' ?> ms-1"></i>
                                    <?php else: ?>
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?= base_url('riwayat-pendidikan?' . http_build_query([
                                    'search' => $search ?? '',
                                    'filter_jenjang' => $filter_jenjang ?? '',
                                    'sort_column' => 'jurusan',
                                    'sort_order' => ($sort_column ?? '') == 'jurusan' && ($sort_order ?? 'asc') == 'asc' ? 'desc' : 'asc',
                                    'page' => $pager['current_page'] ?? 1
                                ])) ?>">
                                    Jurusan
                                    <?php if (($sort_column ?? '') == 'jurusan'): ?>
                                        <i class="fas fa-sort-<?= ($sort_order ?? 'asc') == 'asc' ? 'up' : 'down' ?> ms-1"></i>
                                    <?php else: ?>
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?= base_url('riwayat-pendidikan?' . http_build_query([
                                    'search' => $search ?? '',
                                    'filter_jenjang' => $filter_jenjang ?? '',
                                    'sort_column' => 'tahun_masuk',
                                    'sort_order' => ($sort_column ?? '') == 'tahun_masuk' && ($sort_order ?? 'asc') == 'asc' ? 'desc' : 'asc',
                                    'page' => $pager['current_page'] ?? 1
                                ])) ?>">
                                    Tahun
                                    <?php if (($sort_column ?? '') == 'tahun_masuk'): ?>
                                        <i class="fas fa-sort-<?= ($sort_order ?? 'asc') == 'asc' ? 'up' : 'down' ?> ms-1"></i>
                                    <?php else: ?>
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?= base_url('riwayat-pendidikan?' . http_build_query([
                                    'search' => $search ?? '',
                                    'filter_jenjang' => $filter_jenjang ?? '',
                                    'sort_column' => 'nilai_akhir',
                                    'sort_order' => ($sort_column ?? '') == 'nilai_akhir' && ($sort_order ?? 'asc') == 'asc' ? 'desc' : 'asc',
                                    'page' => $pager['current_page'] ?? 1
                                ])) ?>">
                                    Nilai/IPK
                                    <?php if (($sort_column ?? '') == 'nilai_akhir'): ?>
                                        <i class="fas fa-sort-<?= ($sort_order ?? 'asc') == 'asc' ? 'up' : 'down' ?> ms-1"></i>
                                    <?php else: ?>
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    <?php endif; ?>
                                </a>
                            </th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php $no = (($pager['current_page'] ?? 1) - 1) * ($pager['per_page'] ?? 10) + 1; ?>
                        <?php foreach ($pendidikan as $p): ?>
                        <tr class="data-row">
                            <td><?= $no++ ?></td>
                            <td>
                                <span class="badge jenjang-badge" data-jenjang="<?= $p['jenjang'] ?>">
                                    <i class="fas fa-graduation-cap me-1"></i>
                                    <?= esc($p['jenjang']) ?>
                                </span>
                            </td>
                            <td>
                                <i class="fas fa-school me-1 text-primary"></i>
                                <?= esc($p['nama_sekolah']) ?>
                            </td>
                            <td>
                                <?php if ($p['jurusan']): ?>
                                    <i class="fas fa-book me-1 text-info"></i>
                                    <?= esc($p['jurusan']) ?>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="badge bg-secondary mb-1">
                                        <i class="fas fa-sign-in-alt me-1"></i><?= esc($p['tahun_masuk']) ?>
                                    </span>
                                    <span class="badge bg-success">
                                        <i class="fas fa-sign-out-alt me-1"></i><?= esc($p['tahun_lulus']) ?>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <?php if ($p['nilai_akhir']): ?>
                                    <span class="badge nilai-badge">
                                        <i class="fas fa-star me-1 text-warning"></i>
                                        <?= esc($p['nilai_akhir']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 200px;" title="<?= esc($p['keterangan']) ?>">
                                    <?= esc($p['keterangan']) ?: '-' ?>
                                </div>
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
                           href="<?= base_url('riwayatPendidikan?' . http_build_query([
                               'search' => $search ?? '',
                               'filter_jenjang' => $filter_jenjang ?? '',
                               'sort_column' => $sort_column ?? 'jenjang',
                               'sort_order' => $sort_order ?? 'asc',
                               'page' => (($pager['current_page'] ?? 1) - 1)
                           ])) ?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                    
                    <?php for ($i = 1; $i <= ($pager['total_pages'] ?? 1); $i++): ?>
                        <li class="page-item <?= $i == ($pager['current_page'] ?? 1) ? 'active' : '' ?>">
                            <a class="page-link" 
                               href="<?= base_url('riwayatPendidikan?' . http_build_query([
                                   'search' => $search ?? '',
                                   'filter_jenjang' => $filter_jenjang ?? '',
                                   'sort_column' => $sort_column ?? 'jenjang',
                                   'sort_order' => $sort_order ?? 'asc',
                                   'page' => $i
                               ])) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    
                    <li class="page-item <?= ($pager['current_page'] ?? 1) == ($pager['total_pages'] ?? 1) ? 'disabled' : '' ?>">
                        <a class="page-link" 
                           href="<?= base_url('riwayatPendidikan?' . http_build_query([
                               'search' => $search ?? '',
                               'filter_jenjang' => $filter_jenjang ?? '',
                               'sort_column' => $sort_column ?? 'jenjang',
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
    max-width: 1400px;
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

/* Badge style khusus pendidikan */
.jenjang-badge {
    padding: 6px 12px;
    font-size: 0.85rem;
    font-weight: 500;
}

.jenjang-badge[data-jenjang="SD"] {
    background-color: rgba(108, 117, 125, 0.1) !important;
    color: #6c757d !important;
    border: 1px solid rgba(108, 117, 125, 0.2);
}

.jenjang-badge[data-jenjang="SMP"] {
    background-color: rgba(13, 202, 240, 0.1) !important;
    color: #0dcaf0 !important;
    border: 1px solid rgba(13, 202, 240, 0.2);
}

.jenjang-badge[data-jenjang="SMA"] {
    background-color: rgba(25, 135, 84, 0.1) !important;
    color: #198754 !important;
    border: 1px solid rgba(25, 135, 84, 0.2);
}

.jenjang-badge[data-jenjang="D3"] {
    background-color: rgba(255, 193, 7, 0.1) !important;
    color: #ffc107 !important;
    border: 1px solid rgba(255, 193, 7, 0.2);
}

.jenjang-badge[data-jenjang="S1"] {
    background-color: rgba(13, 110, 253, 0.1) !important;
    color: #0d6efd !important;
    border: 1px solid rgba(13, 110, 253, 0.2);
}

.jenjang-badge[data-jenjang="S2"] {
    background-color: rgba(102, 16, 242, 0.1) !important;
    color: #6610f2 !important;
    border: 1px solid rgba(102, 16, 242, 0.2);
}

.jenjang-badge[data-jenjang="S3"] {
    background-color: rgba(214, 51, 132, 0.1) !important;
    color: #d63384 !important;
    border: 1px solid rgba(214, 51, 132, 0.2);
}

.nilai-badge {
    background-color: rgba(255, 193, 7, 0.1) !important;
    color: #ffc107 !important;
    border: 1px solid rgba(255, 193, 7, 0.2);
    padding: 6px 12px;
    font-size: 0.85rem;
    font-weight: 500;
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

/* Responsive */
@media (max-width: 1200px) {
    .dashboard-container {
        padding: 15px;
    }
    
    .dashboard-card {
        padding: 20px;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .d-flex.gap-2 {
        margin-top: 10px;
        flex-wrap: wrap;
    }
    
    .input-group,
    .form-control {
        width: 100% !important;
        margin-bottom: 8px;
    }
}

@media (max-width: 768px) {
    .table-responsive {
        font-size: 14px;
    }
    
    .table td, .table th {
        padding: 8px;
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 4px 8px;
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
        window.location.href = '<?= base_url('riwayatPendidikan') ?>';
    });
});
</script>

<?= $this->endSection() ?>