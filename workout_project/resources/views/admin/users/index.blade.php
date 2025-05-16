@extends('layouts.app')

@section('content')
<div class="container mt-4">
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
            <tbody>
                @forelse ($users as $user)
                    <tr>
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
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal" 
                                onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->full_name }}', '{{ $user->phone }}', '{{ $user->birth }}', '{{ $user->weight }}', '{{ $user->height }}', '{{ $user->image }}')">
                                Ubah
                            </button>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center">Tidak ada data pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links() }} {{-- Tampilkan link paginasi jika ada --}}

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
</div>
@endsection

@push('scripts')
<script>
function editUser(id, name, email, fullName, phone, birth, weight, height, image) {
    document.getElementById('editUserId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editFullName').value = fullName;
    document.getElementById('editPhone').value = phone;
    document.getElementById('editBirth').value = birth;
    document.getElementById('editWeight').value = weight;
    document.getElementById('editHeight').value = height;
    
    // Set the form action URL untuk update user
    document.getElementById('editUserForm').action = `/users/${id}`;
    
    // Update preview gambar jika ada
    if (image) {
        document.getElementById('previewImage').src = `/storage/${image}`;
    }
}

// Tambahkan event listener untuk form submit
document.getElementById('editUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
            modal.hide();
            
            // Refresh halaman
            window.location.reload();
        } else {
            alert('Terjadi kesalahan saat mengupdate data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate data');
    });
});
</script>
@endpush