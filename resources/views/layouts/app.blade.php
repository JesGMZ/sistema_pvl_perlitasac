<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Sistema Vaso de Leche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #0d6efd;
            --sidebar-width: 250px;
            --topbar-height: 60px;
            --body-bg: #f8f9fa;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            overflow-x: hidden;
        }

        /* Layout */
        #layoutSidenav {
            display: flex;
            position: fixed;
            top: var(--topbar-height);
            left: 0;
            right: 0;
            bottom: 0;
        }

        #layoutSidenav_nav {
            flex-basis: var(--sidebar-width);
            flex-shrink: 0;
            transition: transform .15s ease-in-out;
            z-index: 1038;
        }

        #layoutSidenav_content {
            position: relative;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            min-height: calc(100vh - var(--topbar-height));
            margin-left: var(--sidebar-width);
            transition: margin .15s ease-in-out;
            padding: 1.5rem;
            background-color: var(--body-bg);
        }

        /* Topbar */
        .sb-topnav {
            height: var(--topbar-height);
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1039;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .sb-topnav .navbar-brand {
            font-size: 1.2rem;
            font-weight: 500;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* Sidebar */
        .sb-sidenav {
            display: flex;
            flex-direction: column;
            height: 100%;
            background: #fff;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .sb-sidenav .sb-sidenav-menu {
            flex-grow: 1;
            padding: 1rem 0;
        }

        .sb-sidenav .nav-link {
            color: #495057;
            padding: 0.75rem 1.25rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sb-sidenav .nav-link:hover {
            color: var(--primary-color);
            background-color: rgba(13, 110, 253, 0.05);
            border-left-color: var(--primary-color);
        }

        .sb-sidenav .nav-link.active {
            color: var(--primary-color);
            background-color: rgba(13, 110, 253, 0.1);
            border-left-color: var(--primary-color);
            font-weight: 500;
        }

        .sb-sidenav .sb-nav-link-icon {
            width: 1.5rem;
            margin-right: 0.75rem;
            color: inherit;
            font-size: 0.9rem;
        }

        .sb-sidenav-footer {
            padding: 0.75rem 1.25rem;
            background-color: #fff;
            border-top: 1px solid #e9ecef;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sb-topnav .navbar-brand {
                width: auto;
            }

            #layoutSidenav_nav {
                transform: translateX(-100%);
            }

            #layoutSidenav_content {
                margin-left: 0;
            }

            .sb-sidenav-toggled #layoutSidenav_nav {
                transform: translateX(0);
            }

            .sb-sidenav-toggled #layoutSidenav_content {
                margin-left: var(--sidebar-width);
            }
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <a class="navbar-brand ps-3" href="#">
            <i class="fas fa-glass-water me-2"></i>
            Vaso de Leche
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="d-none d-md-flex ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Buscar..." />
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i>Perfil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Configuración</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link {{ Request::is('municipalidad*') ? 'active' : '' }}" href="{{ route('municipalidad.mostrar') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                            Municipalidad
                        </a>
                        <a class="nav-link {{ Request::is('categoria*') ? 'active' : '' }}" href="{{ route('categoria.mostrar') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Categorías
                        </a>
                        <a class="nav-link {{ Request::is('beneficiario*') ? 'active' : '' }}" href="{{ route('beneficiario.mostrar') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Beneficiarios
                        </a>
                        <a class="nav-link {{ Request::is('comite*') ? 'active' : '' }}" href="{{ route('comite.mostrar') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Comités
                        </a>
                        <a class="nav-link {{ Request::is('producto*') ? 'active' : '' }}" href="{{ route('producto.mostrar') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Productos
                        </a>
                        <a class="nav-link {{ Request::is('pvl*') ? 'active' : '' }}" href="{{ route('programa.mostrar') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                            Programa VL
                        </a>
                        <a class="nav-link {{ Request::is('detalle*') ? 'active' : '' }}" href="{{ route('detalle-programa.mostrar') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                            Detalle Programa
                        </a>
                        <a class="nav-link {{ Request::is('stock*') ? 'active' : '' }}" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                            Stocks
                        </a>
                        <a class="nav-link {{ Request::is('usuario*') ? 'active' : '' }}" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Usuarios
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Sistema</div>
                    Vaso de Leche
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Sistema Vaso de Leche 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
