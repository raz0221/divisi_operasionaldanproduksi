<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

<div class="dashboard-container">
    <!-- Header dengan Tombol dan Pencarian -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="dashboard-title">Tambah Aktivitas Harian</h1>
            <p class="dashboard-subtitle">Tambah data aktivitas harian karyawan</p>
        </div>
        <div>
            <a href="<?= base_url('admin/aktivitas-harian') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
            </a>
            <button type="submit" form="createForm" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Simpan Data
            </button>
        </div>
    </div>

    <!-- Card untuk Konten Utama -->
    <div class="dashboard-card">
        <!-- Alert untuk Error -->
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger mb-4">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Terjadi kesalahan:</strong>
                <?php foreach (session()->getFlashdata('errors') as $field => $error): ?>
                    <div class="mt-1">• <?= is_array($error) ? $error[0] : $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger mb-4">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form id="createForm" action="<?= base_url('admin/aktivitas-harian/store') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="tanggal" class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" 
                                   value="<?= old('tanggal', date('Y-m-d')) ?>" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="jam" class="form-label fw-semibold">Jam <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="time" class="form-control" id="jam" name="jam" 
                                   value="<?= old('jam', date('H:i')) ?>" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="nama_aktivitas" class="form-label fw-semibold">Nama Aktivitas <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                            <input type="text" class="form-control" id="nama_aktivitas" name="nama_aktivitas" 
                                   value="<?= old('nama_aktivitas') ?>" required maxlength="200" 
                                   placeholder="Masukkan nama aktivitas">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="media_file" class="form-label fw-semibold">Foto/Video <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-upload"></i></span>
                            <input type="file" class="form-control" id="media_file" name="media_file" 
                                   accept="image/*,video/*" required>
                        </div>
                        <div class="form-text mt-2">
                            <i class="fas fa-info-circle me-1"></i>
                            Format yang diterima: JPG, JPEG, PNG (gambar) atau MP4, AVI, MKV (video). Maksimal 5MB.
                        </div>
                    </div>
                    
                    <!-- Preview untuk file baru -->
                    <div id="mediaPreview" class="mb-4 d-none">
                        <label class="form-label fw-semibold">Preview Media</label>
                        <div class="border rounded p-3 text-center">
                            <img id="imagePreview" class="img-fluid rounded d-none" alt="Preview Gambar" style="max-height: 150px;">
                            <video id="videoPreview" controls class="w-100 rounded d-none" style="max-height: 150px;"></video>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Pastikan file yang diupload tidak melebihi 5MB dan formatnya sesuai.
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Preview untuk file media baru
document.getElementById('media_file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const previewContainer = document.getElementById('mediaPreview');
    const imagePreview = document.getElementById('imagePreview');
    const videoPreview = document.getElementById('videoPreview');
    
    if (file) {
        previewContainer.classList.remove('d-none');
        imagePreview.classList.add('d-none');
        videoPreview.classList.add('d-none');
        
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        } else if (file.type.startsWith('video/')) {
            videoPreview.src = URL.createObjectURL(file);
            videoPreview.classList.remove('d-none');
        }
    } else {
        previewContainer.classList.add('d-none');
    }
});

// Validasi file size
document.getElementById('createForm').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('media_file');
    const maxSize = 5 * 1024 * 1024; // 5MB
    
    if (fileInput.files.length > 0) {
        const fileSize = fileInput.files[0].size;
        if (fileSize > maxSize) {
            e.preventDefault();
            alert('Ukuran file terlalu besar. Maksimal 5MB.');
        }
    }
});
</script>

<?= $this->endSection() ?>