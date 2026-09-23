<nav class="navbar-modern-admin">
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
            --admin-accent: #1a73e8;
            --admin-accent-light: #4285f4;
            
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
            --admin-accent: #4285f4;
            --admin-accent-light: #64b5f6;
            
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

        .navbar-modern-admin {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
            box-shadow: 0 4px 12px var(--shadow-color);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            border-bottom: 3px solid var(--admin-accent);
        }

        .navbar-modern-admin.scrolled {
            box-shadow: 0 6px 30px var(--shadow-color);
        }

        .navbar-modern-admin .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Brand Logo */
        .navbar-brand-modern-admin {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--navbar-text);
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            border: 1.5px solid transparent;
            order: 1; /* Brand di kiri */
        }

        .navbar-brand-modern-admin i {
            font-size: 1.5rem;
            color: var(--admin-accent);
        }

        .navbar-brand-modern-admin:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            border-color: var(--admin-accent);
        }

        /* Navbar Menu */
        .navbar-menu-admin {
            display: flex;
            align-items: center;
            gap: 5px;
            list-style: none;
            margin: 0;
            padding: 0;
            order: 2; /* Menu di tengah */
            flex: 1;
            justify-content: center;
        }

        .nav-item-modern-admin {
            position: relative;
        }

        .nav-link-modern-admin {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.95);
            font-family: 'Open Sans', sans-serif;
            font-weight: 500;
            font-size: 0.95rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: transparent;
            border: 1.5px solid transparent;
        }

        .nav-link-modern-admin i {
            color: var(--admin-accent);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .nav-link-modern-admin:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-color: var(--admin-accent);
            transform: translateY(-2px);
        }

        .nav-link-modern-admin:hover i {
            transform: scale(1.2);
        }

        .nav-link-modern-admin.active {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
            border-color: var(--admin-accent);
        }

        /* Logout Button di Kanan */
        .logout-btn-right {
            order: 4; /* Paling kanan */
            margin-left: 10px;
        }

        .nav-logout-btn {
            background: linear-gradient(135deg, var(--admin-accent) 0%, var(--admin-accent-light) 100%);
            color: white;
            border: 1.5px solid transparent;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .nav-logout-btn i {
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .nav-logout-btn:hover {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
            color: white;
            border-color: var(--admin-accent);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .nav-logout-btn:hover i {
            transform: scale(1.2);
        }

        /* Navbar Toggler */
        .navbar-toggler-modern-admin {
            background: rgba(255, 255, 255, 0.15);
            border: 1.5px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            padding: 10px 15px;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--navbar-text);
            order: 3; /* Sebelum logout */
        }

        .navbar-toggler-modern-admin:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: rotate(90deg);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .navbar-toggler-modern-admin {
                display: flex;
                order: 3;
            }
            
            .logout-btn-right {
                order: 4;
                margin-left: 0;
                margin-right: 0;
                width: 100%;
                margin-top: 10px;
            }
            
            .navbar-menu-admin {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--card-bg);
                flex-direction: column;
                padding: 20px;
                box-shadow: 0 10px 30px var(--shadow-color);
                border-radius: 0 0 15px 15px;
                display: none;
                gap: 10px;
                border-top: 2px solid var(--admin-accent);
                order: unset;
                flex: none;
            }
            
            .navbar-menu-admin.active {
                display: flex;
            }
            
            .nav-item-modern-admin {
                width: 100%;
            }
            
            .nav-link-modern-admin {
                width: 100%;
                justify-content: space-between;
                color: var(--text-primary);
                background: var(--bg-secondary);
                border: 1.5px solid var(--border-color);
            }
            
            .nav-link-modern-admin:hover {
                background: rgba(52, 152, 219, 0.1);
                color: var(--secondary-blue);
                border-color: var(--secondary-blue);
            }
            
            .nav-logout-btn {
                width: 100%;
                justify-content: center;
                color: var(--text-primary);
                background: var(--bg-secondary);
                border-color: var(--border-color);
            }
            
            .nav-logout-btn:hover {
                color: var(--text-primary);
                background: rgba(52, 152, 219, 0.1);
                border-color: var(--secondary-blue);
            }
        }
    </style>
    
    <div class="container">
        <a href="<?= base_url('admin/dashboard') ?>" class="navbar-brand-modern-admin">
            <i class="fas fa-sliders-h"></i>
            <span>PANEL ADMIN</span>
        </a>
        
        <!-- Menu di Tengah -->
        <div class="navbar-menu-admin" id="navbarMenuAdmin">
            <li class="nav-item-modern-admin">
                <a href="<?= base_url('admin/news') ?>" class="nav-link-modern-admin" title="Berita">
                    <i class="fas fa-newspaper"></i>
                    <span>Berita</span>
                </a>
            </li>
            
            <li class="nav-item-modern-admin">
                <a href="<?= base_url('admin/pegawai') ?>" class="nav-link-modern-admin" title="Data Pegawai">
                    <i class="fas fa-users"></i>
                    <span>Pegawai</span>
                </a>
            </li>
            
            <li class="nav-item-modern-admin">
                <a href="<?= base_url('admin/aktivitas-harian') ?>" class="nav-link-modern-admin" title="Aktivitas Harian">
                    <i class="fas fa-calendar-day"></i>
                    <span>Aktivitas</span>
                </a>
            </li>
            
            <li class="nav-item-modern-admin">
                <a href="<?= base_url('admin/biodata') ?>" class="nav-link-modern-admin" title="Biodata">
                    <i class="fas fa-id-card"></i>
                    <span>Biodata</span>
                </a>
            </li>
            
            <li class="nav-item-modern-admin">
                <a href="<?= base_url('admin/riwayat-pendidikan') ?>" class="nav-link-modern-admin" title="Riwayat Pendidikan">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Pendidikan</span>
                </a>
            </li>
        </div>
        
        <!-- Toggler -->
        <button class="navbar-toggler-modern-admin" onclick="toggleNavbarMenuAdmin()">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Logout di Kanan -->
        <div class="logout-btn-right">
            <a href="<?= base_url('logout') ?>" class="nav-logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Keluar</span>
            </a>
        </div>
    </div>
    
    <script>
        function toggleNavbarMenuAdmin() {
            const navbarMenu = document.getElementById('navbarMenuAdmin');
            navbarMenu.classList.toggle('active');
        }

        document.addEventListener('click', function(event) {
            const navbarMenu = document.getElementById('navbarMenuAdmin');
            const navbarToggler = document.querySelector('.navbar-toggler-modern-admin');
            
            if (!event.target.closest('.navbar-menu-admin') && !event.target.closest('.navbar-toggler-modern-admin')) {
                navbarMenu.classList.remove('active');
            }
        });

        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-modern-admin');
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.pathname;
            document.querySelectorAll('.nav-link-modern-admin').forEach(link => {
                if (link.getAttribute('href') === currentUrl) {
                    link.classList.add('active');
                }
            });
            
            initTheme();
        });

        function initTheme() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                setDarkTheme();
            } else {
                setLightTheme();
            }
        }
        
        function setDarkTheme() {
            document.body.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        }
        
        function setLightTheme() {
            document.body.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
        }
    </script>
</nav>