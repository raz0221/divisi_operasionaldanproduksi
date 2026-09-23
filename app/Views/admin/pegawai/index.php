<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Data Pegawai</h2>
    <a href="<?= base_url('admin/pegawai/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Pegawai
    </a>
</div>

<!-- Form Pencarian dan Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="get" action="<?= base_url('admin/pegawai') ?>" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari nama pegawai..."
                    value="<?= esc($search ?? '') ?>">
            </div>
            <div class="col-md-4">
                <select name="filter_jenis_kelamin" class="form-control">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="laki-laki" <?= ($filter_jenis_kelamin ?? '') == 'laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="perempuan" <?= ($filter_jenis_kelamin ?? '') == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="col-md-4">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <?php if ($search || $filter_jenis_kelamin): ?>
                    <a href="<?= base_url('admin/pegawai') ?>" class="btn btn-secondary">
                        <i class="fas fa-redo"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <input type="hidden" name="sort_column" value="<?= $sort_column ?? 'nama_pegawai' ?>">
            <input type="hidden" name="sort_order" value="<?= $sort_order ?? 'asc' ?>">
        </form>
    </div>
</div>

<!-- Informasi Hasil -->
<?php if ($search || $filter_jenis_kelamin): ?>
<div class="alert alert-info mb-3">
    Menampilkan <?= count($pegawai) ?> dari <?= $pager['total_items'] ?? 0 ?> data
    <?php if ($search): ?>
    | Pencarian: <strong><?= esc($search) ?></strong>
    <?php endif; ?>
    <?php if ($filter_jenis_kelamin): ?>
    | Jenis Kelamin: <strong><?= ucfirst($filter_jenis_kelamin) ?></strong>
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
                            <a href="<?= base_url('admin/pegawai?' . http_build_query([
                                'search' => $search,
                                'filter_jenis_kelamin' => $filter_jenis_kelamin,
                                'sort_column' => 'nama_pegawai',
                                'sort_order' => ($sort_column == 'nama_pegawai' && $sort_order == 'asc') ? 'desc' : 'asc',
                                'page' => 1
                            ])) ?>">
                                Nama Pegawai
                                <?php if ($sort_column == 'nama_pegawai'): ?>
                                <i class="fas fa-sort-<?= $sort_order == 'asc' ? 'up' : 'down' ?>"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th>
                            <a href="<?= base_url('admin/pegawai?' . http_build_query([
                                'search' => $search,
                                'filter_jenis_kelamin' => $filter_jenis_kelamin,
                                'sort_column' => 'tanggal_lahir',
                                'sort_order' => ($sort_column == 'tanggal_lahir' && $sort_order == 'asc') ? 'desc' : 'asc',
                                'page' => 1
                            ])) ?>">
                                Tanggal Lahir
                                <?php if ($sort_column == 'tanggal_lahir'): ?>
                                <i class="fas fa-sort-<?= $sort_order == 'asc' ? 'up' : 'down' ?>"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th>
                            <a href="<?= base_url('admin/pegawai?' . http_build_query([
                                'search' => $search,
                                'filter_jenis_kelamin' => $filter_jenis_kelamin,
                                'sort_column' => 'jenis_kelamin',
                                'sort_order' => ($sort_column == 'jenis_kelamin' && $sort_order == 'asc') ? 'desc' : 'asc',
                                'page' => 1
                            ])) ?>">
                                Jenis Kelamin
                                <?php if ($sort_column == 'jenis_kelamin'): ?>
                                <i class="fas fa-sort-<?= $sort_order == 'asc' ? 'up' : 'down' ?>"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pegawai)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-users-slash fa-2x mb-3"></i><br>
                                Data pegawai belum tersedia.
                                <div class="mt-3">
                                    <a href="<?= base_url('admin/pegawai/create') ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Tambah Pegawai
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php
                        $startNumber = (($pager['current_page'] ?? 1) - 1) * ($pager['per_page'] ?? 10) + 1;
                        ?>
                    <?php foreach ($pegawai as $index => $p): ?>
                    <tr>
                        <td class="text-center text-muted">
                            <?= $startNumber + $index ?>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <?php if ($p['foto_pegawai']): ?>
                                <img src="/uploads/pegawai/<?= $p['foto_pegawai'] ?>" 
                                     alt="Foto Pegawai" 
                                     width="48" 
                                     height="48" 
                                     class="rounded-circle me-3 object-fit-cover">
                                <?php else: ?>
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3"
                                    style="width: 48px; height: 48px;">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <?php endif; ?>
                                <div>
                                    <strong class="d-block mb-1"><?= esc($p['nama_pegawai']) ?></strong>
                                    <small class="text-muted">ID: <?= $p['id_pegawai'] ?></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt text-muted me-2"></i>
                                <span><?= date('d/m/Y', strtotime($p['tanggal_lahir'])) ?></span>
                            </div>
                        </td>
                        <td>
                            <span class="badge <?= $p['jenis_kelamin'] == 'laki-laki' ? 'bg-primary' : 'bg-pink' ?> p-2">
                                <i class="fas fa-<?= $p['jenis_kelamin'] == 'laki-laki' ? 'male' : 'female' ?> me-1"></i>
                                <?= ucfirst($p['jenis_kelamin']) ?>
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= base_url('admin/pegawai/edit/' . $p['id_pegawai']) ?>"
                                    class="btn btn-primary btn-sm d-flex align-items-center">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <a href="<?= base_url('admin/pegawai/delete/' . $p['id_pegawai']) ?>"
                                    class="btn btn-danger btn-sm d-flex align-items-center"
                                    onclick="return confirm('Yakin ingin menghapus pegawai <?= esc($p['nama_pegawai']) ?>?')">
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
    <?php if (empty($pegawai)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <div class="text-muted">
                <i class="fas fa-users-slash fa-3x mb-3"></i>
                <h5 class="mb-3">Data pegawai belum tersedia</h5>
                <a href="<?= base_url('admin/pegawai/create') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Pegawai
                </a>
            </div>
        </div>
    </div>
    <?php else: ?>
    <?php
        $startNumber = (($pager['current_page'] ?? 1) - 1) * ($pager['per_page'] ?? 10) + 1;
        ?>
    <?php foreach ($pegawai as $index => $p): ?>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="d-flex align-items-center">
                    <?php if ($p['foto_pegawai']): ?>
                    <img src="/uploads/pegawai/<?= $p['foto_pegawai'] ?>" 
                         alt="<?= esc($p['nama_pegawai']) ?>" 
                         width="60" 
                         height="60" 
                         class="rounded-circle me-3 object-fit-cover">
                    <?php else: ?>
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3"
                        style="width: 60px; height: 60px;">
                        <i class="fas fa-user text-white fa-lg"></i>
                    </div>
                    <?php endif; ?>
                    <div>
                        <h6 class="mb-1 fw-bold"><?= esc($p['nama_pegawai']) ?></h6>
                        <small class="text-muted">#<?= $startNumber + $index ?> | ID: <?= $p['id_pegawai'] ?></small>
                    </div>
                </div>
                <span class="badge <?= $p['jenis_kelamin'] == 'laki-laki' ? 'bg-primary' : 'bg-pink' ?>">
                    <i class="fas fa-<?= $p['jenis_kelamin'] == 'laki-laki' ? 'male' : 'female' ?>"></i>
                </span>
            </div>

            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-calendar-alt text-muted me-3" style="width: 20px;"></i>
                    <div>
                        <small class="d-block text-muted mb-1">Tanggal Lahir</small>
                        <small class="text-truncate d-block"><?= date('d/m/Y', strtotime($p['tanggal_lahir'])) ?></small>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= base_url('admin/pegawai/edit/' . $p['id_pegawai']) ?>"
                    class="btn btn-primary btn-sm flex-fill d-flex align-items-center justify-content-center">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <a href="<?= base_url('admin/pegawai/delete/' . $p['id_pegawai']) ?>"
                    class="btn btn-danger btn-sm flex-fill d-flex align-items-center justify-content-center"
                    onclick="return confirm('Yakin ingin menghapus pegawai <?= esc($p['nama_pegawai']) ?>?')">
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
                'filter_jenis_kelamin' => $filter_jenis_kelamin,
                'sort_column' => $sort_column,
                'sort_order' => $sort_order
            ];
            ?>

        <!-- Previous -->
        <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
            <a class="page-link"
                href="<?= base_url('admin/pegawai?' . http_build_query(array_merge($queryParams, ['page' => $currentPage - 1]))) ?>">
                &laquo;
            </a>
        </li>

        <!-- Pages -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($i == 1 || $i == $totalPages || ($i >= $currentPage - 2 && $i <= $currentPage + 2)): ?>
        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
            <a class="page-link"
                href="<?= base_url('admin/pegawai?' . http_build_query(array_merge($queryParams, ['page' => $i]))) ?>">
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
                href="<?= base_url('admin/pegawai?' . http_build_query(array_merge($queryParams, ['page' => $currentPage + 1]))) ?>">
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

/* Style untuk foto profil */
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
    .fa-calendar-alt {
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