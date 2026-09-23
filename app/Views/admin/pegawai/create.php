<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        background-color: var(--bg-primary);
        color: var(--text-primary);
        transition: all 0.3s ease;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .dashboard-container {
        padding: 20px;
        max-width: 1200px;
        margin: 30px auto;
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
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px var(--shadow-color);
        transition: all 0.3s ease;
    }

    .btn-module {
        background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 14px;
        color: white;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-module:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.2);
        color: white;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
        border: none;
        border-radius: 6px;
        padding: 12px 24px;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--accent-blue), var(--primary-blue));
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.2);
    }

    .btn-secondary {
        background-color: var(--medium-gray);
        border-color: var(--medium-gray);
        border-radius: 6px;
        padding: 12px 24px;
        font-weight: 600;
    }

    .btn-secondary:hover {
        background-color: var(--dark-gray);
        border-color: var(--dark-gray);
    }

    .form-edit .form-control {
        background-color: var(--bg-primary);
        border: 1.5px solid var(--border-color);
        color: var(--text-primary);
        transition: all 0.3s ease;
    }

    .form-edit .form-control:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .form-edit .input-group-text {
        background-color: var(--bg-secondary);
        border: 1.5px solid var(--border-color);
        color: var(--text-secondary);
    }

    .alert {
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
    }

    .alert-danger {
        background-color: rgba(231, 76, 60, 0.1);
        border-color: rgba(231, 76, 60, 0.2);
        color: #e74c3c;
    }

    .form-text {
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    .img-preview {
        max-width: 100%;
        max-height: 150px;
        object-fit: cover;
        border-radius: 8px;
    }

    .nav-link {
        color: var(--text-primary);
    }

    .navbar-dark.bg-dark {
        background-color: var(--dark-gray) !important;
        border-bottom: 1px solid var(--border-color);
    }

    .navbar-text {
        color: var(--text-secondary) !important;
    }

    /* Responsif */
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
        }
        
        .btn-module {
            margin-top: 10px;
        }
        
        .d-flex.justify-content-between.border-top {
            flex-direction: column;
            gap: 10px;
        }
        
        .btn-lg {
            width: 100%;
        }
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-cogs me-2"></i>Admin Panel</a>
            <div class="navbar-nav ms-auto">
                <a href="/admin/dashboard" class="nav-link me-3"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a>
                <a href="/admin/pegawai" class="nav-link me-3"><i class="fas fa-users me-1"></i>Data Pegawai</a>
                <span class="navbar-text me-3">
                    <i class="fas fa-user me-1"></i>Hello, <?= $user['name'] ?>
                </span>
                <a href="/logout" class="btn btn-outline-light btn-sm"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
            </div>
        </div>
    </nav>

    <div class="dashboard-container">
        <!-- Header dengan Tombol -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="dashboard-title">Tambah Data Pegawai</h1>
                <p class="dashboard-subtitle">Tambah data pegawai baru</p>
            </div>
            <a href="/admin/pegawai" class="btn btn-module">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>

        <!-- Card untuk Form Tambah -->
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

            <form action="/admin/pegawai/store" method="post" enctype="multipart/form-data" class="form-edit">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="nama_pegawai" class="form-label fw-semibold">Nama Pegawai <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control form-control-lg" id="nama_pegawai" name="nama_pegawai" 
                                       value="<?= old('nama_pegawai') ?>" required 
                                       placeholder="Masukkan nama lengkap">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input type="date" class="form-control form-control-lg" id="tanggal_lahir" name="tanggal_lahir" 
                                       value="<?= old('tanggal_lahir') ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                <select class="form-select form-control-lg" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="laki-laki" <?= old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="perempuan" <?= old('jenis_kelamin') == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="foto_pegawai" class="form-label fw-semibold">Foto Pegawai</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                <input type="file" class="form-control form-control-lg" id="foto_pegawai" name="foto_pegawai" 
                                       accept="image/*">
                            </div>
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle me-1"></i>
                                Format: JPG, JPEG, PNG. Maksimal 1MB.
                            </div>
                            
                            <!-- Preview untuk foto baru -->
                            <div id="fotoPreview" class="mt-3 d-none">
                                <label class="form-label fw-semibold">Preview Foto</label>
                                <div class="preview-container text-center">
                                    <img id="imagePreview" class="img-preview rounded d-none" alt="Preview Gambar">
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            Pastikan foto yang diupload jelas dan sesuai dengan format yang ditentukan.
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Action -->
                <div class="d-flex justify-content-between border-top pt-4 mt-4">
                    <a href="/admin/pegawai" class="btn btn-secondary btn-lg px-4">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save me-2"></i>Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Preview untuk foto baru
    document.getElementById('foto_pegawai').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('fotoPreview');
        const imagePreview = document.getElementById('imagePreview');
        
        if (file) {
            previewContainer.classList.remove('d-none');
            
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        } else {
            previewContainer.classList.add('d-none');
        }
    });

    // Validasi file size
    document.querySelector('form').addEventListener('submit', function(e) {
        const fileInput = document.getElementById('foto_pegawai');
        const maxSize = 1 * 1024 * 1024; // 1MB
        
        if (fileInput.files.length > 0) {
            const fileSize = fileInput.files[0].size;
            if (fileSize > maxSize) {
                e.preventDefault();
                alert('Ukuran file terlalu besar. Maksimal 1MB.');
            }
        }
    });

    // Toggle tema dark/light
    function toggleTheme() {
        const currentTheme = document.body.getAttribute('data-theme');
        if (currentTheme === 'dark') {
            document.body.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
        } else {
            document.body.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        }
    }

    // Load tema dari localStorage
    window.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.setAttribute('data-theme', 'dark');
        }
    });
    </script>
</body>
</html>