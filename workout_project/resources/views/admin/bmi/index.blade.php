@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Manajemen BMI</h2>

    <form action="{{ route('admin.bmi') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari Data BMI..." value="{{ request('search') }}">
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
                    <th>Umur</th>
                    <th>Gender</th>
                    <th>Tinggi Badan</th>
                    <th>Berat Badan</th>
                    <th>BMI</th>
                    <th>Tingkat Aktivitas Fisik</th>
                    <th>Kategori Obesitas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bmi as $data)
                <tr>
                    <td>{{ $data->Age }}</td>
                    <td>{{ $data->Gender }}</td>
                    <td>{{ $data->Height }}</td>
                    <td>{{ $data->Weight }}</td>
                    <td>{{ $data->BMI }}</td>
                    <td>{{ $data->PhysicalActivityLevel }}</td>
                    <td>{{ $data->ObesityCategory }}</td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data BMI.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $bmi->links() }}
</div>
@endsection