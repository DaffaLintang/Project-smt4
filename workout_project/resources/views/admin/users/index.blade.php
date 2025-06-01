@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="container mt-4">
    <h2>Manajemen Pengguna</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Refresh</a>
    </div>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari pengguna..." oninput="filterTable(this.value)">
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered" id="userTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Gambar</th>
                    <th>Nama Lengkap</th>
                    <th>Telepon</th>
                    <th>Lahir</th>
                    <th>Berat (Kg)</th>
                    <th>Tinggi (Cm)</th>
                    <th>Dibuat</th>
                    <th>Update</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="table-row">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/default.png') }}" width="100" alt="Gambar">
                        </td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->birth }}</td>
                        <td>{{ $user->weight }}</td>
                        <td>{{ $user->height }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">Edit</button>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}">Hapus</button>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="edit-user-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Pengguna</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label>Nama</label>
                                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="full_name" class="form-control" value="{{ $user->full_name }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Nomor Telepon</label>
                                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Tanggal Lahir</label>
                                                <input type="date" name="birth" class="form-control" value="{{ $user->birth }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Berat (Kg)</label>
                                                <input type="number" name="weight" class="form-control" value="{{ $user->weight }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Tinggi (Cm)</label>
                                                <input type="number" name="height" class="form-control" value="{{ $user->height }}">
                                            </div>
                                            <div class="col-md-12">
                                                <label>Gambar</label>
                                                <input type="file" name="image" class="form-control">
                                                @if($user->image)
                                                    <img src="{{ asset('storage/' . $user->image) }}" alt="Image" class="mt-2" width="150">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr><td colspan="12" class="text-center">Tidak ada data pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>

         <div id="pagination-container">
        {{ $users->links('vendor.pagination.simple-tailwind') }}
    </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    
    // Filter Tabel
    function filterTable(searchText) {
        searchText = searchText.toLowerCase();
        document.querySelectorAll('.table-row').forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchText) ? '' : 'none';
        });
    }

    // Hapus data
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.dataset.id;
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then(result => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${userId}`).submit();
                    }
                });
            });
        });

        // Konfirmasi sebelum edit disubmit
        document.querySelectorAll('.edit-user-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const modal = bootstrap.Modal.getInstance(this.closest('.modal'));
                Swal.fire({
                    title: 'Yakin simpan perubahan?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
