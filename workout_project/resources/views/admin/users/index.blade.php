@extends('layouts.app')

@section('content')
{{-- Pindahkan semua CSS dan JS ke bagian atas --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">
    <h2>Manajemen Pengguna</h2>

    <div class="d-flex justify-content-between mb-3">
        <div>
            {{-- <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pengguna</a> --}}
        </div>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Refresh</a>
    </div>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari pengguna..." oninput="filterTable(this.value)">
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
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
                    <th>Nomor Telepon</th>
                    <th>Tanggal Lahir</th>
                    <th>Berat Badan (Kg)</th>
                    <th>Tinggi Badan (Cm)</th>
                    <th>Dibuat Pada</th>
                    <th>Terakhir di Ubah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse ($users as $user)
                    <tr class="table-row">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" width="100">
                            @else
                                <img src="{{ asset('images/default.png') }}" alt="Default" width="100">
                            @endif
                        </td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->birth }}</td>
                        <td>{{ $user->weight }}</td>
                        <td>{{ $user->height }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <button type="button"
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editUserModal{{ $user->id }}">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}">Hapus</button>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="edit-user-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit Pengguna</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name{{ $user->id }}" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email{{ $user->id }}" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="full_name{{ $user->id }}" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="full_name{{ $user->id }}" name="full_name" value="{{ $user->full_name }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone{{ $user->id }}" class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="phone{{ $user->id }}" name="phone" value="{{ $user->phone }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="birth{{ $user->id }}" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="birth{{ $user->id }}" name="birth" value="{{ $user->birth }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="weight{{ $user->id }}" class="form-label">Berat Badan (Kg)</label>
                                            <input type="number" class="form-control" id="weight{{ $user->id }}" name="weight" value="{{ $user->weight }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="height{{ $user->id }}" class="form-label">Tinggi Badan (Cm)</label>
                                            <input type="number" class="form-control" id="height{{ $user->id }}" name="height" value="{{ $user->height }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="image{{ $user->id }}" class="form-label">Foto Profil</label>
                                            <input type="file" class="form-control" id="image{{ $user->id }}" name="image">
                                            @if($user->image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Profil" style="max-width: 200px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">Tidak ada data pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
</div>

@push('styles')
<style>
    .btn-primary {
        background-color: #4f46e5;
        border-color: #4f46e5;
    }
    .btn-primary:hover {
        background-color: #4338ca;
        border-color: #4338ca;
    }
    .btn-primary:disabled {
        background-color: #c7d2fe;
        border-color: #c7d2fe;
        cursor: not-allowed;
    }
    #pageInfo {
        font-weight: 600;
        color: #4f46e5;
    }
    .form-select {
        border-color: #4f46e5;
        color: #4f46e5;
    }
    .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
    }
    .card {
        border-color: #e5e7eb;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    .table-row {
        display: none;
    }
    .table-row.active {
        display: table-row;
    }
    .pagination {
        margin-bottom: 0;
        gap: 5px;
    }
    .page-item.active .page-link {
        background-color: #4f46e5;
        border-color: #4f46e5;
    }
    .page-link {
        color: #4f46e5;
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        font-size: 14px;
        border: 1px solid #e5e7eb;
        margin: 0 2px;
    }
    .page-link:hover {
        color: #4338ca;
        background-color: #f3f4f6;
        border-color: #e5e7eb;
    }
    .page-link:focus {
        box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
    }
    .page-item:first-child .page-link,
    .page-item:last-child .page-link {
        padding: 0.5rem 0.75rem;
        font-size: 14px;
    }
    .page-item.disabled .page-link {
        color: #9ca3af;
        background-color: #fff;
        border-color: #e5e7eb;
        display: none !important;
    }

    /* Custom styling untuk panah navigasi */
    .pagination svg {
        width: 16px;
        height: 16px;
        vertical-align: middle;
    }

    /* Styling untuk container paginasi */
    .pagination-container {
        background-color: #fff;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-top: 1rem;
    }
    .opacity-50 {
        opacity: 0.5;
    }
    .cursor-not-allowed {
        cursor: not-allowed;
    }
    .hover\:bg-gray-200:hover {
        background-color: #e5e7eb;
    }
    .bg-gray-100 {
        background-color: #f3f4f6;
    }
    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 10px 10px;
        padding-right: 2.5rem;
    }
    select:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
        --tw-ring-color: #93c5fd;
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
        border-color: #93c5fd;
    }
</style>
@endpush

@push('scripts')
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${userId}`).submit();
                }
            });
        });
    });

    function filterTable(searchText) {
        searchText = searchText.toLowerCase();
        const rows = document.getElementsByClassName('table-row');

        for (let row of rows) {
            let text = row.textContent.toLowerCase();
            if (text.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Preview gambar saat file dipilih
        document.getElementById('editImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                    document.getElementById('previewImage').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle semua form edit user
        document.querySelectorAll('.edit-user-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const modalElement = this.closest('.modal');

                // Tampilkan konfirmasi terlebih dahulu
                Swal.fire({
                    title: 'Yakin ingin mengubah?',
                    text: "Data akan diperbarui!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, ubah!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim request
                        fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Tutup modal
                            const modal = bootstrap.Modal.getInstance(modalElement);
                            if (modal) {
                                modal.hide();
                            }

                            if (data.success) {
                                // Tampilkan pesan sukses dengan animasi
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data pengguna berhasil diperbarui',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK',
                                    allowOutsideClick: false,
                                    customClass: {
                                        popup: 'animate__animated animate__fadeInDown'
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: data.message || 'Terjadi kesalahan saat mengupdate data',
                                    confirmButtonColor: '#3085d6'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat mengupdate data',
                                confirmButtonColor: '#3085d6'
                            });
                        });
                    }
                });
            });
        });

        // Debug log untuk memastikan script berjalan
        console.log('Script loaded, forms found:', document.querySelectorAll('.edit-user-form').length);
    });
</script>
@endpush

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
});
</script>
@endif

@endsection
