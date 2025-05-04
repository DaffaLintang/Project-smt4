@extends('layouts.app') 

@section('content')
<div class="container">
    <h2 class="mb-4">Manajemen Rekomendasi Workout</h2>

    {{-- Form Pencarian --}}
    <form action="{{ route('workouts.index') }}" method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-12 col-md-8">
                <input type="text" name="search" class="form-control" placeholder="Cari workout..." value="{{ request('search') }}">
            </div>
            <div class="col-12 col-md-4">
                <button type="submit" class="btn btn-outline-primary w-100">Search</button>
            </div>
        </div>
    </form>

    {{-- Table Responsive --}}
    <div class="table-responsive">
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Body Part</th>
                    <th>Equipment</th>
                    <th>Level</th>
                    <th>Rating</th>
                    <th>Rating Description</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workouts as $workout)
                    <tr>
                        <td>{{ $workout['Unnamed: 0'] }}</td>
                        <td>{{ $workout->Title }}</td>
                        <td>{{ $workout->Desc }}</td>
                        <td>{{ $workout->Type }}</td>
                        <td>{{ $workout->BodyPart }}</td>
                        <td>{{ $workout->Equipment }}</td>
                        <td>{{ $workout->Level }}</td>
                        <td>{{ $workout->Rating }}</td>
                        <td>{{ $workout->RatingDesc }}</td>
                        <td>
                            <a href="{{ route('workouts.edit', $workout['Unnamed: 0']) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                            <form action="{{ route('workouts.destroy', $workout['Unnamed: 0']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
        <p class="m-0">Menampilkan {{ $workouts->firstItem() }} - {{ $workouts->lastItem() }} dari {{ $workouts->total() }} data</p>
        <div class="mt-2 mt-md-0">
            @if ($workouts->onFirstPage())
                <button class="btn btn-secondary" disabled>⬅ Previous</button>
            @else
                <a href="{{ $workouts->previousPageUrl() }}" class="btn btn-primary">⬅ Previous</a>
            @endif

            @if ($workouts->hasMorePages())
                <a href="{{ $workouts->nextPageUrl() }}" class="btn btn-primary">Next ➡</a>
            @else
                <button class="btn btn-secondary" disabled>Next ➡</button>
            @endif
        </div>
    </div>
</div>
@endsection
