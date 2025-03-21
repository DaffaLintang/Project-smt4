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
        .card-icon { font-size: 30px; color: #a50000; }
        .card { border-left: 4px solid #a50000; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Dashboard</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card p-3">
                    <i class="fa-solid fa-users card-icon"></i>
                    <h4>3.148</h4>
                    <p>Total User</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <i class="fa-solid fa-dumbbell card-icon"></i>
                    <h4>2.981</h4>
                    <p>Data Workout</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <i class="fa-solid fa-weight-scale card-icon"></i>
                    <h4>100</h4>
                    <p>Total Input BMI</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <i class="fa-solid fa-person-running card-icon"></i>
                    <h4>700</h4>
                    <p>Total Input Workout</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Pengguna Aktif Bulanan</h5>
                <canvas id="userChart"></canvas>
            </div>
            <div class="col-md-6">
                <h5>Distribusi Level Kesulitan Latihan</h5>
                <canvas id="workoutChart"></canvas>
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
                    data: [30, 40, 50, 60, 70, 80, 90, 100],
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0, 0, 255, 0.2)',
                    fill: true
                }]
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
            }
        });
    </script>
</body>
</html>

@endsection
