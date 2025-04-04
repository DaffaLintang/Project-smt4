@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manajemen Pengguna</h2>
    {{-- Tombol Tambah dan Refresh --}}
    <div class="d-flex justify-content-between mb-3">
         
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Refresh</a>
    </div>

    {{-- Form Pencarian --}}
    <form action="{{ route('users.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari pengguna..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </div>
    </form>

    {{-- Notifikasi Berhasil --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Gambar</th>
                <th>Nama Lengkap</th>
                <th>Nomor Telepon</th>
                <th>Tanggal Lahir</th>
                <th>Berat Badan (Kg)</th>
                <th>Tinggi Badan (Cm)</th>
                <th>Dibuat Pada</th>
                <th>Terakhir di Ubah</th>
                <th>Aksi </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->image }}</td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->birth }}</td>
                <td>{{ $user->weight }}</td>
                <td>{{ $user->height }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Ubah</a>
    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
    </form>
</td>
<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="editUserId">

                    <div class="mb-3">
                        <label for="editName" class="form-label">Nama</label>
                        <input type="text" id="editName" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" id="editEmail" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="editFullName" class="form-label">Nama Lengkap</label>
                        <input type="text" id="editFullName" name="full_name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Nomor Telepon</label>
                        <input type="text" id="editPhone" name="phone" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="editBirth" class="form-label">Tanggal Lahir</label>
                        <input type="date" id="editBirth" name="birth" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="editWeight" class="form-label">Berat Badan (Kg)</label>
                        <input type="number" id="editWeight" name="weight" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="editHeight" class="form-label">Tinggi Badan (Cm)</label>
                        <input type="number" id="editHeight" name="height" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="editImage" class="form-label">Foto Profil</label>
                        <input type="file" id="editImage" name="image" class="form-control">
                        <img id="previewImage" src="" width="100" class="mt-2">
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
