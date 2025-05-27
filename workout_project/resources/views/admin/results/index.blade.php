@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Manajemen Result</h2>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari result..." oninput="filterTable(this.value)">
    </div>

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
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tipe</th>
                    <th>Bagian Tubuh</th>
                    <th>Peralatan</th>
                    <th>Level</th>
                    <th>ID User</th>
                    <th>Dibuat Pada</th>
                    <th>Terakhir di Ubah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($results as $result)
                    <tr class="table-row">
                        <td>{{ $result->_id }}</td>
                        <td>{{ $result->title }}</td>
                        <td>{{ $result->desc }}</td>
                        <td>{{ $result->type }}</td>
                        <td>{{ $result->body_part }}</td>
                        <td>{{ $result->equipment }}</td>
                        <td>{{ $result->level }}</td>
                        <td>{{ $result->id_user }}</td>
                        <td>{{ $result->created_at }}</td>
                        <td>{{ $result->updated_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">Tidak ada data result.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $results->links() }}
</div>

<script>
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
</script>
@endsection