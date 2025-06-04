<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\User;
use App\Models\LoginLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Result;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWorkouts = Workout::count();
        $totalUsers = User::count();
        $totalResults = Result::count();
        $totalBMI = DB::connection('mongodb')->table('obesity')->count();

        // Mengambil data untuk 6 bulan terakhir
        $sixMonthsAgo = now()->subMonths(5);

        // Inisialisasi array untuk semua bulan
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyData[$date->format('Y-m')] = 0;
        }

        // Menghitung jumlah login per bulan
        $loginLogs = LoginLog::where('created_at', '>=', $sixMonthsAgo)
            ->get();

        foreach ($loginLogs as $log) {
            $yearMonth = Carbon::parse($log->created_at)->format('Y-m');
            if (isset($monthlyData[$yearMonth])) {
                $monthlyData[$yearMonth]++;
            }
        }

        // Debug: Tampilkan data yang diambil
        \Log::info('Monthly Data:', $monthlyData);

        // Mengubah format label menjadi nama bulan dalam Bahasa Indonesia
        $indonesianMonths = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        $labels = array_map(function($yearMonth) use ($indonesianMonths) {
            $month = Carbon::createFromFormat('Y-m', $yearMonth)->format('F');
            return $indonesianMonths[$month];
        }, array_keys($monthlyData));

        return view('admin.dashboard', [
            'totalWorkouts' => $totalWorkouts,
            'totalBMI' => $totalBMI,
            'totalUsers' => $totalUsers,
            'totalResults' => $totalResults,
            'monthlyUserLabels' => $labels,
            'monthlyUserData' => array_values($monthlyData)
        ]);
    }

    public function getMonthlyUsers()
    {
        $sixMonthsAgo = now()->subMonths(5);

        // Inisialisasi array untuk semua bulan
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyData[$date->format('Y-m')] = 0;
        }

        // Menghitung jumlah login per bulan
        $loginLogs = LoginLog::where('created_at', '>=', $sixMonthsAgo)
            ->get();

        foreach ($loginLogs as $log) {
            $yearMonth = Carbon::parse($log->created_at)->format('Y-m');
            if (isset($monthlyData[$yearMonth])) {
                $monthlyData[$yearMonth]++;
            }
        }

        // Debug: Tampilkan data yang diambil
        \Log::info('API Monthly Data:', $monthlyData);

        // Mengubah format ke nama bulan Bahasa Indonesia
        $indonesianMonths = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        $formattedData = [];
        foreach ($monthlyData as $yearMonth => $count) {
            $month = Carbon::createFromFormat('Y-m', $yearMonth)->format('F');
            $formattedData[$indonesianMonths[$month]] = $count;
        }

        return response()->json($formattedData);
    }
}
