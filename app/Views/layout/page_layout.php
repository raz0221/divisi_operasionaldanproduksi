<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annas</title>
    
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
        
        /* Container styling */
        .container {
            padding-top: 20px;
            padding-bottom: 40px;
        }
        
        /* Card styling */
        .card {
            background: var(--card-bg);
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 4px 15px var(--shadow-color);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px var(--shadow-color);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            border-radius: 12px 12px 0 0 !important;
            border: none;
            padding: 15px 20px;
        }
        
        .card-body {
            padding: 20px;
            color: var(--text-primary);
        }
        
        /* Button styling */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
        }
        
        /* Table styling */
        .table {
            background: var(--card-bg);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px var(--shadow-color);
        }
        
        .table th {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            border: none;
            padding: 12px 15px;
        }
        
        .table td {
            padding: 12px 15px;
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: var(--bg-secondary);
        }
        
        /* Alert styling */
        .alert {
            border-radius: 8px;
            border: none;
            font-size: 14px;
            padding: 12px 16px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: #e8f8ef;
            color: #27ae60;
            border-left: 3px solid #27ae60;
        }
        
        .alert-danger {
            background: #ffeaea;
            color: #e74c3c;
            border-left: 3px solid #e74c3c;
        }
        
        [data-theme="dark"] .alert-success {
            background: #2a4433;
            color: #6bff9a;
            border-left: 3px solid #6bff9a;
        }
        
        [data-theme="dark"] .alert-danger {
            background: #442a2a;
            color: #ff6b6b;
            border-left: 3px solid #ff6b6b;
        }
        
        /* Form styling */
        .form-control {
            border: 1.5px solid var(--border-color);
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 14px;
            transition: all 0.2s ease;
            background: var(--card-bg);
            color: var(--text-primary);
        }
        
        .form-control:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.1);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
            font-size: 14px;
        }
        
        /* Theme transition */
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
        
        /* Content section */
        .content-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px var(--shadow-color);
            margin-bottom: 30px;
        }
        
        /* Pagination */
        .pagination .page-link {
            color: var(--primary-blue);
            background: var(--card-bg);
            border: 1.5px solid var(--border-color);
            margin: 0 3px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        
        .pagination .page-link:hover {
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
            color: white;
            border-color: transparent;
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
            border-color: transparent;
            color: white;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .content-section {
                padding: 15px;
            }
            
            .card-body {
                padding: 15px;
            }
        }
    </style>
</head>

<body data-theme="light">
    
    <?= $this->include('layout/navbar') ?>
    <?= $this->include('layout/header') ?>
    
    <div class="container">
        <?= $this->renderSection('content') ?>
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
            
            // Apply theme to existing elements
            applyThemeStyles();
        });
        
        function applyThemeStyles() {
            // Apply theme to all cards
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.style.backgroundColor = getComputedStyle(document.documentElement)
                    .getPropertyValue('--card-bg').trim();
                card.style.borderColor = getComputedStyle(document.documentElement)
                    .getPropertyValue('--border-color').trim();
            });
            
            // Apply theme to all text elements
            const textElements = document.querySelectorAll('p, span, div:not(.card-header):not(.btn):not(.alert)');
            textElements.forEach(el => {
                if (!el.closest('.card-header')) {
                    el.style.color = getComputedStyle(document.documentElement)
                        .getPropertyValue('--text-primary').trim();
                }
            });
        }
        
        // Re-apply theme when it changes
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'data-theme') {
                    applyThemeStyles();
                }
            });
        });
        
        observer.observe(document.body, {
            attributes: true
        });
    </script>

</body>
</html>