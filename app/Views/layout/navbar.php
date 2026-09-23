<nav class="navbar-modern">
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
            --navbar-accent: #1a73e8; /* Changed from yellow to blue */
            --navbar-accent-light: #4285f4; /* Changed from yellow-light to blue */
            
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
            --navbar-accent: #4285f4; /* Dark mode blue accent */
            --navbar-accent-light: #64b5f6; /* Dark mode light blue accent */
            
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

        .navbar-modern {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
            box-shadow: 0 4px 12px var(--shadow-color);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            border-bottom: 3px solid var(--navbar-accent); /* Blue border instead of yellow */
        }

        .navbar-modern.scrolled {
            box-shadow: 0 6px 30px var(--shadow-color);
        }

        .navbar-modern .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Brand Logo */
        .navbar-brand-modern {
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
        }

        .navbar-brand-modern i {
            font-size: 1.5rem;
            color: var(--navbar-accent); /* Blue icon */
        }

        .navbar-brand-modern:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            border-color: var(--navbar-accent); /* Blue border on hover */
        }

        /* Navbar Toggler */
        .navbar-toggler-modern {
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
        }

        .navbar-toggler-modern:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: rotate(90deg);
        }

        /* Navbar Menu */
        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 5px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-item-modern {
            position: relative;
        }

        .nav-link-modern {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.95); /* Brighter text for better visibility */
            font-family: 'Open Sans', sans-serif;
            font-weight: 500;
            font-size: 0.95rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: transparent;
            border: 1.5px solid transparent;
        }

        .nav-link-modern i {
            color: var(--navbar-accent); /* Blue icon */
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .nav-link-modern:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-color: var(--navbar-accent); /* Blue border on hover */
            transform: translateY(-2px);
        }

        .nav-link-modern:hover i {
            transform: scale(1.2);
        }

        .nav-link-modern.active {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
            border-color: var(--navbar-accent); /* Blue border for active state */
        }

        /* Dropdown Styles */
        .dropdown-menu-modern {
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--card-bg);
            min-width: 240px;
            box-shadow: 0 10px 30px var(--shadow-color);
            border-radius: 12px;
            border: 1.5px solid var(--border-color);
            padding: 15px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 1000;
            margin-top: 10px;
        }

        .nav-item-modern:hover .dropdown-menu-modern {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item-modern {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            text-decoration: none;
            color: var(--text-primary);
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 5px;
            border: 1.5px solid transparent;
        }

        .dropdown-item-modern i {
            color: var(--secondary-blue);
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .dropdown-item-modern:hover {
            background: rgba(52, 152, 219, 0.1);
            color: var(--secondary-blue);
            border-color: var(--secondary-blue);
            transform: translateX(5px);
        }

        .dropdown-item-modern:hover i {
            color: var(--secondary-blue);
            transform: scale(1.1);
        }

        .dropdown-divider-modern {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--secondary-blue), transparent);
            margin: 10px 0;
        }

        /* Badge */
        .nav-badge {
            background: var(--navbar-accent); /* Blue badge */
            color: white; /* White text for better contrast */
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            margin-left: 8px;
            animation: badgePulse 2s infinite;
        }

        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Login Button Special */
        .nav-login-btn {
            background: linear-gradient(135deg, var(--navbar-accent) 0%, var(--navbar-accent-light) 100%); /* Blue gradient */
            color: white; /* White text for better contrast */
            border: 1.5px solid transparent;
            font-weight: 600;
        }

        .nav-login-btn:hover {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
            color: white;
            border-color: var(--navbar-accent);
        }

        /* Theme Toggle Button in Navbar */
        .theme-toggle-btn-navbar {
            background: rgba(255, 255, 255, 0.15);
            border: 1.5px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white; /* Brighter text */
            font-weight: 500;
            font-size: 0.9rem;
        }

        .theme-toggle-btn-navbar:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            border-color: var(--navbar-accent); /* Blue border on hover */
        }

        .theme-toggle-btn-navbar i {
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        [data-theme="dark"] .fa-sun {
            transform: rotate(180deg);
            color: var(--navbar-accent); /* Blue sun icon in dark mode */
        }

        [data-theme="light"] .fa-moon {
            color: var(--navbar-accent); /* Blue moon icon in light mode */
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .navbar-toggler-modern {
                display: flex;
            }

            .navbar-menu {
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
                border-top: 2px solid var(--navbar-accent); /* Blue border */
            }

            .navbar-menu.active {
                display: flex;
            }

            .nav-item-modern {
                width: 100%;
            }

            .nav-link-modern {
                width: 100%;
                justify-content: space-between;
                color: var(--text-primary);
                background: var(--bg-secondary);
                border: 1.5px solid var(--border-color);
            }

            .nav-link-modern:hover {
                background: rgba(52, 152, 219, 0.1);
                color: var(--secondary-blue);
                border-color: var(--secondary-blue);
            }

            .nav-link-modern i {
                color: var(--secondary-blue);
            }

            .dropdown-menu-modern {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                box-shadow: none;
                border: 1.5px solid var(--border-color);
                display: none;
                margin-top: 10px;
                width: 100%;
            }

            .dropdown-menu-modern.active {
                display: block;
            }

            .theme-toggle-btn-navbar {
                color: var(--text-primary);
                background: var(--bg-secondary);
                border-color: var(--border-color);
                justify-content: center;
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .navbar-modern .container {
                padding: 0 1rem;
            }

            .navbar-brand-modern {
                font-size: 1.1rem;
                padding: 10px 15px;
            }

            .nav-link-modern {
                padding: 10px 15px;
                font-size: 0.9rem;
            }
        }

        /* Smooth theme transitions */
        .navbar-modern,
        .nav-link-modern,
        .dropdown-menu-modern,
        .theme-toggle-btn-navbar {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        }
    </style>
    
    <div class="container">
        <a href="<?= base_url('/') ?>" class="navbar-brand-modern">
            <i class="fas fa-industry"></i>
            <span>Home</span>
        </a>
        
        <div class="navbar-menu" id="navbarMenu">
            <li class="nav-item-modern">
                <a href="#" class="nav-link-modern dropdown-toggle" onclick="toggleDropdown('dropdownInfo')">
                    <i class="fas fa-info-circle"></i>
                    <span>Informasi</span>
                    <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                </a>
                <div class="dropdown-menu-modern" id="dropdownInfo">
                    <a href="<?= base_url('news') ?>" class="dropdown-item-modern">
                        <i class="fas fa-newspaper"></i>
                        <span>Berita & Update</span>
                    </a>
                    <a href="<?= base_url('about') ?>" class="dropdown-item-modern">
                        <i class="fas fa-building"></i>
                        <span>Tentang Kami</span>
                    </a>
                    <div class="dropdown-divider-modern"></div>
                    <a href="<?= base_url('dataKaryawan') ?>" class="dropdown-item-modern">
                        <i class="fas fa-users"></i>
                        <span>Data Pegawai</span>
                    </a>
                </div>
            </li>
            
            <li class="nav-item-modern">
                <a href="#" class="nav-link-modern dropdown-toggle" onclick="toggleDropdown('dropdownContact')">
                    <i class="fas fa-headset"></i>
                    <span>Hubungi Kami</span>
                    <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                </a>
                <div class="dropdown-menu-modern" id="dropdownContact">
                    <a href="<?= base_url('contact') ?>" class="dropdown-item-modern">
                        <i class="fas fa-phone-alt"></i>
                        <span>Kontak & Support</span>
                    </a>
                    <a href="<?= base_url('faqs') ?>" class="dropdown-item-modern">
                        <i class="fas fa-question-circle"></i>
                        <span>FAQ & Bantuan</span>
                    </a>
                </div>
            </li>
            
            <li class="nav-item-modern">
                <a href="#" class="nav-link-modern dropdown-toggle" onclick="toggleDropdown('dropdownProfile')">
                    <i class="fas fa-user-circle"></i>
                    <span>Data Diri</span>
                    <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                </a>
                <div class="dropdown-menu-modern" id="dropdownProfile">
                    <a href="<?= base_url('aktivitas') ?>" class="dropdown-item-modern">
                        <i class="fas fa-tasks"></i>
                        <span>Aktivitas Harian</span>
                    </a>
                    <a href="<?= base_url('biodata') ?>" class="dropdown-item-modern">
                        <i class="fas fa-id-card"></i>
                        <span>Biodata</span>
                    </a>
                    <a href="<?= base_url('riwayat-pendidikan') ?>" class="dropdown-item-modern">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Riwayat Pendidikan</span>
                    </a>
                </div>
            </li>
            
            <li class="nav-item-modern">
                <a href="<?= base_url('login') ?>" class="nav-link-modern nav-login-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </a>
            </li>
            
            <!-- Theme Toggle in Navbar -->
            <li class="nav-item-modern">
                <button class="theme-toggle-btn-navbar" id="themeToggleNavbar">
                    <i class="fas fa-sun"></i>
                    <i class="fas fa-moon"></i>
                    <span class="theme-text-navbar">Mode</span>
                </button>
            </li>
        </div>
        
        <button class="navbar-toggler-modern" onclick="toggleNavbarMenu()">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    
    <script>
        function toggleNavbarMenu() {
            const navbarMenu = document.getElementById('navbarMenu');
            navbarMenu.classList.toggle('active');
        }

        function toggleDropdown(dropdownId) {
            if (window.innerWidth <= 992) {
                const dropdown = document.getElementById(dropdownId);
                dropdown.classList.toggle('active');
                
                // Close other dropdowns
                document.querySelectorAll('.dropdown-menu-modern').forEach(menu => {
                    if (menu.id !== dropdownId && menu.classList.contains('active')) {
                        menu.classList.remove('active');
                    }
                });
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.nav-item-modern') && !event.target.closest('.navbar-toggler-modern')) {
                document.querySelectorAll('.dropdown-menu-modern').forEach(menu => {
                    menu.classList.remove('active');
                });
                
                if (window.innerWidth <= 992) {
                    document.getElementById('navbarMenu').classList.remove('active');
                }
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-modern');
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Set active link based on current page
        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.pathname;
            document.querySelectorAll('.nav-link-modern').forEach(link => {
                if (link.getAttribute('href') === currentUrl) {
                    link.classList.add('active');
                }
            });
            
            // Initialize theme from localStorage
            initTheme();
        });

        // Theme Toggle Functionality for Navbar
        const themeToggleNavbar = document.getElementById('themeToggleNavbar');
        const themeTextNavbar = themeToggleNavbar.querySelector('.theme-text-navbar');
        
        function initTheme() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                setDarkTheme();
            } else {
                setLightTheme();
            }
        }
        
        themeToggleNavbar.addEventListener('click', () => {
            if (document.body.getAttribute('data-theme') === 'light') {
                setDarkTheme();
            } else {
                setLightTheme();
            }
        });
        
        function setDarkTheme() {
            document.body.setAttribute('data-theme', 'dark');
            themeTextNavbar.textContent = 'Gelap';
            localStorage.setItem('theme', 'dark');
        }
        
        function setLightTheme() {
            document.body.setAttribute('data-theme', 'light');
            themeTextNavbar.textContent = 'Terang';
            localStorage.setItem('theme', 'light');
        }
    </script>
</nav>