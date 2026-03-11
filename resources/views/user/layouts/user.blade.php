<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - JokiDesainSaja</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-bg: #0f172a; /* Slate 900 */
            --body-bg: #020617;    /* Slate 950 */
            --card-bg: #1e293b;    /* Slate 800 */
            --accent-color: #facc15; /* Yellow 400 */
            --border-color: rgba(255, 255, 255, 0.08);
            --text-muted: #94a3b8;
        }
        
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: var(--body-bg);
            color: #f1f5f9;
            min-height: 100vh;
        }

        /* === Sidebar Fixed Style === */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            
            /* Sidebar Diam */
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            height: 100vh;
            z-index: 1030;
        }

        .sidebar .nav-link {
            color: var(--text-muted);
            font-size: 0.95rem;
            padding: 0.75rem 1.25rem;
            margin: 0.2rem 0.8rem;
            border-radius: 10px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(250, 204, 21, 0.1);
            color: var(--accent-color) !important;
            transform: translateX(4px);
        }

        .sidebar .nav-link.active {
            background-color: var(--accent-color);
            color: #0f172a !important;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(250, 204, 21, 0.3);
        }

        .sidebar .nav-link i {
            font-size: 1.25rem;
            margin-right: 12px;
        }

        /* === Main Content Adjustment === */
        #main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            
            /* Ruang agar tidak tertutup sidebar fixed */
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            background-color: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            height: 70px;
        }

        /* Responsif untuk Mobile */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            #main-content {
                margin-left: 0;
            }
            .offcanvas.sidebar {
                transform: translateX(0);
                position: fixed;
            }
        }

        /* === Card Modern Style === */
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        /* === Custom Components === */
        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid var(--border-color);
        }

        .search-input {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid var(--border-color) !important;
            color: white !important;
            border-radius: 10px;
            padding-left: 40px;
        }
    </style>
</head>
<body class="d-flex">

    {{-- Sidebar Fixed --}}
    <aside class="sidebar d-none d-lg-flex flex-column py-4 shadow">
        <div class="px-4 mb-4">
            <a href="{{ route('user.dashboard') }}" class="text-decoration-none d-flex align-items-center">
                <div class="bg-warning rounded-3 p-2 me-2">
                    <i class="bi bi-lightning-charge-fill text-dark fs-5"></i>
                </div>
                <span class="fs-4 fw-bold text-white tracking-tight">JokiDesain</span>
            </a>
        </div>
        <div class="flex-grow-1 overflow-auto">
            @include('user.partials.sidebar-menu')
        </div>
    </aside>

    {{-- Mobile Offcanvas --}}
    <div class="offcanvas offcanvas-start sidebar p-3" tabindex="-1" id="sidebarMenu">
        <div class="offcanvas-header mb-3">
            <h5 class="offcanvas-title fw-bold text-warning">Menu Navigasi</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            @include('user.partials.sidebar-menu')
        </div>
    </div>
    
    <div id="main-content">
        {{-- Topbar Sticky --}}
        <nav class="navbar navbar-expand sticky-top topbar px-4">
            <div class="container-fluid p-0">
                <button class="btn d-lg-none text-white p-0 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
                    <i class="bi bi-text-left fs-2"></i>
                </button>
                
                <div class="position-relative d-none d-md-block">
                    <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                    <input class="form-control search-input shadow-none" type="search" placeholder="Cari data portofolio...">
                </div>
                
                <div class="dropdown ms-auto">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        <div class="text-end me-3 d-none d-sm-block">
                            <p class="mb-0 fw-semibold small text-white">{{ Auth::user()->name }}</p>
                            <span class="badge bg-soft-warning text-warning border border-warning" style="font-size: 0.65rem; background: rgba(250,204,21,0.1)">USER PRO</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=facc15&color=0f172a" alt="avatar" class="avatar shadow-sm">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end border-0 shadow-lg mt-3 p-2" style="background: #1e293b; border-radius: 12px;">
                        <li><a class="dropdown-item py-2 rounded-2" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item py-2 rounded-2" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider opacity-10"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 rounded-2 text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container-fluid p-4 p-lg-5">
            @yield('content')
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>