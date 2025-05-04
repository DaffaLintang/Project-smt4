@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #f8f9fa; }
        .card-icon { font-size: 30px; color:rgb(154, 0, 0); }
        .card { border-left: 4px solidrgb(255, 250, 250);
                margin-bottom: 20px; /* Add margin between cards for better mobile spacing */
        }
        .stat-box h4 {
            font-size: 1.2rem; /* Adjust font size for smaller screens */
            margin-bottom: 0.5rem;
        }
        .stat-box p {
            font-size: 0.9rem; /* Adjust font size for smaller screens */
        }
        .chart-container {
            margin-bottom: 20px; /* Add margin below charts */
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .col-md-6 {
                margin-bottom: 20px; /* Add margin between chart columns on small screens */
            }
            .card-icon {
                font-size: 24px; /* Smaller icon on very small screens */
            }
            .stat-box h4 {
                font-size: 1rem;  /* Further reduce heading size on very small screens */
            }
            .stat-box p {
                font-size: 0.8rem;  /* Further reduce paragraph size */
            }
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Dashboard</h2>
    <div class="row">
        <div class="col-md-3 col-sm-6"> <div class="card p-3 stat-box">
                <i class="fa-solid fa-users card-icon"></i>
                <h4>{{ $totalUsers }}</h4>
                <p>Total User</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card p-3 stat-box">
                <i class="fa-solid fa-dumbbell card-icon"></i>
                <h4>{{ $totalWorkouts }}</h4>
                <p>Data Workout</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card p-3 stat-box">
                <i class="fa-solid fa-weight-scale card-icon"></i>
                <h4>{{ $totalBMI }}</h4>
                <p>Data BMI</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card p-3 stat-box">
                <i class="fa-solid fa-person-running card-icon"></i>
                <h4>{{ $totalResults }}</h4>
                <p>Total Input Workout</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="chart-container">
                <h5>Pengguna Aktif Bulanan</h5>
                <canvas id="userChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-container">
                <h5>Distribusi Level Kesulitan Latihan</h5>
                <canvas id="workoutChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx1 = document.getElementById('userChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
            datasets: [{
                label: 'Total Pengguna',
                data: [30, 15, 90, 10, 70, 80, 90, 100],
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 0, 255, 0.2)',
                fill: true
            }]
        },
        options: {
            responsive: true, // Enable chart responsiveness
            maintainAspectRatio: true, // Maintain aspect ratio
            plugins: {
                legend: {
                    position: 'bottom', // Reposition legend for better mobile view
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: false,  // Remove x-axis title on small screens if needed
                        text: 'Bulan'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: false, // Remove y-axis title on small screens if needed
                        text: 'Jumlah Pengguna'
                    },
                    beginAtZero: true
                }
            }
        }
    });

    const ctx2 = document.getElementById('workoutChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
            datasets: [{
                label: 'Latihan',
                data: [10, 20, 30, 40, 50, 60, 70],
                backgroundColor: 'blue'
            }]
        },
        options: {
            responsive: true,  // Enable chart responsiveness.
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom', //  Move legend to the bottom
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: false,
                        text: 'Hari'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: false,
                        text: 'Jumlah Latihan'
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
@endsection
