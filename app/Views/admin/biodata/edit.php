<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

<div class="dashboard-container">
    <!-- Header dengan Tombol dan Pencarian -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="dashboard-title">Edit Biodata</h1>
            <p class="dashboard-subtitle">Perbarui informasi biodata lengkap</p>
        </div>
        <div>
            <a href="<?= base_url('admin/biodata') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
            </a>
            <button type="submit" form="editForm" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Update Data
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
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <div class="mt-1">• <?= $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form id="editForm" action="<?= base_url('admin/biodata/update/' . $biodata['id_biodata']) ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="nama" name="nama" 
                                   value="<?= old('nama', $biodata['nama']) ?>" required maxlength="100"
                                   placeholder="Masukkan nama lengkap">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="tempat_lahir" class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" 
                                           value="<?= old('tempat_lahir', $biodata['tempat_lahir']) ?>" required maxlength="100"
                                           placeholder="Kota kelahiran">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
                                           value="<?= old('tanggal_lahir', $biodata['tanggal_lahir']) ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki" <?= old('jenis_kelamin', $biodata['jenis_kelamin']) == 'laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="perempuan" <?= old('jenis_kelamin', $biodata['jenis_kelamin']) == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="agama" class="form-label fw-semibold">Agama <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-pray"></i></span>
                                    <select class="form-select" id="agama" name="agama" required>
                                        <option value="">Pilih Agama</option>
                                        <?php foreach ($agamaList as $agama): ?>
                                            <option value="<?= $agama ?>" <?= old('agama', $biodata['agama']) == $agama ? 'selected' : '' ?>><?= $agama ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= old('email', $biodata['email']) ?>" required maxlength="100"
                                   placeholder="contoh@email.com">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="alamat" class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" 
                                      required maxlength="500" placeholder="Alamat lengkap tempat tinggal"><?= old('alamat', $biodata['alamat']) ?></textarea>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="no_telpon" class="form-label fw-semibold">No. Telepon/HP <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" class="form-control" id="no_telpon" name="no_telpon" 
                                   value="<?= old('no_telpon', $biodata['no_telpon']) ?>" required maxlength="20"
                                   placeholder="0812-3456-7890">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="status_perkawinan" class="form-label fw-semibold">Status Perkawinan <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-heart"></i></span>
                                    <select class="form-select" id="status_perkawinan" name="status_perkawinan" required>
                                        <option value="">Pilih Status</option>
                                        <?php foreach ($statusList as $status): ?>
                                            <option value="<?= $status ?>" <?= old('status_perkawinan', $biodata['status_perkawinan']) == $status ? 'selected' : '' ?>><?= $status ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="pekerjaan" class="form-label fw-semibold">Pekerjaan <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" 
                                           value="<?= old('pekerjaan', $biodata['pekerjaan']) ?>" required maxlength="100"
                                           placeholder="Jabatan/profesi">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="pendidikan_terakhir" class="form-label fw-semibold">Pendidikan Terakhir <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" 
                                   value="<?= old('pendidikan_terakhir', $biodata['pendidikan_terakhir']) ?>" required maxlength="100" 
                                   placeholder="Contoh: SMA, D3, S1, S2">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>