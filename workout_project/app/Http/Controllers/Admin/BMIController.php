<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BMI;
use MongoDB\BSON\Regex;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;


class BMIController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search');
    $perPage = 10;
    $currentPage = $request->input('page', 1);

    $collection = DB::connection('mongodb')->getMongoDB()->selectCollection('obesity');

    $filter = [];

    if ($search !== null && $search !== '') {
        $regex = new Regex($search, 'i');

        // Cek apakah input adalah angka (untuk filter Age dan Activity Level)
        $asInt = is_numeric($search) ? (int)$search : null;

        $orFilters = [];

        if ($asInt !== null) {
            $orFilters[] = ['Age' => $asInt];
            $orFilters[] = ['PhysicalActivityLevel' => $asInt];
        }

        $orFilters[] = ['ObesityCategory' => $regex];

        $filter = ['$or' => $orFilters];
    }

    $cursor = $collection->find($filter);
    $results = iterator_to_array($cursor);

    // Manual pagination
    $total = count($results);
    $items = array_slice($results, ($currentPage - 1) * $perPage, $perPage);
    $bmis = new LengthAwarePaginator($items, $total, $perPage, $currentPage, [
        'path' => url()->current(),
        'query' => $request->query(),
    ]);

    return view('admin.bmi.index', compact('bmis'));
}

}
