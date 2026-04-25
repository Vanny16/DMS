@php
    $typ_id = $typ_id ?? session('typ_id', 0);
    $isReadonly = $isReadonly ?? ($typ_id == 4);
@endphp

@extends('templates.backend.layouts.main')
@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        
        .border-box {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .form-control-inline {
            border: none;
            border-bottom: 1px solid black;
            background: transparent;
            outline: none;
            display: inline-block;
        }

        .form-control-inline:focus {
            box-shadow: none;
        }

        .attendance-table th,
        .attendance-table td {
            text-align: center;
            vertical-align: middle;
            font-size: 13px;
        }

        .form-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 1.5rem;
            font-family: Arial, sans-serif;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .form-group input,
        .form-group select {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10 border-box">
                <div class="print-wrapper">
                    @if($typ_id == 1 || $typ_id == 2)
                        <div class="card shadow-sm mb-3" style="max-width: 1000px; margin: 0 auto;">
                            <div class="card-body">
                                <div class="mb-3 d-print-none">
                                    <form action="{{ route('report.showForm') }}" method="GET">
                                        <div class="form-row align-items-center">
                                            <div class="col-md-2 mb-2">
                                                <label class="mb-0 text-info font-weight-bold">
                                                    <i class="fas fa-search mr-1"></i>
                                                    {{ $typ_id == 1 ? 'Super Admin' : 'School Admin' }}
                                                </label>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <select name="search" id="search" class="form-control form-control-lg select2"
                                                    style="width: 100%;"></select>
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <button class="btn btn-primary btn-sm btn-block">
                                                    <i class="fas fa-search"></i> Search
                                                </button>
                                            </div>
                                            <div class="col-md-2 mb-2">
                                                <a href="{{ route('report.showForm') }}"
                                                    class="btn btn-outline-secondary btn-sm btn-block">
                                                    <i class="fas fa-sync-alt"></i> Clear
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                        @if($typ_id == 4 && count($students))
                            @php $student = $students[0]; @endphp
                            <input type="hidden" name="search" value="{{ $student['id'] }}">
                            <div class="mb-3">
                                <label class="fw-semibold">Student:</label>
                                <p class="form-control-plaintext fw-bold">{{ $student['name'] }}</p>
                            </div>
                        @endif

                        <form id="printForm" method="GET" action="{{ route('report.print', ['id' => $user['usrID'] ?? 0]) }}">
                            <div class="card shadow-sm mb-5" style="max-width: 1000px; margin: 0 auto;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="fw-semibold">SF9-SHS</span>
                                        <div class="mb-3">
                                            <span>LRN:</span>
                                            <input type="text" name="lrn" value="{{ request('lrn', old('lrn')) }}"
                                                class="form-control-inline fw-bold border-0 border-dark border-bottom text-center"
                                                style="width: 200px;" {{ $isReadonly ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="text-center mb-4">
                                        <strong>Republic of the Philippines<br>DEPARTMENT OF EDUCATION</strong>
                                        <div class="mt-2">
                                            Region:
                                            <select name="region"
                                                class="form-control-inline text-center fw-bold border-0 border-bottom"
                                                style="width: 100px;" >
                                                <option value="" disabled {{ request('region', old('region')) ? '' : 'selected' }}>Select</option>
                                                @foreach(['I', 'II', 'III', 'IV-A', 'IV-B', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII', 'XIII', 'NCR', 'CAR', 'BARMM'] as $region)
                                                    <option value="{{ $region }}" {{ request('region', old('region')) == $region ? 'selected' : '' }}>{{ $region }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <strong>DIVISION OF</strong>
                                            <select name="division"
                                                class="form-control-inline fw-bold text-center border-0 border-bottom"
                                                style="width: 180px;">
                                                <option value="" disabled {{ request('division', old('division')) ? '' : 'selected' }}>Select Division</option>
                                                @foreach(['Manila', 'Quezon City', 'Cebu City', 'Davao City', 'Baguio City', 'Iloilo City', 'Zamboanga City', 'Taguig City', 'Pasig City', 'Makati City'] as $division)
                                                    <option value="{{ $division }}" {{ request('division', old('division')) == $division ? 'selected' : '' }}>{{ $division }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-2">
                                            <input type="text" name="school_name" value="{{ $schoolName }}"
                                                class="form-control-inline text-center fw-bold border-0 border-bottom"
                                                style="width: 60%;" {{ $readonly ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <p><b>Name: </b>{{ $user['usrFirstName'] ?? '' }} {{ $user['usrMiddleName'] ?? '' }}
                                        {{ $user['usrLastName'] ?? '' }}</p>
                                    <p><b>ID: </b>{{ $user['usrID'] ?? '' }}</p>

                                    <div class="form-section d-flex flex-wrap gap-3">
                                        <div class="d-flex align-items-center me-3">
                                            <label class="fw-bold me-2 mb-0">Age:</label>
                                            <input type="text" name="age"
                                                value="{{ request('age', $user['age'] ?? old('age')) }}" class="text-center"
                                                style="border: none; border-bottom: 1px solid black; outline: none; background: transparent; padding: 4px 5px; width: 60px;"
                                            >
                                        </div>

                                        <div class="d-flex align-items-center me-3">
                                            <label class="fw-bold me-2 mb-0">Sex:</label>
                                            <select name="sex"
                                                style="border: none; border-bottom: 1px solid black; outline: none; background: transparent; padding: 4px 8px; width: 100px;">
                                                <option value="Male" {{ request('sex', old('sex')) == 'Male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="Female" {{ request('sex', old('sex')) == 'Female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>

                                        <div class="d-flex align-items-center me-3">
                                            <label class="fw-bold me-2 mb-0">Grade:</label>
                                            <input type="text" name="grade" class="text-center"
                                                value="{{ request('grade', old('grade')) }}"
                                                style="border: none; border-bottom: 1px solid black; outline: none; background: transparent; padding: 4px 8px; width: 80px;"
                                                >
                                        </div>

                                        <div class="d-flex align-items-center me-3">
                                            <label class="fw-bold me-2 mb-0">Section:</label>
                                            <input type="text" name="section" class="text-center"
                                                value="{{ request('section', old('section')) }}"
                                                style="border: none; border-bottom: 1px solid black; outline: none; background: transparent; padding: 4px 8px; width: 100px;"
                                                >
                                        </div>

                                        <div class="d-flex align-items-center me-3">
                                            <label class="fw-bold me-2 mb-0">Curriculum:</label>
                                            <input type="text" name="curriculum" class="text-center"
                                                value="{{ request('curriculum', old('curriculum')) }}"
                                                style="border: none; border-bottom: 1px solid black; outline: none; background: transparent; padding: 4px 8px; width: 120px;"
                                                >
                                        </div>

                                        <div class="d-flex align-items-center me-3">
                                            <label class="fw-bold me-2 mb-0">School Year:</label>
                                            <input type="text" name="school_year" class="text-center"
                                                value="{{ request('school_year', old('school_year')) }}"
                                                style="border: none; border-bottom: 1px solid black; outline: none; background: transparent; padding: 4px 8px; width: 100px;"
                                                >
                                        </div>

                                        <div class="d-flex align-items-center me-3">
                                            <label class="fw-bold me-2 mb-0">Track/Strand:</label>
                                            <input type="text" name="track_strand" class="text-center"
                                                value="{{ request('track_strand', old('track_strand')) }}"
                                                style="border: none; border-bottom: 1px solid black; outline: none; background: transparent; padding: 4px 8px; width: 140px;"
                                                >
                                        </div>
                                    </div><br>

                                    <h6 class="fw-bold mb-3 text-center">REPORT ON ATTENDANCE</h6>
                                    <div class="table-responsive mb-4">
                                        <table class="table table-bordered attendance-table text-center align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-start">Description</th>
                                                    @foreach($months as $month)
                                                        <th>{{ $month }}</th>
                                                    @endforeach
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-start">No. of School Days</td>
                                                    @foreach($months as $label)
                                                        <td>{{ $schoolDays[$label] ?? 0 }}</td>
                                                    @endforeach
                                                    <td class="fw-semibold">{{ array_sum($schoolDays) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">No. of Days Present</td>
                                                    @foreach($months as $label)
                                                        <td>{{ $attendance[$label] ?? 0 }}</td>
                                                    @endforeach
                                                    <td class="fw-semibold">{{ array_sum($attendance) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-start">No. of Days Absent</td>
                                                    @foreach($months as $label)
                                                        <td>{{ max(0, ($schoolDays[$label] ?? 0) - ($attendance[$label] ?? 0)) }}
                                                        </td>
                                                    @endforeach
                                                    <td class="fw-semibold">
                                                        {{ max(0, array_sum($schoolDays) - array_sum($attendance)) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="text-align: center; margin-top: 20px;">
                                        <button type="submit"
                                            style="padding: 10px 25px; font-size: 16px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                            Print Preview
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#search').select2({
                placeholder: 'Search student by name',
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route("students.search") }}', // Make sure this matches your route name
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return { q: params.term };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return { id: item.id, text: item.name };
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#search').select2({
                placeholder: 'Search student...',
                ajax: {
                    url: '{{ route("report.searchStudents") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(function (student) {
                                return {
                                    id: student.id,
                                    text: student.name
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 2
            });

            @if(request('search') && isset($user))
                var selectedOption = new Option('{{ $user["usrFirstName"] }} {{ $user["usrLastName"] }}', '{{ $user["usrID"] }}', true, true);
                $('#search').append(selectedOption).trigger('change');
            @endif
                                });
    </script>
@endpush