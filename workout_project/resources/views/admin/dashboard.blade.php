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
            <div class="card p-4">
                <div class="chart-container" style="height: 400px;">
                    <h5 class="text-center mb-4">Statistik Login Pengguna per Bulan</h5>
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <div class="chart-container" style="height: 400px;">
                    <h5 class="text-center mb-4">Distribusi Level Kesulitan Latihan</h5>
                    <canvas id="workoutChart"></canvas>
                </div>
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

        const userCtx = document.getElementById('userChart').getContext('2d');
        const monthlyUserChart = new Chart(userCtx, {
            type: 'line',
            data: {
                labels: @json($monthlyUserLabels ?? []),
                datasets: [{
                    label: 'Jumlah Login Pengguna',
                    data: @json($monthlyUserData ?? []),
                    borderColor: 'rgb(220, 53, 69)',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    tension: 0,
                    fill: true,
                    pointBackgroundColor: 'rgb(220, 53, 69)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#ddd',
                        borderWidth: 1,
                        padding: 10,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' Login';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
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
                            label: 'Jumlah Workout',
                            data: [data.Beginner, data.Intermediate, data.Expert],
                            backgroundColor: ['#4CAF50', '#FF9800', '#f44336']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                padding: 10
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    font: {
                                        size: 12
                                    }
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        }
                    }
                });
            });
    });
</script>


</body>
</html>
@endsection
