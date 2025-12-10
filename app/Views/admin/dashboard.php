<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            
            /* Dark mode variables */
            --bg-primary: #ffffff;
            --bg-secondary: #f8f9fa;
            --text-primary: #2c3e50;
            --text-secondary: #7f8c8d;
            --card-bg: #ffffff;
            --border-color: #e9ecef;
            --shadow-color: rgba(0, 0, 0, 0.08);
            --navbar-bg: #2c3e50;
            --navbar-text: #ffffff;
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
            --navbar-bg: #1a202c;
            --navbar-text: #e2e8f0;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: all 0.3s ease;
            min-height: 100vh;
        }
        
        /* Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 20px;
            color: var(--navbar-text) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .navbar-brand i {
            font-size: 24px;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.2s ease;
            padding: 8px 16px !important;
            border-radius: 6px;
        }
        
        .nav-link:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .navbar-text {
            color: rgba(255, 255, 255, 0.9) !important;
            font-size: 14px;
            font-weight: 500;
        }
        
        .btn-logout {
            background: rgba(255, 255, 255, 0.15);
            border: 1.5px solid rgba(255, 255, 255, 0.3);
            color: white !important;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 20px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        
        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
        }
        
        /* Main Content */
        .dashboard-container {
            padding: 30px 15px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .welcome-section {
            margin-bottom: 30px;
        }
        
        .welcome-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 28px;
            color: var(--text-primary);
            margin-bottom: 10px;
        }
        
        .welcome-subtitle {
            color: var(--text-secondary);
            font-size: 16px;
        }
        
        /* Cards */
        .dashboard-card {
            background: var(--card-bg);
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px var(--shadow-color);
            transition: all 0.3s ease;
        }
        
        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px var(--shadow-color);
        }
        
        .dashboard-card-header {
            border-bottom: 1.5px solid var(--border-color);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .dashboard-card-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 20px;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }
        
        .dashboard-card-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }
        
        .module-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .module-card {
            background: var(--card-bg);
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
        }
        
        .module-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px var(--shadow-color);
            border-color: var(--secondary-blue);
        }
        
        .module-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            margin-bottom: 20px;
        }
        
        .module-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 18px;
            color: var(--text-primary);
            margin-bottom: 10px;
        }
        
        .module-description {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 20px;
            flex-grow: 1;
        }
        
        .btn-module {
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
            border: none;
            border-radius: 6px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 14px;
            color: white;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            justify-content: center;
        }
        
        .btn-module:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.2);
            color: white;
        }
        
        /* Theme Toggle */
        .theme-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        
        .theme-toggle-btn {
            background: var(--card-bg);
            border: 1.5px solid var(--border-color);
            border-radius: 50%;
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-primary);
            font-size: 20px;
            box-shadow: 0 4px 15px var(--shadow-color);
        }
        
        .theme-toggle-btn:hover {
            transform: translateY(-2px) rotate(15deg);
            box-shadow: 0 6px 20px var(--shadow-color);
        }
        
        .theme-toggle-btn i {
            transition: transform 0.3s ease;
        }
        
        [data-theme="dark"] .fa-sun {
            transform: rotate(180deg);
            color: #f6e05e;
        }
        
        [data-theme="light"] .fa-moon {
            color: #4a5568;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 20px 15px;
            }
            
            .welcome-title {
                font-size: 24px;
            }
            
            .module-grid {
                grid-template-columns: 1fr;
            }
            
            .theme-toggle {
                bottom: 20px;
                right: 20px;
            }
            
            .theme-toggle-btn {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }
            
            .navbar-nav {
                margin-top: 15px;
            }
            
            .nav-link, .navbar-text {
                padding-left: 0 !important;
            }
        }
        
        /* Theme transition */
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
    </style>
</head>
<body data-theme="light">
    <!-- Theme Toggle Button -->
    <div class="theme-toggle">
        <button class="theme-toggle-btn" id="themeToggle">
            <i class="fas fa-sun"></i>
            <i class="fas fa-moon"></i>
        </button>
    </div>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/admin/dashboard">
                <i class="fas fa-sliders-h"></i> PANEL ADMIN
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="color: white;">☰</span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a href="/admin/dashboard" class="nav-link">
                            <i class="fas fa-home me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <span class="navbar-text">
                            <i class="fas fa-user-circle me-1"></i> Halo, <?= $user['name'] ?>
                        </span>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="/logout" class="btn btn-logout">
                            <i class="fas fa-sign-out-alt me-1"></i> Keluar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="dashboard-container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1 class="welcome-title">Dashboard Admin</h1>
            <p class="welcome-subtitle">Kelola semua sistem operasional dan produksi dari satu tempat</p>
        </div>
        
        <!-- Stats Overview Card -->
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h3 class="dashboard-card-title">
                    <div class="dashboard-card-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    Ringkasan Sistem
                </h3>
            </div>
            <div class="card-body">
                <p>Selamat datang di dashboard admin! Dari sini Anda dapat mengelola semua aspek sistem operasional dan produksi.</p>
                
                <!-- Modules Grid -->
                <div class="module-grid">
                    <!-- News Admin Module -->
                    <div class="module-card">
                        <div class="module-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h4 class="module-title">Data Berita</h4>
                        <p class="module-description">Kelola artikel berita dan publikasi perusahaan</p>
                        <a href="/admin/news" class="btn-module">
                            <i class="fas fa-cog me-1"></i> Kelola Berita
                        </a>
                    </div>
                    
                    <!-- Data Pegawai Module -->
                    <div class="module-card">
                        <div class="module-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="module-title">Data Pegawai</h4>
                        <p class="module-description">Kelola data karyawan dan informasi personal</p>
                        <a href="/admin/pegawai" class="btn-module">
                            <i class="fas fa-cog me-1"></i> Kelola Pegawai
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Theme Toggle Functionality
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;
        
        // Check for saved theme or prefer-color-scheme
        const savedTheme = localStorage.getItem('theme') || 'light';
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        // Set initial theme
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            setDarkTheme();
        } else {
            setLightTheme();
        }
        
        themeToggle.addEventListener('click', () => {
            if (body.getAttribute('data-theme') === 'light') {
                setDarkTheme();
            } else {
                setLightTheme();
            }
        });
        
        function setDarkTheme() {
            body.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            
            // Update table styling for dark mode
            updateTableTheme('dark');
        }
        
        function setLightTheme() {
            body.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
            
            // Update table styling for light mode
            updateTableTheme('light');
        }
        
        function updateTableTheme(theme) {
            const tables = document.querySelectorAll('table');
            tables.forEach(table => {
                if (theme === 'dark') {
                    table.classList.add('table-dark');
                    table.classList.remove('table-light');
                } else {
                    table.classList.add('table-light');
                    table.classList.remove('table-dark');
                }
            });
        }
        
        // Initialize table theme
        document.addEventListener('DOMContentLoaded', function() {
            updateTableTheme(body.getAttribute('data-theme'));
        });
        
        // Module card hover effects
        const moduleCards = document.querySelectorAll('.module-card');
        moduleCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>