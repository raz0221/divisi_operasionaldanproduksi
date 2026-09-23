<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divisi Operasional & Produksi</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    
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
            color: var(--text-primary);
            transition: background 0.3s ease, color 0.3s ease;
        }
        
        /* Main content container */
        .container {
            padding-top: 30px;
            padding-bottom: 50px;
        }
        
        /* Post content styling */
        .post-content {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px var(--shadow-color);
            margin-bottom: 30px;
        }
        
        .post-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 28px;
            color: var(--text-primary);
            margin-bottom: 15px;
            line-height: 1.3;
        }
        
        .post-meta {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .post-meta i {
            color: var(--secondary-blue);
            margin-right: 5px;
        }
        
        .post-body {
            font-size: 16px;
            line-height: 1.8;
            color: var(--text-primary);
        }
        
        .post-body p {
            margin-bottom: 20px;
        }
        
        .post-body img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 4px 10px var(--shadow-color);
        }
        
        /* Sidebar styling */
        .sidebar-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px var(--shadow-color);
            margin-bottom: 25px;
        }
        
        .sidebar-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 18px;
            color: var(--text-primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--secondary-blue);
        }
        
        .sidebar-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-list li {
            margin-bottom: 12px;
        }
        
        .sidebar-list a {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            background: var(--bg-secondary);
            border-radius: 6px;
            text-decoration: none;
            color: var(--text-primary);
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar-list a:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateX(5px);
            border-left: 3px solid var(--secondary-blue);
        }
        
        .sidebar-list i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            color: var(--secondary-blue);
        }
        
        .sidebar-list a:hover i {
            color: white;
        }
        
        /* Recent posts widget */
        .recent-post-item {
            display: flex;
            align-items: flex-start;
            padding: 12px;
            background: var(--bg-secondary);
            border-radius: 8px;
            margin-bottom: 12px;
            transition: all 0.2s ease;
        }
        
        .recent-post-item:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateX(5px);
        }
        
        .recent-post-item:hover .recent-post-title,
        .recent-post-item:hover .recent-post-date {
            color: white;
        }
        
        .recent-post-content {
            flex: 1;
        }
        
        .recent-post-title {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-primary);
            margin-bottom: 5px;
            line-height: 1.4;
        }
        
        .recent-post-date {
            font-size: 12px;
            color: var(--text-secondary);
        }
        
        /* Button styling */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
        }
        
        /* Back button */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: transparent;
            border: 1.5px solid var(--primary-blue);
            color: var(--primary-blue);
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
            margin-bottom: 20px;
        }
        
        .btn-back:hover {
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
            color: white;
            border-color: transparent;
            transform: translateY(-1px);
        }
        
        /* Theme transition */
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .post-content {
                padding: 20px;
            }
            
            .post-title {
                font-size: 24px;
            }
            
            .sidebar-section {
                padding: 20px;
            }
            
            .container {
                padding-top: 20px;
                padding-bottom: 30px;
            }
        }
        
        @media (max-width: 576px) {
            .post-content {
                padding: 15px;
            }
            
            .post-title {
                font-size: 20px;
            }
            
            .post-body {
                font-size: 15px;
                line-height: 1.6;
            }
        }
    </style>
</head>

<body data-theme="light">
    
    <?= $this->include('layout/navbar') ?>
    <?= $this->include('layout/header') ?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?= $this->renderSection('content') ?>
            </div>
            <div class="col-md-4">
                <?= $this->include('layout/sidebar') ?>
            </div>
        </div>
    </div>
    
    <?= $this->include('layout/footer') ?>

    <!-- Jquery dan Bootsrap JS -->
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
    
    <script>
        // Theme Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Check for saved theme or prefer-color-scheme
            const savedTheme = localStorage.getItem('theme') || 'light';
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            // Set initial theme
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                document.body.setAttribute('data-theme', 'dark');
            } else {
                document.body.setAttribute('data-theme', 'light');
            }
            
            // Apply theme to sidebar elements
            applyThemeToSidebar();
        });
        
        function applyThemeToSidebar() {
            const sidebarSections = document.querySelectorAll('.sidebar-section');
            const recentPosts = document.querySelectorAll('.recent-post-item');
            const sidebarLinks = document.querySelectorAll('.sidebar-list a');
            
            sidebarSections.forEach(section => {
                section.style.backgroundColor = getComputedStyle(document.documentElement)
                    .getPropertyValue('--card-bg').trim();
            });
            
            recentPosts.forEach(post => {
                post.style.backgroundColor = getComputedStyle(document.documentElement)
                    .getPropertyValue('--bg-secondary').trim();
            });
            
            sidebarLinks.forEach(link => {
                link.style.backgroundColor = getComputedStyle(document.documentElement)
                    .getPropertyValue('--bg-secondary').trim();
            });
        }
        
        // Re-apply theme when it changes
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'data-theme') {
                    setTimeout(applyThemeToSidebar, 100);
                }
            });
        });
        
        observer.observe(document.body, {
            attributes: true
        });
    </script>

</body>
</html>