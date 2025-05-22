@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">
    <!-- Add Bootstrap CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Add SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Add CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <h2>Manajemen Pengguna</h2>

    <div class="d-flex justify-content-between mb-3">
        <div>
            {{-- <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pengguna</a> --}}
        </div>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Refresh</a>
    </div>

    <form action="{{ route('admin.users') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari pengguna..." value="{{ request('search') }}">
            <select name="perPage" class="form-select" style="max-width: 150px;">
                <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5 per halaman</option>
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10 per halaman</option>
                <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15 per halaman</option>
                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20 per halaman</option>
            </select>
            <button type="submit" class="btn btn-outline-primary">Cari</button>
        </div>
    </form>

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
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="full_name" value="{{ $user->full_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                    </div>

                    <div class="mb-3">
                        <label for="birth" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="birth" value="{{ $user->birth }}">
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label">Berat Badan (Kg)</label>
                        <input type="number" class="form-control" name="weight" value="{{ $user->weight }}">
                    </div>

                    <div class="mb-3">
                        <label for="height" class="form-label">Tinggi Badan (Cm)</label>
                        <input type="number" class="form-control" name="height" value="{{ $user->height }}">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" name="image">
                        @if($user->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Profil" style="max-width: 200px;">
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
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

    {{-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center py-5 px-4 bg-white rounded-md shadow-md">
        <!-- Filter Rows per Page -->
        <div class="flex items-center space-x-2 flex-grow">
            <label for="perPage" class="text-sm font-medium">Baris per halaman:</label>
            <form id="perPageForm" action="{{ route('admin.users') }}" method="GET" class="inline">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <select name="perPage" id="perPage" class="border rounded-md py-2 px-4 ml-1 text-sm focus:outline-none focus:ring focus:border-blue-300" onchange="document.getElementById('perPageForm').submit()">
                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                </select>
            </form>
        </div> --}}

        <!-- Pagination Controls -->
        <div class="flex items-center space-x-4 ml-2">
            @if ($users->onFirstPage())
                <button disabled class="text-sm px-3 py-2 border rounded-md bg-gray-100 opacity-50 cursor-not-allowed">Sebelumnya</button>
            @else
                <a href="{{ $users->previousPageUrl() }}" class="text-sm px-3 py-2 border rounded-md bg-gray-100 hover:bg-gray-200 focus:outline-none">Sebelumnya</a>
            @endif

            <span class="text-sm font-medium">
                Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}
            </span>

            @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="text-sm px-3 py-2 border rounded-md bg-gray-100 hover:bg-gray-200 focus:outline-none">Selanjutnya</a>
            @else
                <button disabled class="text-sm px-3 py-2 border rounded-md bg-gray-100 opacity-50 cursor-not-allowed">Selanjutnya</button>
            @endif
        </div>
    </div>

    <!-- Modal Edit User -->
    {{-- <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editUserId" name="id">

                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="editFullName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="editFullName" name="full_name">
                        </div>

                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="editPhone" name="phone">
                        </div>

                        <div class="mb-3">
                            <label for="editBirth" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="editBirth" name="birth">
                        </div>

                        <div class="mb-3">
                            <label for="editWeight" class="form-label">Berat Badan (Kg)</label>
                            <input type="number" class="form-control" id="editWeight" name="weight">
                        </div>

                        <div class="mb-3">
                            <label for="editHeight" class="form-label">Tinggi Badan (Cm)</label>
                            <input type="number" class="form-control" id="editHeight" name="height">
                        </div>

                        <div class="mb-3">
                            <label for="editImage" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="editImage" name="image">
                            <div class="mt-2">
                                <img id="previewImage" src="" alt="Preview" style="max-width: 200px; display: none;">
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
    </div>
</div> --}}

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
        background-size: 1.5em 1.5em;
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
// Fungsi untuk mengisi form edit
function editUser(userData) {
    console.log('Edit User called with:', userData);
    
    // Set nilai form
    document.getElementById('editUserId').value = userData.id;
    document.getElementById('editName').value = userData.name;
    document.getElementById('editEmail').value = userData.email;
    document.getElementById('editFullName').value = userData.fullName;
    document.getElementById('editPhone').value = userData.phone;
    document.getElementById('editBirth').value = userData.birth;
    document.getElementById('editWeight').value = userData.weight;
    document.getElementById('editHeight').value = userData.height;

    // Set action URL for the form
    document.getElementById('editUserForm').setAttribute('action', `/admin/users/${userData.id}`);

    // Set preview gambar
    const previewImage = document.getElementById('previewImage');
    if (userData.image) {
        previewImage.src = `/storage/${userData.image}`;
        previewImage.style.display = 'block';
    } else {
        previewImage.src = "{{ asset('storage/profiles/default-avatar.png') }}";
        previewImage.style.display = 'block';
    }

    // Buka modal menggunakan Bootstrap 5
    const editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    editModal.show();
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

    // Handle form submission
    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const userId = document.getElementById('editUserId').value;
        const formData = new FormData(this);

        // Tampilkan loading
        Swal.fire({
            title: 'Memproses...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Kirim request
        fetch(`/admin/users/${userId}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const editModal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
                editModal.hide();
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 1500
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message || 'Terjadi kesalahan saat mengupdate data'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat mengupdate data'
            });
        });
    });

    // Auto-submit form when perPage value changes
    document.getElementById('perPage').addEventListener('change', function() {
        this.form.submit();
    });
});
</script>
@endpush

@endsection