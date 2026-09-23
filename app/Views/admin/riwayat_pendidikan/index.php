<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Riwayat Pendidikan</h2>
    <a href="<?= base_url('admin/riwayat-pendidikan/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Riwayat
    </a>
</div>

<!-- Form Pencarian dan Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="get" action="<?= base_url('admin/riwayat-pendidikan') ?>" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari nama sekolah/jurusan..."
                    value="<?= esc($search ?? '') ?>">
            </div>
            <div class="col-md-4">
                <select name="filter_jenjang" class="form-control">
                    <option value="">Semua Jenjang</option>
                    <?php foreach ($jenjangList as $jenjang): ?>
                        <option value="<?= $jenjang ?>" <?= ($filter_jenjang ?? '') == $jenjang ? 'selected' : '' ?>><?= $jenjang ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <?php if ($search || $filter_jenjang): ?>
                    <a href="<?= base_url('admin/riwayat-pendidikan') ?>" class="btn btn-secondary">
                        <i class="fas fa-redo"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <input type="hidden" name="sort_column" value="<?= $sort_column ?? 'tahun_lulus' ?>">
            <input type="hidden" name="sort_order" value="<?= $sort_order ?? 'desc' ?>">
        </form>
    </div>
</div>

<!-- Informasi Hasil -->
<?php if ($search || $filter_jenjang): ?>
<div class="alert alert-info mb-3">
    Menampilkan <?= count($riwayat) ?> dari <?= $pager['total_items'] ?? 0 ?> data
    <?php if ($search): ?>
    | Pencarian: <strong><?= esc($search) ?></strong>
    <?php endif; ?>
    <?php if ($filter_jenjang): ?>
    | Jenjang: <strong><?= $filter_jenjang ?></strong>
    <?php endif; ?>
    <?php if ($sort_column): ?>
    | Diurutkan: <strong><?= ucfirst(str_replace('_', ' ', $sort_column)) ?> (<?= $sort_order ?>)</strong>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- Tampilkan pesan flash -->
<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Tabel Data untuk Desktop -->
<div class="card d-none d-md-block">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>
                            <a href="<?= base_url('admin/riwayat-pendidikan?' . http_build_query([
                                'search' => $search,
                                'filter_jenjang' => $filter_jenjang,
                                'sort_column' => 'jenjang',
                                'sort_order' => ($sort_column == 'jenjang' && $sort_order == 'asc') ? 'desc' : 'asc',
                                'page' => 1
                            ])) ?>">
                                Jenjang
                                <?php if ($sort_column == 'jenjang'): ?>
                                <i class="fas fa-sort-<?= $sort_order == 'asc' ? 'up' : 'down' ?>"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th>
                            <a href="<?= base_url('admin/riwayat-pendidikan?' . http_build_query([
                                'search' => $search,
                                'filter_jenjang' => $filter_jenjang,
                                'sort_column' => 'nama_sekolah',
                                'sort_order' => ($sort_column == 'nama_sekolah' && $sort_order == 'asc') ? 'desc' : 'asc',
                                'page' => 1
                            ])) ?>">
                                Nama Sekolah
                                <?php if ($sort_column == 'nama_sekolah'): ?>
                                <i class="fas fa-sort-<?= $sort_order == 'asc' ? 'up' : 'down' ?>"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th>Jurusan</th>
                        <th>
                            <a href="<?= base_url('admin/riwayat-pendidikan?' . http_build_query([
                                'search' => $search,
                                'filter_jenjang' => $filter_jenjang,
                                'sort_column' => 'tahun_masuk',
                                'sort_order' => ($sort_column == 'tahun_masuk' && $sort_order == 'asc') ? 'desc' : 'asc',
                                'page' => 1
                            ])) ?>">
                                Tahun Masuk
                                <?php if ($sort_column == 'tahun_masuk'): ?>
                                <i class="fas fa-sort-<?= $sort_order == 'asc' ? 'up' : 'down' ?>"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th>
                            <a href="<?= base_url('admin/riwayat-pendidikan?' . http_build_query([
                                'search' => $search,
                                'filter_jenjang' => $filter_jenjang,
                                'sort_column' => 'tahun_lulus',
                                'sort_order' => ($sort_column == 'tahun_lulus' && $sort_order == 'asc') ? 'desc' : 'asc',
                                'page' => 1
                            ])) ?>">
                                Tahun Lulus
                                <?php if ($sort_column == 'tahun_lulus'): ?>
                                <i class="fas fa-sort-<?= $sort_order == 'asc' ? 'up' : 'down' ?>"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th>
                            <a href="<?= base_url('admin/riwayat-pendidikan?' . http_build_query([
                                'search' => $search,
                                'filter_jenjang' => $filter_jenjang,
                                'sort_column' => 'nilai_akhir',
                                'sort_order' => ($sort_column == 'nilai_akhir' && $sort_order == 'asc') ? 'desc' : 'asc',
                                'page' => 1
                            ])) ?>">
                                Nilai Akhir
                                <?php if ($sort_column == 'nilai_akhir'): ?>
                                <i class="fas fa-sort-<?= $sort_order == 'asc' ? 'up' : 'down' ?>"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($riwayat)): ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-graduation-cap fa-2x mb-3"></i><br>
                                Data riwayat pendidikan belum tersedia.
                                <div class="mt-3">
                                    <a href="<?= base_url('admin/riwayat-pendidikan/create') ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Tambah Riwayat
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php
                        $startNumber = (($pager['current_page'] ?? 1) - 1) * ($pager['per_page'] ?? 10) + 1;
                        ?>
                    <?php foreach ($riwayat as $index => $r): ?>
                    <tr>
                        <td class="text-center text-muted">
                            <?= $startNumber + $index ?>
                        </td>
                        <td>
                            <span class="badge <?= $r['jenjang'] == 'SD' ? 'bg-info' : ($r['jenjang'] == 'SMP' ? 'bg-primary' : ($r['jenjang'] == 'SMA' ? 'bg-success' : 'bg-warning')) ?> p-2">
                                <?= $r['jenjang'] ?>
                            </span>
                        </td>
                        <td>
                            <strong class="d-block mb-1"><?= esc($r['nama_sekolah']) ?></strong>
                            <?php if ($r['jurusan']): ?>
                            <small class="text-muted"><?= esc($r['jurusan']) ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($r['jurusan']) ?: '-' ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-sign-in-alt text-muted me-2"></i>
                                <span><?= $r['tahun_masuk'] ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-sign-out-alt text-muted me-2"></i>
                                <span><?= $r['tahun_lulus'] ?></span>
                            </div>
                        </td>
                        <td>
                            <?php if ($r['nilai_akhir']): ?>
                                <span class="badge bg-success p-2"><?= $r['nilai_akhir'] ?></span>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= base_url('admin/riwayat-pendidikan/edit/' . $r['id_pendidikan']) ?>"
                                    class="btn btn-primary btn-sm d-flex align-items-center">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <a href="<?= base_url('admin/riwayat-pendidikan/delete/' . $r['id_pendidikan']) ?>"
                                    class="btn btn-danger btn-sm d-flex align-items-center"
                                    onclick="return confirm('Yakin ingin menghapus riwayat pendidikan <?= esc($r['nama_sekolah']) ?>?')">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Card View untuk Mobile -->
<div class="d-block d-md-none">
    <?php if (empty($riwayat)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <div class="text-muted">
                <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                <h5 class="mb-3">Data riwayat pendidikan belum tersedia</h5>
                <a href="<?= base_url('admin/riwayat-pendidikan/create') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Riwayat
                </a>
            </div>
        </div>
    </div>
    <?php else: ?>
    <?php
        $startNumber = (($pager['current_page'] ?? 1) - 1) * ($pager['per_page'] ?? 10) + 1;
        ?>
    <?php foreach ($riwayat as $index => $r): ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="mb-1 fw-bold"><?= esc($r['nama_sekolah']) ?></h6>
                    <small class="text-muted">#<?= $startNumber + $index ?></small>
                </div>
                <span class="badge <?= $r['jenjang'] == 'SD' ? 'bg-info' : ($r['jenjang'] == 'SMP' ? 'bg-primary' : ($r['jenjang'] == 'SMA' ? 'bg-success' : 'bg-warning')) ?>">
                    <?= $r['jenjang'] ?>
                </span>
            </div>

            <div class="mb-3">
                <?php if ($r['jurusan']): ?>
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-book text-muted me-3" style="width: 20px;"></i>
                    <div>
                        <small class="d-block text-muted mb-1">Jurusan</small>
                        <small class="text-truncate d-block"><?= esc($r['jurusan']) ?></small>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="row g-2 mb-3">
                <div class="col-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-sign-in-alt text-muted me-2"></i>
                        <div>
                            <small class="d-block text-muted mb-1">Tahun Masuk</small>
                            <small><?= $r['tahun_masuk'] ?></small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-sign-out-alt text-muted me-2"></i>
                        <div>
                            <small class="d-block text-muted mb-1">Tahun Lulus</small>
                            <small><?= $r['tahun_lulus'] ?></small>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($r['nilai_akhir']): ?>
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-star text-muted me-3" style="width: 20px;"></i>
                    <div>
                        <small class="d-block text-muted mb-1">Nilai Akhir</small>
                        <span class="badge bg-success"><?= $r['nilai_akhir'] ?></span>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="d-flex gap-2">
                <a href="<?= base_url('admin/riwayat-pendidikan/edit/' . $r['id_pendidikan']) ?>"
                    class="btn btn-primary btn-sm flex-fill d-flex align-items-center justify-content-center">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <a href="<?= base_url('admin/riwayat-pendidikan/delete/' . $r['id_pendidikan']) ?>"
                    class="btn btn-danger btn-sm flex-fill d-flex align-items-center justify-content-center"
                    onclick="return confirm('Yakin ingin menghapus riwayat pendidikan <?= esc($r['nama_sekolah']) ?>?')">
                    <i class="fas fa-trash me-2"></i>Hapus
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Pagination -->
<?php if (isset($pager['total_pages']) && $pager['total_pages'] > 1): ?>
<nav aria-label="Page navigation" class="mt-3">
    <ul class="pagination justify-content-center">
        <?php
            $totalPages = $pager['total_pages'];
            $currentPage = $pager['current_page'];
            $queryParams = [
                'search' => $search,
                'filter_jenjang' => $filter_jenjang,
                'sort_column' => $sort_column,
                'sort_order' => $sort_order
            ];
            ?>

        <!-- Previous -->
        <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
            <a class="page-link"
                href="<?= base_url('admin/riwayat-pendidikan?' . http_build_query(array_merge($queryParams, ['page' => $currentPage - 1]))) ?>">
                &laquo;
            </a>
        </li>

        <!-- Pages -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($i == 1 || $i == $totalPages || ($i >= $currentPage - 2 && $i <= $currentPage + 2)): ?>
        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
            <a class="page-link"
                href="<?= base_url('admin/riwayat-pendidikan?' . http_build_query(array_merge($queryParams, ['page' => $i]))) ?>">
                <?= $i ?>
            </a>
        </li>
        <?php elseif ($i == $currentPage - 3 || $i == $currentPage + 3): ?>
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        <?php endif; ?>
        <?php endfor; ?>

        <!-- Next -->
        <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
            <a class="page-link"
                href="<?= base_url('admin/riwayat-pendidikan?' . http_build_query(array_merge($queryParams, ['page' => $currentPage + 1]))) ?>">
                &raquo;
            </a>
        </li>
    </ul>
</nav>
<?php endif; ?>

<style>
/* Warna untuk badge */
.bg-pink {
    background-color: #e83e8c !important;
}

/* Style untuk foto/media */
.object-fit-cover {
    object-fit: cover;
}

/* Style untuk tombol aksi */
.btn-sm {
    padding: 0.35rem 0.75rem;
    font-size: 0.85rem;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
}

.btn-sm:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Style untuk link sorting */
th a {
    color: inherit;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: color 0.2s ease;
}

th a:hover {
    color: #0d6efd;
}

.fa-sort-up,
.fa-sort-down {
    margin-left: 5px;
}

/* Style untuk nomor urut */
td:first-child {
    text-align: center;
    font-weight: 600;
    color: #6c757d;
}

/* Hover effect untuk rows */
.table-hover tbody tr {
    transition: all 0.2s ease;
}

.table-hover tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.05);
    transform: translateX(2px);
}

/* Responsive table */
@media (max-width: 768px) {
    .card {
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .card-body {
        padding: 1.25rem;
    }

    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    /* Style ikon untuk mobile */
    .fa-book,
    .fa-sign-in-alt,
    .fa-sign-out-alt,
    .fa-star {
        color: #6c757d;
        width: 20px;
    }
}

/* Animation untuk mobile cards */
.card.mb-3 {
    animation: fadeInUp 0.3s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Better typography */
.fw-bold {
    font-weight: 600 !important;
}

.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Badge styling */
.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* Icon alignment */
i {
    color: #6c757d;
}

/* Mobile contact layout */
@media (max-width: 768px) {
    .d-flex.align-items-center i {
        min-width: 20px;
    }
}
</style>

<!-- Load FontAwesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Load Bootstrap 5 CSS jika belum ada -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Load Bootstrap 5 JS untuk alert dismiss -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->endSection() ?>