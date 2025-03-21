<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            display: flex;
            background-color: #f0f0f0;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: white;
            padding: 20px;
            border-right: 1px solid #ddd;
            position: fixed;
        }
        .sidebar h4 {
            text-align: center;
            font-weight: bold;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            color: #888888;
            padding: 10px;
            text-decoration: none;
            font-size: 12px;
            font-weight: normal;
            transition: color 0.3s ease, font-weight 0.3s ease;
        }
        .sidebar a i {
            margin-right: 10px;
            color: #888888;
        }
        .sidebar a.active, .sidebar a.active i {
            color: #a50000 !important;
            font-weight: bold;
        }
        .sidebar a:hover, .sidebar a:hover i {
            color: #a50000 !important;
        }
        .content {
            margin-left: 250px;
            padding: 0;
            width: 100%;
            background: white;
            min-height: 100vh;
        }
        .navbar-custom {
            background-color: #a50000;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-profile {
            display: flex;
            align-items: center;
            position: relative;
        }
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid white;
        }
        .dropdown-menu {
            right: 0;
            left: auto;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom d-flex justify-content-end px-3">
            <div class="dropdown user-profile d-flex align-items-center">
                <img src="https://via.placeholder.com/40" alt="User" class="rounded-circle me-2">
                <a class="text-white text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Annisa Nurul Hidayatil Jannah
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                </ul>
            </div>
        </nav>

        <!-- Dynamic Content -->
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
