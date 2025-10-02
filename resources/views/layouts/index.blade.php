<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Dashboard | Laravel CRUD</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
            }

            .sidebar {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 0 20px 20px 0;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                width: 280px;
                min-height: 100vh;
                position: fixed;
                left: 0;
                top: 0;
                z-index: 1000;
                transition: all 0.3s ease;
            }

            .sidebar-header {
                padding: 2rem 1.5rem;
                text-align: center;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            .logo {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #667eea, #764ba2);
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                color: white;
                font-weight: 700;
                font-size: 1.5rem;
            }

            .user-info h4 {
                color: #2d3748;
                font-weight: 600;
                margin-bottom: 0.25rem;
            }

            .user-info span {
                color: #718096;
                font-size: 0.875rem;
            }

            .sidebar-nav {
                padding: 1rem 0;
            }

            .nav-item {
                margin: 0 1rem 0.5rem;
            }

            .nav-link {
                display: flex;
                align-items: center;
                padding: 0.875rem 1rem;
                color: #4a5568;
                text-decoration: none;
                border-radius: 12px;
                transition: all 0.3s ease;
                font-weight: 500;
            }

            .nav-link:hover {
                background: linear-gradient(135deg, #667eea, #764ba2);
                color: white;
                transform: translateX(5px);
            }

            .nav-link.active {
                background: linear-gradient(135deg, #667eea, #764ba2);
                color: white;
                box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            }

            .nav-link i {
                width: 20px;
                margin-right: 0.75rem;
                font-size: 1.1rem;
            }

            .main-content {
                margin-left: 280px;
                min-height: 100vh;
                background: rgba(255, 255, 255, 0.1);
            }

            .top-navbar {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                padding: 1rem 2rem;
                box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 1rem;
                border-radius: 15px;
            }

            .navbar-brand {
                font-weight: 700;
                font-size: 1.25rem;
                color: #2d3748;
            }

            .navbar-actions {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .welcome-text {
                color: #718096;
                font-weight: 500;
            }

            .btn-logout {
                background: linear-gradient(135deg, #ff6b6b, #ee5a52);
                color: white;
                border: none;
                padding: 0.5rem 1rem;
                border-radius: 10px;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .btn-logout:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
                color: white;
            }

            .content-wrapper {
                padding: 2rem;
                min-height: calc(100vh - 120px);
            }

            .footer {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                padding: 1rem 2rem;
                margin: 1rem;
                border-radius: 15px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                color: #718096;
                font-size: 0.875rem;
            }

            /* Mobile Responsive */
            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                }

                .sidebar.show {
                    transform: translateX(0);
                }

                .main-content {
                    margin-left: 0;
                }

                .mobile-toggle {
                    display: block !important;
                }
            }

            .mobile-toggle {
                display: none;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1001;
                background: linear-gradient(135deg, #667eea, #764ba2);
                color: white;
                border: none;
                width: 50px;
                height: 50px;
                border-radius: 12px;
                font-size: 1.2rem;
            }

            /* Card Styles for Content */
            .content-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 20px;
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                margin-bottom: 2rem;
            }

            .stats-card {
                background: linear-gradient(135deg, #667eea, #764ba2);
                color: white;
                border-radius: 15px;
                padding: 1.5rem;
                text-align: center;
                transition: transform 0.3s ease;
            }

            .stats-card:hover {
                transform: translateY(-5px);
            }
        </style>
    </head>

    <body>
        <!-- Mobile Toggle Button -->
        <button class="mobile-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-cube"></i>
                </div>
                <div class="user-info">
                    <h4>Admin User</h4>
                    <span>Administrador</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('clients.index') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>Clientes</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('projects.index') }}" class="nav-link">
                        <i class="fas fa-project-diagram"></i>
                        <span>Proyectos</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('tasks.index') }}" class="nav-link">
                        <i class="fas fa-tasks"></i>
                        <span>Tareas</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <div class="navbar-brand">
                    <i class="fas fa-cube me-2"></i>
                    Laravel CRUD System
                </div>
                <div class="navbar-actions">
                    <span class="welcome-text">Bienvenido al panel de control</span>
                    <a href="#" class="btn-logout">
                        <i class="fas fa-sign-out-alt me-1"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="content-wrapper">
                @include('layouts.partials.messages')
                @yield('content')
            </div>

            <!-- Footer -->
            <div class="footer">
                <div>
                    <strong>Laravel CRUD System</strong> © {{ date('Y') }}
                </div>
                <div>
                    Desarrollado con ❤️ usando Laravel
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            // Toggle sidebar for mobile
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('show');
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                const sidebar = document.getElementById('sidebar');
                const toggleBtn = document.querySelector('.mobile-toggle');

                if (window.innerWidth <= 768 &&
                    !sidebar.contains(e.target) &&
                    !toggleBtn.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            });

            // Active link highlighting
            document.addEventListener('DOMContentLoaded', function() {
                const currentPath = window.location.pathname;
                const navLinks = document.querySelectorAll('.nav-link');

                navLinks.forEach(link => {
                    link.classList.remove('active');

                    if (link.getAttribute('href') === currentPath ||
                        (currentPath === '/' && link.getAttribute('href') === '{{ url("/") }}')) {
                        link.classList.add('active');
                    }
                });
            });

            // Smooth animations
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });

                link.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.transform = 'translateX(0)';
                    }
                });
            });
        </script>
    </body>

</html>
