<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema PVL - @yield('title')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Variables */
        :root {
            --sidebar-width: 250px;
            --sidebar-width-collapsed: 70px;
            --topbar-height: 60px;
            --primary-blue: #1976d2;
            --primary-dark: #1565c0;
            --white: #ffffff;
        }

        /* Topbar styles */
        .topbar {
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            height: var(--topbar-height);
            background: var(--primary-blue);
            color: var(--white);
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            z-index: 1000;
            padding: 0 1.5rem;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed ~ .topbar {
            left: var(--sidebar-width-collapsed);
        }

        .topbar .search-box {
            width: 300px;
        }

        .topbar .search-box .form-control {
            padding: 0.5rem 2.5rem 0.5rem 1rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--white);
            transition: all 0.3s ease;
        }

        .topbar .search-box .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .topbar .search-box .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.1);
        }

        .topbar .search-box .fa-search {
            color: rgba(255, 255, 255, 0.7);
        }

        .topbar .btn-link {
            color: var(--white);
            text-decoration: none;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }

        .topbar .btn-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--primary-blue);
            color: var(--white);
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .sidebar.collapsed {
            width: var(--sidebar-width-collapsed);
        }

        .sidebar .navbar-brand {
            color: var(--white);
            padding: 1rem;
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            background: var(--primary-dark);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
        }

        .sidebar .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 1rem;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
            font-size: 1.25rem;
        }

        /* Main content adjustments */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 2rem;
            min-height: calc(100vh - var(--topbar-height));
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-width-collapsed);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.collapsed {
                transform: translateX(0);
                width: var(--sidebar-width);
            }

            .topbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .topbar .search-box {
                width: 200px;
            }
        }
    </style>
</head>
<body>
    <!-- Topbar -->
    <nav class="topbar">
        <div class="container-fluid h-100">
            <div class="d-flex justify-content-between align-items-center h-100">
                <!-- Left side -->
                <div class="d-flex align-items-center">
                    <button id="sidebarToggle" class="btn btn-link">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="search-box ms-3">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Buscar...">
                            <i class="fas fa-search position-absolute top-50 end-0 translate-middle-y me-2"></i>
                        </div>
                    </div>
                </div>

                <!-- Right side -->
                <div class="d-flex align-items-center">
                    <!-- Notifications -->
                    <div class="dropdown me-3">
                        <button class="btn btn-link position-relative" type="button" id="notificationsDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                2
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                            <li><h6 class="dropdown-header">Notificaciones</h6></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-plus me-2"></i>Nuevo beneficiario registrado</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-box me-2"></i>Actualización de stock</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center" href="#"><i class="fas fa-bell me-2"></i>Ver todas</a></li>
                        </ul>
                    </div>

                    <!-- User menu -->
                    <div class="dropdown">
                        <button class="btn btn-link d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown">
                            <div class="avatar me-2">
                                <i class="fas fa-user-circle fa-lg"></i>
                            </div>
                            <span class="d-none d-md-block">Administrador</span>
                            <i class="fas fa-chevron-down ms-2"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <i class="fas fa-glass-water me-2"></i>
            Sistema PVL
        </a>
        <nav>
            <ul class="nav flex-column">

                <li class="nav-item">
                    <a href="{{ route('municipalidad.mostrar') }}" class="nav-link">
                        <i class="fas fa-city"></i>
                        Municipalidad
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('categoria.mostrar') }}" class="nav-link">
                        <i class="fas fa-tags"></i>
                        Categorías
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('beneficiario.mostrar') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        Beneficiarios
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('comite.mostrar') }}" class="nav-link">
                        <i class="fas fa-building"></i>
                        Comités
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('producto.mostrar') }}" class="nav-link">
                        <i class="fas fa-box"></i>
                        Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('programa.mostrar') }}" class="nav-link">
                        <i class="fas fa-glass-water"></i>
                        Programa VL
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('socio.mostrar') }}" class="nav-link">
                        <i class="fas fa-user-friends"></i>
                        Socios
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('usuario.mostrar') }}" class="nav-link">
                        <i class="fas fa-user-cog"></i>
                        Usuarios
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')

    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('expanded');
            document.querySelector('.topbar').classList.toggle('expanded');
        });
    </script>
</body>
</html>
