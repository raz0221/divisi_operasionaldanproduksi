<div class="sidebar-section">
    <h3 class="sidebar-title">
        <i class="fas fa-newspaper"></i> Berita Terbaru
    </h3>
    <div class="recent-posts-widget">
        <?= view_cell('\App\Libraries\Widget::recentPost', ['limit'=>5]) ?>
    </div>
</div>

<div class="sidebar-section">
    <h3 class="sidebar-title">
        <i class="fas fa-link"></i> Tautan Cepat
    </h3>
    <ul class="sidebar-list">
        <li>
            <a href="<?= base_url('news') ?>">
                <i class="fas fa-newspaper"></i>
                <span>Semua Berita</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('dataKaryawan') ?>">
                <i class="fas fa-users"></i>
                <span>Data Pegawai</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('about') ?>">
                <i class="fas fa-info-circle"></i>
                <span>Tentang Kami</span>
            </a>
        </li>
        <li>
            <a href="<?= base_url('contact') ?>">
                <i class="fas fa-envelope"></i>
                <span>Kontak</span>
            </a>
        </li>
    </ul>
</div>

<div class="sidebar-section">
    <h3 class="sidebar-title">
        <i class="fas fa-tags"></i> Kategori
    </h3>
    <ul class="sidebar-list">
        <li>
            <a href="#">
                <i class="fas fa-cog"></i>
                <span>Operasional</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-industry"></i>
                <span>Produksi</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-users"></i>
                <span>SDM</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-chart-line"></i>
                <span>Pengembangan</span>
            </a>
        </li>
    </ul>
</div>

<style>
    /* Additional styling for sidebar content */
    .recent-posts-widget {
        margin-top: 10px;
    }
    
    .widget-post-item {
        display: flex;
        align-items: flex-start;
        padding: 12px;
        background: var(--bg-secondary);
        border-radius: 8px;
        margin-bottom: 12px;
        transition: all 0.2s ease;
    }
    
    .widget-post-item:hover {
        background: var(--primary-blue);
        color: white;
        transform: translateX(5px);
    }
    
    .widget-post-item:hover .widget-post-title,
    .widget-post-item:hover .widget-post-date {
        color: white;
    }
    
    .widget-post-content {
        flex: 1;
    }
    
    .widget-post-title {
        font-weight: 600;
        font-size: 14px;
        color: var(--text-primary);
        margin-bottom: 5px;
        line-height: 1.4;
    }
    
    .widget-post-date {
        font-size: 12px;
        color: var(--text-secondary);
    }
</style>