@extends('templates.backend.layouts.main')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet"> {{-- Bootstrap 4
    DataTables --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .form-label {
            width: 100%;
        }

        #summaryTable th,
        #summaryTable td {
            text-align: center;
            vertical-align: middle;
        }

        #summaryTable thead th.col-equal,
        #summaryTable tbody td.col-equal {
            width: 25%;
        }

        /* DataTables Custom Styling */
        div.dataTables_wrapper {
            font-size: 12px;
        }

        div.dataTables_wrapper div.dataTables_length {
            float: left;
            margin-bottom: 1rem;
            white-space: nowrap;
        }

        div.dataTables_wrapper div.dataTables_length label {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-bottom: 0;
        }

        div.dataTables_wrapper .dataTables_length select {
            display: inline-block;
            width: auto;
            padding: 0.25rem;
        }

        div.dataTables_wrapper div.dataTables_filter {
            float: right;
            text-align: right;
            margin-bottom: 1rem;
        }

        div.dataTables_wrapper div.dataTables_paginate {
            text-align: left;
            margin-top: 1rem;
        }

        div.dataTables_wrapper div.dataTables_info {
            text-align: left;
            padding-top: 1rem;
            font-size: 0.875rem;
            color: #333;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.35rem 0.7rem;
            margin: 0 0.1rem;
            border: 1px solid #dee2e6 !important;
            background-color: #fff !important;
            border-radius: 0.25rem;
            color: #007bff !important;
            font-weight: 500;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #007bff !important;
            color: white !important;
            border-color: #007bff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #e9ecef !important;
            color: #0056b3 !important;
            border-color: #adb5bd !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script> {{-- Bootstrap 4 DataTables
    --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({ duration: 800, once: true });

            $('#summaryTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthChange: true,
                info: true,
                pagingType: "simple_numbers",
                language: {
                    lengthMenu: '_MENU_ entries per page',
                    paginate: {
                        previous: '«',
                        next: '»'
                    }
                },
                initComplete: function () {
                    // Make the lengthMenu dropdown match Bootstrap style
                    const lengthSelect = document.querySelector('#summaryTable_length select');
                    if (lengthSelect) {
                        lengthSelect.classList.add('form-select', 'form-select-sm', 'd-inline-block', 'w-auto', 'ms-2');
                    }
                }
            });
        });
    </script>
@endpush

@section('content')
    <section class="content">
        <div class="container-fluid mt-4 fade-in" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="text-primary fw-bold" style="font-size: 1.8rem;">
                    <i class="fas fa-clock"></i> Daily Time Record (DTR)
                </h2>
            </div>

            <div class="card shadow-lg border-0 rounded-4 mb-4 fade-in" data-aos="fade-up" data-aos-delay="100">
                <div class="card-body p-4 bg-light">
                    <form method="GET" action="{{ route('dtr.index') }}" class="row g-3 align-items-end">
                        @if(session('typ_id') == 1 || session('typ_id') == 2)
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-dark">User Type</label>
                                <select name="usr_type" class="form-select rounded-3 shadow-sm text-center">
                                    <option value="">-- All Types --</option>
                                    <option value="admin" {{ request('usr_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="faculty" {{ request('usr_type') == 'faculty' ? 'selected' : '' }}>Faculty
                                    </option>
                                    <option value="student" {{ request('usr_type') == 'student' ? 'selected' : '' }}>Student
                                    </option>
                                    <option value="nonteaching" {{ request('usr_type') == 'nonteaching' ? 'selected' : '' }}>
                                        Non-Teaching</option>
                                    <option value="programhead" {{ request('usr_type') == 'programhead' ? 'selected' : '' }}>
                                        Program Head</option>
                                    <option value="sa" {{ request('usr_type') == 'sa' ? 'selected' : '' }}>SA</option>
                                </select>
                            </div>
                        @endif

                        <div class="col-md-2">
                            <button type="submit"
                                class="btn btn-primary w-100 shadow-sm rounded-3 d-flex align-items-center justify-content-center gap-2 hover-scale"
                                title="Search records">
                                <i class="fas fa-search"></i> <span class="fw-semibold">Search</span>
                            </button>
                        </div>

                        @if(request()->filled('usr_type'))
                            <div class="col-md-2">
                                <a href="{{ route('dtr.index') }}"
                                    class="btn btn-outline-secondary w-100 shadow-sm rounded-3 d-flex align-items-center justify-content-center gap-2 hover-scale"
                                    title="Reset filters">
                                    <i class="fas fa-times"></i> <span class="fw-semibold">Reset</span>
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <div class="card shadow-sm fade-in" data-aos="fade-up" data-aos-delay="100">
                <div class="card-body table-responsive">
                    <table id="summaryTable" class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                @if(session('typ_id') == 1)
                                    <th class="col-equal">School</th>
                                @endif
                                <th class="col-equal">Name</th>
                                <th class="col-equal">User Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    @if(session('typ_id') == 1)
                                        <td class="col-equal">{{ $user->accName }}</td>
                                    @endif
                                    <td class="col-equal">{{ $user->emp_name }}</td>
                                    <td class="col-equal">
                                        @php
                                            $userTypes = [
                                                1 => 'Super Admin',
                                                2 => 'School Admin',
                                                3 => 'Faculty',
                                                4 => 'Student',
                                                5 => 'Non-Teaching',
                                                6 => 'Program Head',
                                                7 => 'SA'
                                            ];
                                        @endphp
                                        {{ $userTypes[$user->usrType] ?? 'Unknown' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('dtr.user', ['id' => $user->usrID]) }}" class="btn btn-info btn-sm">
                                            View DTR
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3" data-aos="fade-up" data-aos-delay="300">
                <span class="badge badge-total">Total Regular Hours: {{ $total_reg }} hrs</span>
                <span class="badge badge-total ms-2">Total OT Hours: {{ $total_ot }} hrs</span>
            </div>
        </div>
    </section>
@endsection