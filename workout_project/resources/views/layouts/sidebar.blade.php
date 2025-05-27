<!-- NAVBAR (Tambahkan ini di bagian atas halaman) -->
<nav class="navbar-custom">
    <button onclick="toggleSidebar()" class="menu-btn" style="background:none; border:none; color:white;">
        <i class="fas fa-bars"></i>
    </button>
    <span class="text-white">Smart Workout</span>
</nav>

<!-- OVERLAY -->
<div id="overlay" class="overlay" onclick="closeSidebar()"></div>

<!-- SIDEBAR -->
<div id="sidebar" class="sidebar bg-light">
    <!-- Sidebar Content -->
    <h5 class="text-center fw-bold text-dark mb-4">Smart Workout</h5>

    <!-- DASHBOARD Section -->
    <div class="mb-2">
        <a class="d-flex justify-content-between align-items-center text-secondary text-decoration-none mt-3"
           data-bs-toggle="collapse" href="#dashboardMenu" role="button" aria-expanded="false" aria-controls="dashboardMenu">
            <span class="fw-bold">DASHBOARD</span>
            <i class="bi bi-chevron-down"></i>
        </a>
        <div class="collapse show" id="dashboardMenu">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-secondary text-decoration-none py-2">
                <i class="bi bi-fire me-2"></i> <span>Dashboard</span>
            </a>
        </div>
    </div>

    <!-- DATA MASTER Section -->
    <div class="mb-2">
        <a class="d-flex justify-content-between align-items-center text-secondary text-decoration-none"
           data-bs-toggle="collapse" href="#dataMasterMenu" role="button" aria-expanded="false" aria-controls="dataMasterMenu">
            <span class="fw-bold">DATA MASTER</span>
            <i class="bi bi-chevron-down"></i>
        </a>
        <div class="collapse" id="dataMasterMenu">
            <a href="{{ route('admin.users') }}" class="d-flex align-items-center text-secondary text-decoration-none py-2">
                <i class="bi bi-people me-2"></i> Manajemen Pengguna
            </a>
            <!-- Lainnya... -->
        </div>
    </div>

    <!-- SETTING Section -->
    <div class="mb-2">
        <a class="d-flex justify-content-between align-items-center text-secondary text-decoration-none"
           data-bs-toggle="collapse" href="#settingMenu" role="button" aria-expanded="false" aria-controls="settingMenu">
            <span class="fw-bold">SETTING</span>
            <i class="bi bi-chevron-down"></i>
        </a>
        <div class="collapse" id="settingMenu">
            <a href="#" class="d-flex align-items-center text-secondary text-decoration-none py-2">
                <i class="bi bi-people me-2"></i> Manajemen Admin
            </a>
        </div>
    </div>
</div>