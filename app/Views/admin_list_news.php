<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

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

.container {
    max-width: 1200px;
    margin: 0 auto;
}

.dashboard-card {
    background: var(--card-bg);
    border: 1.5px solid var(--border-color);
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 10px 30px var(--shadow-color);
    transition: all 0.3s ease;
}

.table {
    color: var(--text-primary);
    border-color: var(--border-color);
    width: 100%;
    margin-bottom: 0;
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

.btn {
    background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
    border: none;
    border-radius: 6px;
    padding: 8px 15px;
    font-weight: 600;
    font-size: 13px;
    color: white;
    transition: all 0.2s ease;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    text-decoration: none;
    margin-right: 5px;
    margin-bottom: 5px;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
}

.btn-outline-secondary {
    background: transparent;
    border: 1.5px solid var(--primary-blue);
    color: var(--primary-blue);
}

.btn-outline-secondary:hover {
    background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
    color: white;
    border-color: transparent;
}

.btn-outline-danger {
    background: transparent;
    border: 1.5px solid #e74c3c;
    color: #e74c3c;
}

.btn-outline-danger:hover {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    border-color: transparent;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 12px;
}

.text-success {
    color: #27ae60 !important;
}

.text-muted {
    color: var(--text-secondary) !important;
}

.modal-content {
    background: var(--card-bg);
    border: 1.5px solid var(--border-color);
    border-radius: 12px;
    color: var(--text-primary);
}

.modal-header, .modal-footer {
    border-color: var(--border-color);
}

.modal-footer {
    border-top: 1px solid var(--border-color);
}

* {
    transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
}

.header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.header-section h2 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 24px;
    color: var(--text-primary);
    margin: 0;
}

.header-section p {
    color: var(--text-secondary);
    margin: 5px 0 0 0;
    font-size: 14px;
}

.actions-container {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.status-badge {
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.status-published {
    background-color: rgba(39, 174, 96, 0.1);
    color: #27ae60;
    border: 1px solid rgba(39, 174, 96, 0.2);
}

.status-draft {
    background-color: rgba(108, 117, 125, 0.1);
    color: #6c757d;
    border: 1px solid rgba(108, 117, 125, 0.2);
}
</style>

<div class="container">
    <div class="header-section">
        <div>
            <h2><i class="fas fa-newspaper me-2"></i>Manajemen Berita</h2>
            <p>Kelola berita dan pengumuman divisi</p>
        </div>
        <a href="<?= base_url('admin/news/new') ?>" class="btn">
            <i class="fas fa-plus-circle"></i> Tambah Berita
        </a>
    </div>
    
    <div class="dashboard-card">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Berita</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($newses as $news): ?>
                <tr>
                    <td><?= $news['id'] ?></td>
                    <td>
                        <strong style="font-family: 'Montserrat', sans-serif;"><?= $news['title'] ?></strong><br>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i><?= $news['created_at'] ?>
                        </small>
                    </td>
                    <td>
                        <?php if($news['status'] === 'published'): ?>
                        <span class="status-badge status-published">
                            <i class="fas fa-check-circle me-1"></i><?= $news['status'] ?>
                        </span>
                        <?php else: ?>
                        <span class="status-badge status-draft">
                            <i class="fas fa-save me-1"></i><?= $news['status'] ?>
                        </span>
                        <?php endif ?>
                    </td>
                    <td>
                        <div class="actions-container">
                            <a href="<?= base_url('admin/news/'.$news['id'].'/preview') ?>" 
                               class="btn btn-outline-secondary btn-sm" target="_blank">
                                <i class="fas fa-eye"></i> Preview
                            </a>
                            <a href="<?= base_url('admin/news/'.$news['id'].'/edit') ?>" 
                               class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="#" 
                               data-href="<?= base_url('admin/news/'.$news['id'].'/delete') ?>" 
                               onclick="confirmToDelete(this)" 
                               class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="h4" style="font-family: 'Montserrat', sans-serif;">
            <i class="fas fa-exclamation-triangle text-warning me-2"></i>Konfirmasi
        </h4>
        <p>Apakah Anda yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.</p>
      </div>
      <div class="modal-footer">
        <a href="#" role="button" id="delete-button" class="btn btn-outline-danger">
            <i class="fas fa-trash me-1"></i> Hapus
        </a>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
            <i class="fas fa-times me-1"></i> Batal
        </button>
      </div>
    </div>
  </div>
</div>

<script>
function confirmToDelete(el){
    $("#delete-button").attr("href", el.dataset.href);
    $("#confirm-dialog").modal('show');
}
</script>

<?= $this->endSection() ?>