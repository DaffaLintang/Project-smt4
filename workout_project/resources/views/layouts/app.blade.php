<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Smart Workout</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            background: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            top: 0;
            left: -250px;
            overflow-y: auto;
            transition: left 0.3s ease;
            z-index: 1050;
            border-right: 1px solid #ddd;
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar h5 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 40px;
            margin-top: 30px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #888;
            padding: 10px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a.active,
        .sidebar a.active i {
            color: #9F0000;
            font-weight: bold;
        }

        .sidebar a:hover,
        .sidebar a:hover i {
            color: #9F0000;
        }

        .content {
            margin-left: 250px;
            padding: 0;
            width: calc(100% - 250px);
            min-height: 100vh;
            background: white;
        }

        .navbar-custom {
            background-color: #9F0000;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            display: none;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .dropdown-menu {
            right: 0;
            left: auto;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1040;
        }

        .overlay.show {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.open {
                left: 0;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }

            .menu-btn {
                display: block;
            }
        }

        @media (min-width: 992px) {
            .sidebar {
                left: 0;
            }

            .overlay {
                display: none !important;
            }

            .content {
                margin-left: 250px;
                width: calc(100% - 250px);
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar-custom">
        <button onclick="toggleSidebar()" class="menu-btn">
            <i class="fas fa-bars"></i>
        </button>

        @php
            $user = Auth::user();
        @endphp

        <div class="dropdown user-profile ms-auto">
            @if ($user && $user->image)
                <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Profil" class="rounded-circle">
            @else
                <img src="{{ asset('images/default.png') }}" alt="Default" class="rounded-circle">
            @endif

            <a class="text-white text-decoration-none dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('admin.users') }}">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- OVERLAY -->
    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <!-- WRAPPER -->
    <div class="wrapper d-flex">
        <!-- SIDEBAR -->
        <div id="sidebar" class="sidebar bg-light">
            <h5>Smart Workout</h5>

            <!-- DASHBOARD -->
            <div class="mb-2">
                <a class="d-flex justify-content-between align-items-center text-secondary text-decoration-none mt-3"
                   data-bs-toggle="collapse" href="#dashboardMenu" role="button"
                   aria-expanded="{{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }}"
                   aria-controls="dashboardMenu">
                    <span class="fw-bold">DASHBOARD</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('admin.dashboard') ? 'show' : '' }}" id="dashboardMenu">
                    <a href="{{ route('admin.dashboard') }}"
                       class="d-flex align-items-center text-decoration-none py-2 {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-secondary' }}">
                        <i class="bi bi-fire me-2"></i> Dashboard
                    </a>
                </div>
            </div>

            <!-- DATA MASTER -->
            <div class="mb-2">
                <a class="d-flex justify-content-between align-items-center text-secondary text-decoration-none"
                   data-bs-toggle="collapse" href="#dataMasterMenu" role="button"
                   aria-expanded="{{ request()->is('admin/users*') || request()->is('admin/latihan*') || request()->is('admin/results*') || request()->is('admin/workouts*') || request()->is('admin/bmi*') ? 'true' : 'false' }}"
                   aria-controls="dataMasterMenu">
                    <span class="fw-bold">DATA MASTER</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('admin/users*') || request()->is('admin/latihan*') || request()->is('admin/results*') || request()->is('admin/workouts*') || request()->is('admin/bmi*') ? 'show' : '' }}" id="dataMasterMenu">
                    <a href="{{ route('admin.users') }}" class="d-flex align-items-center text-decoration-none py-2 {{ request()->routeIs('admin.users') ? 'active' : 'text-secondary' }}">
                        <i class="bi bi-people me-2"></i> Manajemen Pengguna
                    </a>
                    <a href="{{ route('admin.latihan') }}" class="d-flex align-items-center text-decoration-none py-2 {{ request()->routeIs('admin.latihan') ? 'active' : 'text-secondary' }}">
                        <i class="bi bi-graph-up-arrow me-2"></i> Manajemen Latihan
                    </a>
                    <a href="{{ route('admin.results') }}" class="d-flex align-items-center text-decoration-none py-2 {{ request()->routeIs('admin.results') ? 'active' : 'text-secondary' }}">
                        <i class="bi bi-check2-circle me-2"></i> Manajemen Result
                    </a>
                    <a href="{{ route('admin.workouts') }}" class="d-flex align-items-center text-decoration-none py-2 {{ request()->routeIs('admin.workouts') ? 'active' : 'text-secondary' }}">
                        <i class="bi bi-lightbulb me-2"></i> Manajemen Workout
                    </a>
                    <a href="{{ route('admin.bmi') }}" class="d-flex align-items-center text-decoration-none py-2 {{ request()->routeIs('admin.bmi') ? 'active' : 'text-secondary' }}">
                        <i class="bi bi-activity me-2"></i> Manajemen BMI
                    </a>
                </div>
            </div>

            <!-- SETTING -->
            <div class="mb-2">
                <a class="d-flex justify-content-between align-items-center text-secondary text-decoration-none"
                   data-bs-toggle="collapse" href="#settingMenu" role="button" aria-expanded="false" aria-controls="settingMenu">
                    <span class="fw-bold">SETTING</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="collapse" id="settingMenu">
                    <a href="#" class="d-flex align-items-center text-secondary text-decoration-none py-2">
                        <i class="bi bi-gear me-2"></i> Manajemen Admin
                    </a>
                </div>
            </div>
        </div>

        <!-- KONTEN -->
        <div class="content p-4">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('login_success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session("login_success") }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '{{ $errors->first("email") }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        }
    </script>
    @stack('scripts')
</body>
</html>
