@extends('layouts.app') 

@section('content')
<div class="container">
    <h2 class="mb-4">Manajemen Rekomendasi Workout</h2>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Pencarian --}}
    <div class="row g-2 mb-4">
        <div class="col-12">
            <form method="GET" action="{{ url('admin/workouts') }}" class="mb-4">
    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari workout...">
</form>

        </div>
    </div>

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
                </tr>
            </thead>
            <tbody>
                @foreach ($workouts as $workout)
                    <tr class="table-row">
                        <td>{{ $workout->_id }}</td>
                        <td>{{ $workout->Title }}</td>
                        <td>{{ $workout->Desc }}</td>
                        <td>{{ $workout->Type }}</td>
                        <td>{{ $workout->BodyPart }}</td>
                        <td>{{ $workout->Equipment }}</td>
                        <td>{{ $workout->Level }}</td>
                        <td>{{ $workout->Rating }}</td>
                        <td>{{ $workout->RatingDesc }}</td>
                    </tr>
                    <div class="modal fade" id="editWorkoutModal{{ $workout->_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('workouts.update', $workout->_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Workout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Title">Title</label>
                        <input type="text" name="Title" value="{{ $workout->Title }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="Desc">Description</label>
                        <textarea name="Desc" class="form-control" required>{{ $workout->Desc }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="Type">Type</label>
                        <input type="text" name="Type" value="{{ $workout->Type }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="BodyPart">Body Part</label>
                        <input type="text" name="BodyPart" value="{{ $workout->BodyPart }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="Equipment">Equipment</label>
                        <input type="text" name="Equipment" value="{{ $workout->Equipment }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="Level">Level</label>
                        <select name="Level" class="form-control" required>
                            <option value="Beginner" {{ $workout->Level == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="Intermediate" {{ $workout->Level == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Expert" {{ $workout->Level == 'Expert' ? 'selected' : '' }}>Expert</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="Rating">Rating</label>
                        <input type="number" name="Rating" value="{{ $workout->Rating }}" class="form-control" min="1" max="5" required>
                    </div>

                    <div class="mb-3">
                        <label for="RatingDesc">Rating Description</label>
                        <textarea name="RatingDesc" class="form-control" required>{{ $workout->RatingDesc }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
                @endforeach
            </tbody>
        </table>

        <div id="pagination-container">
        {{ $workouts->links('vendor.pagination.simple-tailwind') }}
    </div>

{{-- Modal Edit --}}
<div class="modal fade" id="editWorkoutModal{{ $workout->_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editWorkoutForm{{ $workout->_id }}" 
                  action="{{ route('workouts.update', $workout->_id) }}" 
                  method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Workout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_title_{{ $workout->_id }}" class="form-label">Title</label>
                        <input type="text" class="form-control" 
                               id="edit_title_{{ $workout->_id }}" 
                               name="Title" 
                               value="{{ old('Title', $workout->Title) }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_desc_{{ $workout->_id }}" class="form-label">Description</label>
                        <textarea class="form-control" 
                                  id="edit_desc_{{ $workout->_id }}" 
                                  name="Desc" rows="3" 
                                  required>{{ old('Desc', $workout->Desc) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_type_{{ $workout->_id }}" class="form-label">Type</label>
                        <input type="text" class="form-control" 
                               id="edit_type_{{ $workout->_id }}" 
                               name="Type" 
                               value="{{ old('Type', $workout->Type) }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_bodypart_{{ $workout->_id }}" class="form-label">Body Part</label>
                        <input type="text" class="form-control" 
                               id="edit_bodypart_{{ $workout->_id }}" 
                               name="BodyPart" 
                               value="{{ old('BodyPart', $workout->BodyPart) }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_equipment_{{ $workout->_id }}" class="form-label">Equipment</label>
                        <input type="text" class="form-control" 
                               id="edit_equipment_{{ $workout->_id }}" 
                               name="Equipment" 
                               value="{{ old('Equipment', $workout->Equipment) }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_level_{{ $workout->_id }}" class="form-label">Level</label>
                        <select class="form-control" id="edit_level_{{ $workout->_id }}" name="Level" required>
                            <option value="Beginner" {{ $workout->Level == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="Intermediate" {{ $workout->Level == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Expert" {{ $workout->Level == 'Expert' ? 'selected' : '' }}>Expert</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_rating_{{ $workout->_id }}" class="form-label">Rating</label>
                        <input type="number" class="form-control" 
                               id="edit_rating_{{ $workout->_id }}" 
                               name="Rating" 
                               min="1" max="5" 
                               value="{{ old('Rating', $workout->Rating) }}" 
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_ratingdesc_{{ $workout->_id }}" class="form-label">Rating Description</label>
                        <textarea class="form-control" 
                                  id="edit_ratingdesc_{{ $workout->_id }}" 
                                  name="RatingDesc" rows="2" 
                                  required>{{ old('RatingDesc', $workout->RatingDesc) }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Script untuk Modal Edit --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('editWorkoutForm');

        // Fungsi mengisi data ke modal edit
        function populateEditModal(workout) {
            form.action = `/workouts/${workout._id}`;
            document.getElementById('edit_id').value = workout._id;
            document.getElementById('edit_title').value = workout.Title || '';
            document.getElementById('edit_desc').value = workout.Desc || '';
            document.getElementById('edit_type').value = workout.Type || '';
            document.getElementById('edit_bodypart').value = workout.BodyPart || '';
            document.getElementById('edit_equipment').value = workout.Equipment || '';
            document.getElementById('edit_level').value = workout.Level || 'Beginner';
            document.getElementById('edit_rating').value = workout.Rating || 1;
            document.getElementById('edit_ratingdesc').value = workout.RatingDesc || '';
        }

        // Pasang event listener di semua tombol edit
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function () {
                const workout = JSON.parse(this.getAttribute('data-workout'));
                console.log('Workout data:', workout);
                populateEditModal(workout);
            });
        });

        // Tangani submit form edit
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const action = form.getAttribute('action');
            const formData = new FormData(form);
            formData.append('_method', 'PUT'); // Laravel expects this

            fetch(action, {
                method: 'POST', // gunakan POST, karena _method=PUT
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        bootstrap.Modal.getInstance(document.getElementById('editWorkoutModal')).hide();
                        window.location.reload();
                    } else {
                        alert(data.message || 'Terjadi kesalahan saat menyimpan data');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('Terjadi kesalahan saat menyimpan data');
                });
        });
    });
</script>

<script>
// function filterTable(searchText) {
//     searchText = searchText.toLowerCase();
//     const rows = document.getElementsByClassName('table-row');
    
//     for (let row of rows) {
//         let text = row.textContent.toLowerCase();
//         if (text.includes(searchText)) {
//             row.style.display = '';
//         } else {
//             row.style.display = 'none';
//         }
//     }
// }
</script>
@endpush
@endsection
