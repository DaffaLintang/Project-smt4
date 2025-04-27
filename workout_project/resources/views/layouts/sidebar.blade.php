<div class="d-flex flex-column p-3 sidebar" style="width: 250px; height: 100vh; background-color: #f8f9fa;">
    <h5 class="text-center fw-bold text-dark mb-4">Smart Workout</h5>

    <div class="mb-2">
    <a class="d-flex justify-content-between align-items-center text-secondary text-decoration-none mt-3" data-bs-toggle="collapse" href="#dashboardMenu">
    <span class="fw-bold">DASHBOARD</span>
    <i class="bi bi-chevron-down"></i>
    </a>
        <div class="mb-2">
    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-secondary text-decoration-none py-2">
        <i class="bi bi-fire me-2"></i> <span>Dashboard</span>
    </a>
</div>
    </div>

<div class="mb-2">
    <a class="d-flex justify-content-between align-items-center text-secondary text-decoration-none" data-bs-toggle="collapse" href="#dataMasterMenu">
        <span class="fw-bold">DATA MASTER</span>
        <i class="bi bi-chevron-down"></i>
    </a>
    <div class="collapse" id="dataMasterMenu">
        <a href="{{ route('admin.users') }}" class="d-flex align-items-center text-secondary text-decoration-none py-2">
            <i class="bi bi-people me-2"></i> Manajemen Pengguna
        </a>
        <a href="{{ route('admin.latihan') }}" class="d-flex align-items-center text-secondary text-decoration-none py-2">
            <i class="bi bi-graph-up-arrow"></i> Manajemen Latihan
        </a>
        <a href="{{ route('admin.results') }}" class="d-flex align-items-center text-secondary text-decoration-none py-2">
            <i class="bi bi-check2-circle"></i> Manajemen Result
        </a>
        <a href="{{ route('admin.workouts') }}" class="d-flex align-items-center text-secondary text-decoration-none py-2">
            <i class="bi bi-lightbulb"></i> Manajemen Rekomendasi Workout
        </a>
        <a href="{{ route('admin.bmi') }}" class="d-flex align-items-center text-secondary text-decoration-none py-2">
    <i class="bi bi-activity"></i> Manajemen BMI
</a>


    </div>
</div>


    <div class="mb-2">
        <a class="d-flex justify-content-between align-items-center text-secondary text-decoration-none" data-bs-toggle="collapse" href="#settingMenu">
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