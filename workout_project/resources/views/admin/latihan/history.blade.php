@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Manajemen Latihan</h2>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan ID User, Durasi, Repetisi, Kesulitan, atau Catatan..." oninput="filterTable(this.value)">
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div id="searchInfo" class="alert alert-info mb-3">
        <span id="totalResults">Total: {{ $history->count() }} data</span>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Durasi</th>
                    <th>Repetisi</th>
                    <th>Kesulitan</th>
                    <th>Catatan</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @forelse($history as $h)
                <tr class="table-row">
                    <td>{{ $h->_id}}</td>
                    <td>{{ $h->durasi }} menit</td>
                    <td>{{ $h->repetisi }}</td>
                    <td>{{ $h->kesulitan }}</td>
                    <td>{{ $h->catatan }}</td>
                    <td>{{ \Carbon\Carbon::parse($h->created_at)->timezone('Asia/Jakarta')->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data latihan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('styles')
<style>
.table-row {
    display: table-row;
}
</style>
@endpush

@push('scripts')
<script>
function filterTable(searchText) {
    searchText = searchText.toLowerCase();
    const rows = document.getElementsByClassName('table-row');
    let visibleCount = 0;
    
    for (let row of rows) {
        let text = row.textContent.toLowerCase();
        if (text.includes(searchText)) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    }
    
    // Update total results
    document.getElementById('totalResults').textContent = `Total: ${visibleCount} data`;
}

// Initial count
document.addEventListener('DOMContentLoaded', function() {
    const totalRows = document.getElementsByClassName('table-row').length;
    document.getElementById('totalResults').textContent = `Total: ${totalRows} data`;
});
</script>
@endpush