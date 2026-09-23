<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

<div class="dashboard-container">
    <!-- Header dengan Tombol dan Pencarian -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="dashboard-title">Edit Riwayat Pendidikan</h1>
            <p class="dashboard-subtitle">Perbarui informasi riwayat pendidikan</p>
        </div>
        <div>
            <a href="<?= base_url('admin/riwayat-pendidikan') ?>" class="btn btn-secondary">
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

        <form id="editForm" action="<?= base_url('admin/riwayat-pendidikan/update/' . $riwayat['id_pendidikan']) ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label for="jenjang" class="form-label fw-semibold">Jenjang Pendidikan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <select class="form-select" id="jenjang" name="jenjang" required>
                                <option value="">Pilih Jenjang</option>
                                <?php foreach ($jenjangList as $jenjang): ?>
                                    <option value="<?= $jenjang ?>" <?= old('jenjang', $riwayat['jenjang']) == $jenjang ? 'selected' : '' ?>><?= $jenjang ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="nama_sekolah" class="form-label fw-semibold">Nama Sekolah/Universitas <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-school"></i></span>
                            <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" 
                                   value="<?= old('nama_sekolah', $riwayat['nama_sekolah']) ?>" required maxlength="200"
                                   placeholder="Nama lengkap institusi pendidikan">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="jurusan" class="form-label fw-semibold">Jurusan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-book"></i></span>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" 
                                   value="<?= old('jurusan', $riwayat['jurusan']) ?>" maxlength="100"
                                   placeholder="Contoh: Teknik Informatika, Akuntansi">
                        </div>
                        <div class="form-text mt-2">
                            <i class="fas fa-info-circle me-1"></i>
                            Kosongkan jika tidak ada (misal untuk SD, SMP)
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="tahun_masuk" class="form-label fw-semibold">Tahun Masuk <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-sign-in-alt"></i></span>
                                    <input type="number" class="form-control" id="tahun_masuk" name="tahun_masuk" 
                                           value="<?= old('tahun_masuk', $riwayat['tahun_masuk']) ?>" min="1900" max="2100" required
                                           placeholder="Contoh: 2015">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="tahun_lulus" class="form-label fw-semibold">Tahun Lulus <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-sign-out-alt"></i></span>
                                    <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" 
                                           value="<?= old('tahun_lulus', $riwayat['tahun_lulus']) ?>" min="1900" max="2100" required
                                           placeholder="Contoh: 2019">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="nilai_akhir" class="form-label fw-semibold">Nilai Akhir/IPK</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-chart-line"></i></span>
                            <input type="number" step="0.01" class="form-control" id="nilai_akhir" name="nilai_akhir" 
                                   value="<?= old('nilai_akhir', $riwayat['nilai_akhir']) ?>" min="0" max="4" step="0.01"
                                   placeholder="Contoh: 3.75">
                        </div>
                        <div class="form-text mt-2">
                            <i class="fas fa-info-circle me-1"></i>
                            Contoh: 3.75 (skala 0-4). Kosongkan jika tidak diperlukan.
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" 
                                      maxlength="500" placeholder="Informasi tambahan tentang pendidikan"><?= old('keterangan', $riwayat['keterangan']) ?></textarea>
                        </div>
                        <div class="form-text mt-2">
                            <i class="fas fa-info-circle me-1"></i>
                            Maksimal 500 karakter
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>