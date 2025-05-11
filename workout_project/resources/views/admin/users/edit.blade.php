@extends('layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
</head>


<div class="container">
    <h2>Edit Pengguna</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label for="full_name" class="form-label">Nama Lengkap</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $user->full_name }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
        </div>

        <div class="mb-3">
            <label for="birth" class="form-label">Tanggal Lahir</label>
            <input type="date" name="birth" id="birth" class="form-control" value="{{ $user->birth }}">
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Berat Badan (Kg)</label>
            <input type="number" name="weight" id="weight" class="form-control" value="{{ $user->weight }}">
        </div>

        <div class="mb-3">
            <label for="height" class="form-label">Tinggi Badan (Cm)</label>
            <input type="number" name="height" id="height" class="form-control" value="{{ $user->height }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Foto Profil</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($user->image)
            <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Profil" width="100">

            @endif
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
    </form>

    
</div>

@endsection
