@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Manajemen BMI</h2>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan Umur, Tingkat Aktivitas Fisik, atau Kategori Obesitas...">
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div id="loading" style="display: none;" class="text-center mb-3">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div id="searchInfo" class="alert alert-info mb-3" style="display: none;">
        <span id="searchResults"></span>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Umur</th>
                    <th>Gender</th>
                    <th>Tinggi Badan</th>
                    <th>Berat Badan</th>
                    <th>BMI</th>
                    <th>Tingkat Aktivitas Fisik</th>
                    <th>Kategori Obesitas</th>
                </tr>
            </thead>
            <tbody id="bmiTableBody">
                @include('admin.bmi.table')
            </tbody>
        </table>
    </div>

    <div id="pagination-container">
        {{ $bmis->links('vendor.pagination.simple-tailwind') }}
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Script loaded');
    
    const searchInput = $('#searchInput');
    const searchInfo = $('#searchInfo');
    console.log('Search input found:', searchInput.length > 0);
    
    let typingTimer;
    const doneTypingInterval = 500;

    // Menangani input pencarian
    searchInput.on('input', function() {
        console.log('Input detected:', $(this).val());
        clearTimeout(typingTimer);
        typingTimer = setTimeout(performSearch, doneTypingInterval);
        
        // Sembunyikan info pencarian saat user mulai mengetik
        if ($(this).val() === '') {
            searchInfo.hide();
        }
    });

    function updateSearchInfo(total, searchText) {
        if (searchText) {
            $('#searchResults').html(`Ditemukan <strong>${total}</strong> data untuk pencarian "<strong>${searchText}</strong>"`);
            searchInfo.show();
        } else {
            searchInfo.hide();
        }
    }

    function performSearch() {
        const searchText = searchInput.val();
        console.log('Performing search for:', searchText);
        
        $('#loading').show();

        $.ajax({
            url: '{{ route("admin.bmi") }}',
            type: 'GET',
            data: {
                search: searchText
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                console.log('Sending AJAX request...');
            },
            success: function(response) {
                console.log('Response received');
                const $response = $(response);
                const newTableBody = $response.find('#bmiTableBody').html();
                const newPagination = $response.find('#pagination-container').html();
                
                if (newTableBody) {
                    $('#bmiTableBody').html(newTableBody);
                    // Update informasi pencarian
                    const totalRows = $('#bmiTableBody tr').length;
                    updateSearchInfo(totalRows, searchText);
                } else {
                    console.error('Table content not found in response');
                }
                
                if (newPagination) {
                    $('#pagination-container').html(newPagination);
                } else {
                    console.error('Pagination content not found in response');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat melakukan pencarian. Silakan coba lagi.'
                });
            },
            complete: function() {
                $('#loading').hide();
            }
        });
    }

    // Menangani klik pada pagination
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        const searchText = searchInput.val();
        
        console.log('Pagination clicked:', url);
        $('#loading').show();
        
        $.get(url + (url.includes('?') ? '&' : '?') + 'search=' + searchText)
            .done(function(response) {
                const $response = $(response);
                const newTableBody = $response.find('#bmiTableBody').html();
                const newPagination = $response.find('#pagination-container').html();
                
                if (newTableBody) {
                    $('#bmiTableBody').html(newTableBody);
                    // Update informasi pencarian untuk halaman baru
                    const totalRows = $('#bmiTableBody tr').length;
                    updateSearchInfo(totalRows, searchText);
                }
                if (newPagination) {
                    $('#pagination-container').html(newPagination);
                }
            })
            .fail(function(xhr, status, error) {
                console.error('Pagination error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat memuat halaman. Silakan coba lagi.'
                });
            })
            .always(function() {
                $('#loading').hide();
            });
    });
});
</script>
@endpush
@endsection
