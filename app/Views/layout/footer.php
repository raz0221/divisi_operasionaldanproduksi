<footer class="footer-modern">
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
            --footer-accent: #1a73e8; /* Changed from yellow to blue */
            
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
            --footer-accent: #4285f4; /* Dark mode blue accent */
            
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
        
        .footer-modern {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
            color: var(--white);
            padding: 2rem 0 !important;
            margin: 3rem 0 0 0 !important;
            border-top: 3px solid var(--footer-accent); /* Blue border instead of yellow */
            box-shadow: 0 -4px 12px var(--shadow-color);
            position: relative;
            overflow: hidden;
            width: 100%;
        }
        
        .footer-modern::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 10% 20%, rgba(26, 115, 232, 0.05) 0%, transparent 40%), /* Blue gradient */
                radial-gradient(circle at 90% 80%, rgba(52, 152, 219, 0.05) 0%, transparent 40%);
            pointer-events: none;
        }
        
        .footer-modern .container {
            position: relative;
            z-index: 2;
            padding: 0 15px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            width: 100%;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
            flex-wrap: wrap;
            text-align: center;
        }
        
        .footer-logo-icon {
            width: 32px;
            height: 32px;
            min-width: 32px;
            background: var(--footer-accent); /* Blue background */
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white; /* White icon for better contrast */
            font-size: 16px;
        }
        
        .footer-logo-text {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: clamp(1rem, 2.5vw, 1.1rem);
            color: var(--white);
        }
        
        .footer-divider {
            width: 100px;
            height: 2px;
            background: rgba(255, 255, 255, 0.2);
            margin: 5px 0;
        }
        
        .footer-copyright {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
            text-align: center;
            font-size: clamp(0.85rem, 2vw, 0.95rem);
            color: rgba(255, 255, 255, 0.95); /* Brighter text */
        }
        
        .footer-copyright a {
            color: var(--footer-accent); /* Blue accent */
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            white-space: nowrap;
        }
        
        .footer-copyright a:hover {
            color: var(--white);
            text-decoration: underline;
        }
        
        .footer-copyright span {
            color: rgba(255, 255, 255, 0.85); /* Brighter span text */
        }
        
        .footer-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
            width: 100%;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.9); /* Brighter link text */
            text-decoration: none;
            font-size: clamp(0.8rem, 2vw, 0.9rem);
            transition: all 0.3s ease;
            padding: 5px 10px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid transparent;
            white-space: nowrap;
        }
        
        .footer-links a:hover {
            color: var(--footer-accent); /* Blue on hover */
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--footer-accent); /* Blue border on hover */
            transform: translateY(-2px);
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-modern {
                padding: 1.5rem 0 !important;
                margin-top: 2rem !important;
            }
            
            .footer-links {
                gap: 10px;
            }
            
            .footer-copyright {
                gap: 6px;
            }
            
            .footer-links a {
                padding: 4px 8px;
            }
        }
        
        @media (max-width: 576px) {
            .footer-modern {
                padding: 1.2rem 0 !important;
            }
            
            .footer-content {
                gap: 12px;
            }
            
            .footer-logo {
                gap: 8px;
            }
            
            .footer-logo-icon {
                width: 28px;
                height: 28px;
                min-width: 28px;
                font-size: 14px;
            }
            
            .footer-logo-text {
                font-size: 1rem;
            }
            
            .footer-copyright {
                flex-direction: column;
                gap: 5px;
            }
            
            .footer-links {
                gap: 8px;
                justify-content: space-around;
            }
        }
        
        @media (max-width: 480px) {
            .footer-links {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
                text-align: center;
            }
            
            .footer-links a {
                justify-self: center;
                width: 100%;
                text-align: center;
            }
            
            .footer-copyright {
                font-size: 0.8rem;
            }
        }
        
        @media (max-width: 360px) {
            .footer-links {
                grid-template-columns: 1fr;
                gap: 8px;
            }
            
            .footer-logo-text {
                font-size: 0.9rem;
            }
            
            .footer-copyright {
                font-size: 0.75rem;
            }
        }
        
        /* Landscape Mode */
        @media (max-height: 500px) and (orientation: landscape) {
            .footer-modern {
                padding: 1rem 0 !important;
                margin-top: 1.5rem !important;
            }
        }
        
        /* Smooth Transitions for Theme */
        .footer-modern,
        .footer-logo-text,
        .footer-copyright a,
        .footer-links a {
            transition: all 0.3s ease;
        }
    </style>
    
    <div class="container text-center">
        <div class="footer-content">
            <div class="footer-logo">
                <div class="footer-logo-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <div class="footer-logo-text">Divisi Operasional & Produksi</div>
            </div>
            
            <div class="footer-divider"></div>
            
            <div class="footer-copyright">
                <span>Copyright &copy; <?= Date('Y') ?></span>
                <a href="<?= base_url('/') ?>">Annas Fazrul Farras</a>
                <span>| Semua Hak Dilindungi</span>
            </div>
            
            <div class="footer-links">
                <a href="<?= base_url('about') ?>">Tentang Kami</a>
                <a href="<?= base_url('contact') ?>">Kontak</a>
                <a href="<?= base_url('faqs') ?>">FAQ</a>
            </div>
        </div>
    </div>
</footer>