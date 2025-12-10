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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            margin: 0;
            transition: background 0.3s ease;
            color: var(--text-primary);
        }
        
        .login-container {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px var(--shadow-color);
            max-height: 550px;
            transition: all 0.3s ease;
        }
        
        .login-left {
            flex: 1;
            padding: 35px;
            background: var(--card-bg);
            overflow-y: auto;
        }
        
        .login-right {
            flex: 1;
            padding: 35px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
        }
        
        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            flex-shrink: 0;
        }
        
        .logo-text h2 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 20px;
            margin: 0;
            color: var(--text-primary);
            line-height: 1.3;
        }
        
        .logo-text p {
            font-size: 13px;
            color: var(--text-secondary);
            margin: 3px 0 0 0;
        }
        
        .login-header h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 26px;
            color: var(--text-primary);
            margin-bottom: 8px;
        }
        
        .login-header p {
            color: var(--text-secondary);
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.4;
        }
        
        .form-group {
            margin-bottom: 18px;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .form-control {
            border: 1.5px solid var(--border-color);
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 13px;
            transition: all 0.2s ease;
            height: 42px;
            background: var(--card-bg);
            color: var(--text-primary);
        }
        
        .form-control:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.1);
        }
        
        .form-control::placeholder {
            color: var(--text-secondary);
            opacity: 0.7;
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 13px;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .form-check-input {
            width: 16px;
            height: 16px;
            margin: 0;
        }
        
        .form-check-label {
            font-size: 13px;
            color: var(--text-secondary);
        }
        
        .forgot-password {
            color: var(--secondary-blue);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .btn-signin {
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
            border: none;
            border-radius: 6px;
            padding: 12px;
            font-weight: 600;
            font-size: 14px;
            color: white;
            width: 100%;
            margin-bottom: 20px;
            transition: all 0.2s ease;
            height: 44px;
        }
        
        .btn-signin:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
        }
        
        .btn-home {
            background: transparent;
            border: 1.5px solid var(--primary-blue);
            color: var(--primary-blue);
            border-radius: 6px;
            padding: 12px;
            font-weight: 600;
            font-size: 14px;
            width: 100%;
            margin-bottom: 20px;
            transition: all 0.2s ease;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        
        .btn-home:hover {
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
            color: white;
            border-color: transparent;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
        }
        
        .welcome-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 15px;
            line-height: 1.3;
            color: var(--white);
        }
        
        .welcome-text {
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 20px;
            opacity: 0.9;
            color: var(--white);
        }
        
        .features-list {
            list-style: none;
            padding: 0;
            margin: 0 0 25px 0;
        }
        
        .features-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 13px;
            line-height: 1.4;
            color: var(--white);
        }
        
        .features-list i {
            color: var(--secondary-blue);
            background: rgba(255, 255, 255, 0.1);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
            font-size: 12px;
        }
        
        .divisional-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.12);
            padding: 5px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
            color: var(--white);
        }
        
        .alert {
            border-radius: 6px;
            border: none;
            font-size: 13px;
            padding: 10px 12px;
            margin-bottom: 15px;
        }
        
        .alert-danger {
            background: #ffeaea;
            color: #e74c3c;
            border-left: 3px solid #e74c3c;
        }
        
        [data-theme="dark"] .alert-danger {
            background: #442a2a;
            color: #ff6b6b;
            border-left: 3px solid #ff6b6b;
        }
        
        .alert-success {
            background: #e8f8ef;
            color: #27ae60;
            border-left: 3px solid #27ae60;
        }
        
        [data-theme="dark"] .alert-success {
            background: #2a4433;
            color: #6bff9a;
            border-left: 3px solid #6bff9a;
        }
        
        /* Theme Toggle Switch */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .theme-toggle-btn {
            background: var(--card-bg);
            border: 1.5px solid var(--border-color);
            border-radius: 30px;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-primary);
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 2px 10px var(--shadow-color);
        }
        
        .theme-toggle-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px var(--shadow-color);
        }
        
        .theme-toggle-btn i {
            font-size: 16px;
            transition: transform 0.3s ease;
        }
        
        [data-theme="dark"] .fa-sun {
            transform: rotate(180deg);
            color: #f6e05e;
        }
        
        [data-theme="light"] .fa-moon {
            color: #4a5568;
        }
        
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-height: none;
            }
            
            .login-left, .login-right {
                padding: 25px;
            }
            
            .login-right {
                order: -1;
            }
            
            .theme-toggle {
                top: 10px;
                right: 10px;
            }
            
            .theme-toggle-btn {
                padding: 6px 12px;
                font-size: 13px;
            }
        }
        
        /* Scrollbar styling */
        .login-left::-webkit-scrollbar {
            width: 5px;
        }
        
        .login-left::-webkit-scrollbar-track {
            background: var(--bg-secondary);
            border-radius: 3px;
        }
        
        .login-left::-webkit-scrollbar-thumb {
            background: var(--medium-gray);
            border-radius: 3px;
        }
        
        .login-left::-webkit-scrollbar-thumb:hover {
            background: var(--primary-blue);
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
            <span class="theme-text">Mode Terang</span>
        </button>
    </div>
    
    <div class="login-container">
        <!-- Left Column - Login Form -->
        <div class="login-left">
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-industry"></i>
                </div>
                <div class="logo-text">
                    <h2>Operasional & Produksi</h2>
                    <p>Sistem News & Data Pegawai</p>
                </div>
            </div>
            
            <div class="login-header">
                <h1>Selamat Datang!</h1>
                <p>Masuk untuk mengakses sistem manajemen News dan Data Pegawai divisi operasional & produksi</p>
            </div>
            
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            
            <form action="/processLogin" method="post">
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i> Alamat Email
                    </label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?= old('email') ?>" 
                           placeholder="email@gmail.com" 
                           required>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i> Kata Sandi
                    </label>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="••••••••" 
                           required>
                </div>
                
                <button type="submit" class="btn btn-signin">
                    <i class="fas fa-sign-in-alt"></i> MASUK
                </button>
            </form>
            
            <!-- Tombol untuk menuju ke halaman home -->
            <div class="form-group">
                <a href="<?= base_url('/') ?>" class="btn btn-home">
                    <i class="fas fa-home mr-2"></i> Kembali ke Home
                </a>
            </div>
            
            <!-- Note for authorized users only -->
            <div class="text-center mt-3">
                <small class="text-muted">Divisi Operasional & Produksi</small>
            </div>
        </div>
        
        <!-- Right Column - Welcome Message -->
        <div class="login-right">
            <h2 class="welcome-title">Kelola Informasi dan Data Pegawai</h2>
            <p class="welcome-text">
                Akses berita terbaru divisi, kelola data pegawai operasional & produksi, dan pantau informasi penting dalam satu sistem terintegrasi.
            </p>
            
            <ul class="features-list">
                <li>
                    <i class="fas fa-newspaper"></i>
                    <span>Manajemen Berita dan Pengumuman Divisi</span>
                </li>
                <li>
                    <i class="fas fa-user-tie"></i>
                    <span>Data Pegawai Operasional & Produksi</span>
                </li>
                <li>
                    <i class="fas fa-database"></i>
                    <span>Pusat Informasi Terintegrasi</span>
                </li>
                <li>
                    <i class="fas fa-chart-bar"></i>
                    <span>Dashboard Data Pegawai Real-time</span>
                </li>
            </ul>
            
            <div class="divisional-badge">
                <i class="fas fa-hard-hat"></i> Divisi Operasional & Produksi
            </div>
        </div>
    </div>

    <script>
        // Theme Toggle Functionality
        const themeToggle = document.getElementById('themeToggle');
        const themeText = themeToggle.querySelector('.theme-text');
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
            themeText.textContent = 'Mode Gelap';
            localStorage.setItem('theme', 'dark');
        }
        
        function setLightTheme() {
            body.setAttribute('data-theme', 'light');
            themeText.textContent = 'Mode Terang';
            localStorage.setItem('theme', 'light');
        }
        
        // Form animation
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });
            
            // Button hover effect
            const signInBtn = document.querySelector('.btn-signin');
            if (signInBtn) {
                signInBtn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                signInBtn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            }
            
            // Home button hover effect
            const homeBtn = document.querySelector('.btn-home');
            if (homeBtn) {
                homeBtn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                homeBtn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            }
            
            // Translate error messages from English to Indonesian
            setTimeout(function() {
                const errorElements = document.querySelectorAll('.alert-danger');
                const errorTranslations = {
                    // Validation errors
                    'The email field must contain a valid email address.': 'Alamat email harus berisi alamat email yang valid.',
                    'The email field is required.': 'Alamat email wajib diisi.',
                    'The password field is required.': 'Kata sandi wajib diisi.',
                    'The password field must be at least 8 characters in length.': 'Kata sandi harus memiliki minimal 8 karakter.',
                    'Invalid credentials.': 'Kredensial tidak valid.',
                    'Invalid email or password.': 'Email atau kata sandi tidak valid.',
                    'Email not found.': 'Email tidak ditemukan.',
                    'Incorrect password.': 'Kata sandi salah.',
                    'Account is inactive.': 'Akun tidak aktif.',
                    'Account is blocked.': 'Akun diblokir.',
                    'Too many login attempts.': 'Terlalu banyak percobaan login.',
                    'Please try again later.': 'Silakan coba lagi nanti.',
                    'Session expired.': 'Sesi telah berakhir.',
                    'Access denied.': 'Akses ditolak.',
                    'Unauthorized access.': 'Akses tidak sah.',
                    // Add more translations as needed
                };
                
                errorElements.forEach(function(element) {
                    let errorText = element.textContent.trim();
                    
                    // Check for exact matches
                    if (errorTranslations[errorText]) {
                        element.textContent = errorTranslations[errorText];
                    } else {
                        // Check for partial matches
                        for (const [english, indonesian] of Object.entries(errorTranslations)) {
                            if (errorText.includes(english)) {
                                element.textContent = errorText.replace(english, indonesian);
                                break;
                            }
                        }
                    }
                });
            }, 100);
        });
    </script>
</body>
</html>