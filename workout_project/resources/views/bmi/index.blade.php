{{-- @extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">BMI Management</h2>
            <a href="{{ route('bmi.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New BMI Data
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Age</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Gender</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Height (cm)</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Weight (kg)</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">BMI</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Activity Level</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($bmiData as $bmi)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $bmi->Age }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $bmi->Gender }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $bmi->Height }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $bmi->Weight }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $bmi->BMI }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $bmi->PhysicalActivityLevel }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($bmi->ObesityCategory == 'Underweight') bg-yellow-100 text-yellow-800
                                @elseif($bmi->ObesityCategory == 'Normal Weight') bg-green-100 text-green-800
                                @elseif($bmi->ObesityCategory == 'Overweight') bg-orange-100 text-orange-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ $bmi->ObesityCategory }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('bmi.show', $bmi->_id) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection  --}}