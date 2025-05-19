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
                margin-bottom: 20px;  
        }
        .stat-box h4 {
            font-size: 1.2rem;  
            margin-bottom: 0.5rem;
        }
        .stat-box p {
            font-size: 0.9rem;  
        }
        .chart-container {
            margin-bottom: 20px;  
        }

         
        @media (max-width: 768px) {
            .col-md-6 {
                margin-bottom: 20px; 
            }
            .card-icon {
                font-size: 24px;  
            }
            .stat-box h4 {
                font-size: 1rem; 
            }
            .stat-box p {
                font-size: 0.8rem; 
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    document.addEventListener('DOMContentLoaded', function () {
    @if (session('register_success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: @json(session('register_success')),
            timer: 2500,
            showConfirmButton: false
        });
    @endif
});
fetch('/workout-distribution')
    .then(response => response.json())
    .then(data => {
        const ctx = document.getElementById('workoutChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Beginner', 'Intermediate', 'Expert'],
                datasets: [{
                    data: [data.Beginner, data.Intermediate, data.Expert],
                    backgroundColor: ['green', 'orange', 'red']
                }]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 1000,
                    easing: 'easeOutBounce'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.6)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                    }
                }
            }
        });
    });
</script>


</body>
</html>
@endsection
