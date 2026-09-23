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
    max-width: 1000px;
    margin: 0 auto;
}

.form-container {
    background: var(--card-bg);
    border: 1.5px solid var(--border-color);
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 10px 30px var(--shadow-color);
    transition: all 0.3s ease;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 8px;
    display: block;
    font-family: 'Montserrat', sans-serif;
    font-size: 14px;
}

.form-control {
    border: 1.5px solid var(--border-color);
    border-radius: 6px;
    padding: 12px 15px;
    font-size: 14px;
    transition: all 0.2s ease;
    background: var(--card-bg);
    color: var(--text-primary);
    width: 100%;
}

.form-control:focus {
    border-color: var(--secondary-blue);
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.1);
}

textarea.form-control {
    min-height: 300px;
    resize: vertical;
}

.btn {
    background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
    border: none;
    border-radius: 6px;
    padding: 12px 25px;
    font-weight: 600;
    font-size: 14px;
    color: white;
    transition: all 0.2s ease;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
}

.btn-secondary {
    background: linear-gradient(135deg, var(--medium-gray), var(--dark-gray));
}

.btn-secondary:hover {
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.2);
}

.button-group {
    display: flex;
    gap: 10px;
    margin-top: 30px;
}

* {
    transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
}

.page-header {
    margin-bottom: 30px;
}

.page-header h1 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 28px;
    color: var(--text-primary);
    margin: 0;
}

.page-header p {
    color: var(--text-secondary);
    margin: 5px 0 0 0;
    font-size: 14px;
}
</style>

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-plus-circle me-2"></i>Tambah Berita Baru</h1>
        <p>Buat berita atau pengumuman baru untuk divisi</p>
    </div>
    
    <div class="form-container">
        <form action="" method="post" id="text-editor">
            <div class="form-group">
                <label for="title">
                    <i class="fas fa-heading me-1"></i>Judul Berita
                </label>
                <input type="text" name="title" class="form-control" 
                    placeholder="Masukkan judul berita" 
                    required>
            </div>
            
            <div class="form-group">
                <label for="content">
                    <i class="fas fa-newspaper me-1"></i>Konten Berita
                </label>
                <textarea name="content" 
                    class="form-control" 
                    cols="30" rows="10" 
                    placeholder="Tulis konten berita di sini..."></textarea>
            </div>
            
            <div class="button-group">
                <button type="submit" name="status" value="published" class="btn">
                    <i class="fas fa-paper-plane"></i> Publikasikan
                </button>
                <button type="submit" name="status" value="draft" class="btn btn-secondary">
                    <i class="fas fa-save"></i> Simpan sebagai Draft
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>  