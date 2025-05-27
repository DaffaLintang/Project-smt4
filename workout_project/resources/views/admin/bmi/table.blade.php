@forelse($bmis as $data)
<tr class="table-row">
    <td class="searchable">{{ is_array($data->Age) ? json_encode($data->Age) : $data->Age }}</td>
    <td>{{ $data->Gender }}</td>
    <td>{{ number_format($data->Height, 2) }}</td>
    <td>{{ number_format($data->Weight, 2) }}</td>
    <td>{{ number_format($data->BMI, 2) }}</td>
    <td class="searchable">{{ $data->PhysicalActivityLevel }}</td>
    <td class="searchable">{{ $data->ObesityCategory }}</td>
</tr>
@empty
<tr>
    <td colspan="7" class="text-center">
        @if(request()->input('search'))
            Tidak ada data BMI yang sesuai dengan pencarian "{{ request()->input('search') }}"
        @else
            Tidak ada data BMI.
        @endif
    </td>
</tr>
@endforelse 