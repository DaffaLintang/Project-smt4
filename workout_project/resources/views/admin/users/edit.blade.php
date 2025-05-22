@if(!request()->ajax())
@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Edit Pengguna</h2>
                </div>
                <div class="card-body">
@else
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
@endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="editUserForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="full_name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="full_name" id="full_name" class="form-control @error('full_name') is-invalid @enderror" 
                                value="{{ old('full_name', $user->full_name) }}">
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" 
                                value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="birth" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="birth" id="birth" class="form-control @error('birth') is-invalid @enderror" 
                                value="{{ old('birth', $user->birth) }}">
                            @error('birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="weight" class="form-label">Berat Badan (Kg)</label>
                            <input type="number" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" 
                                value="{{ old('weight', $user->weight) }}">
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="height" class="form-label">Tinggi Badan (Cm)</label>
                            <input type="number" name="height" id="height" class="form-control @error('height') is-invalid @enderror" 
                                value="{{ old('height', $user->height) }}">
                            @error('height')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto Profil</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if ($user->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Profil" class="img-thumbnail" style="max-width: 200px">
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between">
                            @if(!request()->ajax())
                                <a href="{{ route('admin.users') }}" class="btn btn-secondary">Kembali</a>
                            @else
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            @endif
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>

@if(!request()->ajax())
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@else
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('editUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: data.message,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                // Close modal
                bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
                // Reload the page or update the table
                window.location.reload();
            });
        } else {
            // Show error message
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Terjadi kesalahan saat menyimpan data'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan saat menyimpan data'
        });
    });
});

// Preview image before upload
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector('.img-thumbnail');
            if (preview) {
                preview.src = e.target.result;
            } else {
                const newPreview = document.createElement('div');
                newPreview.className = 'mt-2';
                newPreview.innerHTML = `<img src="${e.target.result}" alt="Foto Profil" class="img-thumbnail" style="max-width: 200px">`;
                document.getElementById('image').parentNode.appendChild(newPreview);
            }
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endif