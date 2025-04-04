<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;


class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = strtolower($request->input('search'));

        $results = Result::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%$search%")
                         ->orWhere('desc', 'like', "%$search%")
                         ->orWhere('type', 'like', "%$search%");
        })->paginate(5);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.results.index', compact('results'))->render()
            ]);
        }
    
        return view('admin.results.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
