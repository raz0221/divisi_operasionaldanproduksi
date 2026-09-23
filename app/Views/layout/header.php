<header class="jumbotron jumbotron-fluid">
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
            --header-accent: #1a73e8; /* Changed from yellow to blue */
            
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
            --header-accent: #4285f4; /* Dark mode blue accent */
            
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
        
        /* Header Styles */
        .jumbotron-fluid {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
            color: var(--white);
            padding: 2rem 0 !important;
            margin: 0;
            box-shadow: 0 4px 12px var(--shadow-color);
            position: relative;
            overflow: hidden;
            border-bottom: 3px solid var(--header-accent); /* Blue border instead of yellow */
        }
        
        .jumbotron-fluid::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(26, 115, 232, 0.1) 0%, transparent 40%), /* Blue gradient */
                radial-gradient(circle at 80% 70%, rgba(52, 152, 219, 0.1) 0%, transparent 40%);
            pointer-events: none;
        }
        
        .jumbotron-fluid .container {
            position: relative;
            z-index: 2;
            padding: 0 15px;
        }
        
        .jumbotron-fluid .row {
            margin: 0;
        }
        
        .jumbotron-fluid .col-md-12 {
            padding: 0;
            position: relative;
        }
        
        .jumbotron-fluid h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: clamp(1.5rem, 4vw, 2.2rem);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin: 0 0 0.5rem 0;
            line-height: 1.3;
            color: var(--white);
            text-align: center;
        }
        
        .header-subtitle {
            font-family: 'Open Sans', sans-serif;
            font-weight: 300;
            font-size: clamp(0.9rem, 2.5vw, 1.1rem);
            opacity: 0.95; /* Brighter subtitle */
            line-height: 1.5;
            text-align: center;
            max-width: 800px;
            margin: 0 auto 1rem auto;
            padding: 0 10px;
            color: rgba(255, 255, 255, 0.95); /* Brighter text */
        }
        
        .portal-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: clamp(0.75rem, 2vw, 0.85rem);
            font-weight: 600;
            margin: 0.5rem auto 0 auto;
            color: var(--white);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            text-align: center;
            width: fit-content;
        }
        
        .portal-badge i {
            font-size: 0.9em;
            color: var(--header-accent); /* Blue icon */
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .jumbotron-fluid {
                padding: 1.5rem 0 !important;
            }
            
            .jumbotron-fluid h1 {
                padding: 0 10px;
                margin-bottom: 0.8rem;
            }
            
            .header-subtitle {
                padding: 0 15px;
                margin-bottom: 1.2rem;
            }
            
            .portal-badge {
                padding: 6px 12px;
                flex-wrap: wrap;
            }
        }
        
        @media (max-width: 480px) {
            .jumbotron-fluid {
                padding: 1.2rem 0 !important;
            }
            
            .jumbotron-fluid h1 {
                font-size: 1.3rem;
                margin-bottom: 0.6rem;
            }
            
            .header-subtitle {
                font-size: 0.85rem;
                margin-bottom: 1rem;
            }
            
            .portal-badge {
                font-size: 0.7rem;
                padding: 5px 10px;
            }
        }
        
        @media (max-width: 360px) {
            .jumbotron-fluid h1 {
                font-size: 1.2rem;
            }
            
            .header-subtitle {
                font-size: 0.8rem;
            }
            
            .portal-badge {
                font-size: 0.65rem;
            }
        }
        
        /* Landscape Mode */
        @media (max-height: 500px) and (orientation: landscape) {
            .jumbotron-fluid {
                padding: 1rem 0 !important;
            }
            
            .jumbotron-fluid h1 {
                margin-bottom: 0.4rem;
            }
            
            .header-subtitle {
                margin-bottom: 0.5rem;
            }
        }
        
        /* Smooth Transitions for Theme */
        .jumbotron-fluid, 
        .jumbotron-fluid h1, 
        .header-subtitle,
        .portal-badge {
            transition: all 0.3s ease;
        }
    </style>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h1">Divisi Operasional & Produksi</h1>
                <p class="header-subtitle">Informasi terkini seputar operasional dan produksi perusahaan</p>
                <div class="portal-badge">
                    <i class="fas fa-industry"></i>
                    <span>Sistem Terintegrasi Operasional & Produksi</span>
                </div>
            </div>
        </div>
    </div>
</header>