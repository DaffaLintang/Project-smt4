<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
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
        .stat-box {
            box-shadow: 4px 4px 4px #9F0000; /* Efek bayangan merah ke kanan */
            border-radius: 8px; /* Membuat sudut lebih halus */
            text-align: left; /* Membuat isi di tengah */
            background-color: white; /* Pastikan background tetap putih */
            transition: 0.3s ease-in-out; /* Animasi efek hover */
        }

        .stat-box:hover {
            box-shadow: 5px 5px 5px #9F0000; /* Efek bayangan lebih tebal saat hover */
        }

        body {
            display: flex; /* Menggunakan flexbox untuk tata letak sidebar dan content */
            background-color: #f0f0f0;
        }
        .sidebar {
            width: 250px; /* Menggunakan lebar awal sidebar Anda */
            height: 100vh;
            background: white;
            padding: 20px;
            border-right: 1px solid #ddd;
            position: fixed; /* Sidebar tetap di tempat saat di-scroll */
            overflow-y: auto; /* Jika konten sidebar melebihi tinggi layar, bisa di-scroll */
        }
        .sidebar h4 {
            text-align: center;
            font-weight: bold;
        }

        .sidebar h5 {
            margin-bottom: 50px; /* Menambahkan jarak bawah */
            padding-bottom: 30px; /* Tambahan padding agar lebih proporsional */
            padding-top: 45px; /* Menurunkan tulisan */
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #888888;
            padding: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: normal;
            transition: color 0.3s ease, font-weight 0.3s ease;
        }
        .sidebar a i {
            margin-right: 10px;
            color: #888888;
        }
        .sidebar a.active, .sidebar a.active i {
            color: #9F0000 !important;
            font-weight: bold;
        }
        .sidebar a:hover, .sidebar a:hover i {
            color: #9F0000 !important;
        }
        .content {
            margin-left: 250px; /* Memberikan ruang di sisi kiri untuk sidebar */
            padding: 0;
            width: calc(100% - 250px); /* Lebar konten menyesuaikan lebar layar dikurangi sidebar */
            background: white;
            min-height: 100vh;
        }
        .navbar-custom {
            background-color: #9F0000;
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

        /* Media query untuk tampilan seluler (lebar maksimum 768px) */
        @media (max-width: 768px) {
            .sidebar {
                position: static !important; /* Sidebar tidak fixed di seluler */
                width: 100% !important; /* Sidebar mengambil seluruh lebar */
                height: auto !important; /* Tinggi sidebar menyesuaikan konten */
                border-right: none !important; /* Hilangkan border kanan */
                margin-bottom: 20px; /* Berikan jarak dengan konten */
                overflow-y: visible !important; /* Tampilkan semua konten sidebar */
            }
            .content {
                margin-left: 0 !important; /* Konten dimulai dari kiri */
                width: 100% !important; /* Konten mengambil seluruh lebar */
                padding-top: 0 !important; /* Reset padding atas */
            }
            body {
                display: block !important; /* Kembali ke display block untuk tata letak vertikal default */
            }
        }
    </style>
</head>
<body>

    @include('layouts.sidebar')

    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-custom d-flex justify-content-end px-3">
            <div class="dropdown user-profile d-flex align-items-center">
                <img src="{{ asset('images/profile.jpg') }}" alt="User" class="rounded-circle me-2" width="40">
                <a class="text-white text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
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

        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>