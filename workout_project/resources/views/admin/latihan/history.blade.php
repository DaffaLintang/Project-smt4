@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Manajemen Latihan</h2>

    <form action="{{ route('admin.latihan') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Latihan..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </div>
    </form>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Durasi</th>
                    <th>Repetisi</th>
                    <th>Kesulitan</th>
                    <th>Catatan</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($history as $h)
                <tr>
                    <td>{{ $h->user->name }}</td>
                    <td>{{ $h->durasi }} menit</td>
                    <td>{{ $h->repetisi }}</td>
                    <td>{{ $h->kesulitan }}</td>
                    <td>{{ $h->catatan }}</td>
                    <td>{{ $h->created_at->format('d M Y H:i') }}</td>
                </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data latihan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $history->links() }}
</div>
@endsection