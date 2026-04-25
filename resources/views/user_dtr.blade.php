@extends('templates.backend.layouts.main')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .img-thumbnail {
            transition: transform 0.2s ease;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
        }

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
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({ duration: 800, once: true });

            // Summary Table
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
                    const lengthSelect = document.querySelector('#summaryTable_length select');
                    if (lengthSelect) {
                        lengthSelect.classList.add('form-select', 'form-select-sm', 'd-inline-block', 'w-auto', 'ms-2');
                    }
                }
            });

            // User DTR Table
            $('#userDtrTable').DataTable({
                responsive: true,
                pageLength: 31,
                order: [[0, 'desc']],
                pagingType: "simple_numbers",
                language: {
                    lengthMenu: '_MENU_ entries per page',
                    paginate: {
                        previous: '«',
                        next: '»'
                    }
                },
                initComplete: function () {
                    const lengthSelect = document.querySelector('#userDtrTable_length select');
                    if (lengthSelect) {
                        lengthSelect.classList.add('form-select', 'form-select-sm', 'd-inline-block', 'w-auto', 'ms-2');
                    }
                }
            });

            document.querySelectorAll('.edit-icon').forEach(button => {
                button.addEventListener('click', function () {
                    const wrapper = this.closest('.editable-remarks');
                    const form = wrapper?.nextElementSibling;

                    if (wrapper && form) {
                        wrapper.classList.add('d-none');
                        form.classList.remove('d-none');

                        const input = form.querySelector('input[name="tme_remarks"]');
                        if (input) input.focus();
                    }
                });
            });
        });
    </script>
@endpush

@section('content')
    <section class="content">
        <div class="container-fluid mt-4 fade-in" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="text-primary fw-bold">
                    <i class="fas fa-user-clock"></i>
                    {{ $user->usrFirstName }} {{ $user->usrLastName }} - DTR Records
                </h2>
                <a href="{{ route('dtr.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

            <div class="card shadow-sm fade-in" data-aos="fade-up" data-aos-delay="100">
                <div class="card-body table-responsive">
                    <table id="userDtrTable" class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th style="width: 9%;">Date</th>
                                <th style="width: 7%;">AM IN</th>
                                <th style="width: 7%;">AM OUT</th>
                                <th style="width: 7%;">PM IN</th>
                                <th style="width: 7%;">PM OUT</th>
                                <th style="width: 6%;">OT IN</th>
                                <th style="width: 7%;">OT OUT</th>
                                <th style="width: 7%;">REG HRS</th>
                                <th style="width: 7%;">OT HRS</th>
                                <th style="width: 17%;">Remarks</th>
                                <th style="width: 17%;">Admin Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dtrs as $record)
                                <tr>
                                    {{-- DATE & TIME COLUMNS --}}
                                    <td>{{ \Carbon\Carbon::parse($record->tme_date)->format('m/d/Y') }}</td>
                                    <td>{{ $record->tme_am_in ? \Carbon\Carbon::parse($record->tme_am_in)->format('g:i A') : '' }}
                                    </td>
                                    <td>{{ $record->tme_am_out ? \Carbon\Carbon::parse($record->tme_am_out)->format('g:i A') : '' }}
                                    </td>
                                    <td>{{ $record->tme_pm_in ? \Carbon\Carbon::parse($record->tme_pm_in)->format('g:i A') : '' }}
                                    </td>
                                    <td>{{ $record->tme_pm_out ? \Carbon\Carbon::parse($record->tme_pm_out)->format('g:i A') : '' }}
                                    </td>
                                    <td>{{ $record->tme_ot_in ? \Carbon\Carbon::parse($record->tme_ot_in)->format('g:i A') : '' }}
                                    </td>
                                    <td>{{ $record->tme_ot_out ? \Carbon\Carbon::parse($record->tme_ot_out)->format('g:i A') : '' }}
                                    </td>
                                    <td>{{ $record->tme_reg_total }}</td>
                                    <td>{{ $record->tme_ot_total }}</td>

                                    {{-- USER REMARKS --}}
                                    <td>
                                        <div class="position-relative">
                                            {{-- User Remarks --}}
                                            <strong>{{ $record->tme_remarks ?? 'No Remarks' }}</strong>

                                            {{-- Show photo filename as link if photo exists --}}
                                            @if(!empty($record->tme_photo))
                                                <a href="{{ asset('images/dtr/' . $record->tme_photo) }}" target="_blank"
                                                    class="d-block mt-1 text-decoration-underline text-info"
                                                    title="Click to view user image in a new tab">
                                                    {{ basename($record->tme_photo) }}
                                                </a>
                                            @else
                                                <div class="mt-1 text-muted">No file uploaded</div>
                                            @endif

                                            {{-- Edit button for non-admin users --}}
                                            @if(session('typ_id') != 1 && session('typ_id') != 2)
                                                <button type="button"
                                                    class="btn btn-link p-0 position-absolute top-0 end-0 text-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editUserRemarksModal{{ $record->tme_id }}"
                                                    title="Edit Your Remarks">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            @endif
                                        </div>

                                        {{-- Include user remarks modal --}}
                                        @include('templates.frontend.partials.dtr_user_modal', ['record' => $record])
                                    </td>


                                    {{-- ADMIN REMARKS --}}
                                    <td>
                                        <div class="position-relative">
                                            {{-- Admin Remarks --}}
                                            <strong>{{ $record->tme_admin_remarks ?? 'No Remarks' }}</strong>

                                            {{-- Show photo filename as a link if photo exists --}}
                                            @php
                                                $adminPhoto = $record->tme_admin_photo ?? null;
                                            @endphp

                                            @if (!empty($adminPhoto))
                                                <a href="{{ asset('images/dtr/' . $adminPhoto) }}" target="_blank"
                                                    class="d-block mt-1 text-decoration-underline text-info small"
                                                    title="Click to view admin photo in new tab">
                                                    {{ basename($adminPhoto) }}
                                                </a>
                                            @else
                                                <div class="mt-1 text-muted small">No file uploaded</div>
                                            @endif

                                            {{-- Edit button for Admins --}}
                                            @if(session('typ_id') == 1 || session('typ_id') == 2)
                                                <button type="button"
                                                    class="btn btn-link p-0 position-absolute top-0 end-0 text-success"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editAdminRemarksModal{{ $record->tme_id }}"
                                                    title="Edit Admin Remarks">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            @endif
                                        </div>

                                        {{-- Admin remarks modal --}}
                                        @include('templates.frontend.partials.dtr_admin_modal', ['record' => $record])
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3" data-aos="fade-up" data-aos-delay="300">
                <span class="badge bg-primary">Total Regular Hours: {{ $total_reg }} hrs</span>
                <span class="badge bg-info ms-2">Total OT Hours: {{ $total_ot }} hrs</span>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function focusModalInput(modalPrefix, inputName) {
                document.querySelectorAll(`button[data-bs-target^="${modalPrefix}"]`).forEach(button => {
                    button.addEventListener('click', () => {
                        const modalId = button.getAttribute('data-bs-target');
                        const modal = document.querySelector(modalId);
                        if (modal) {
                            const observer = new MutationObserver(() => {
                                if (modal.classList.contains('show')) {
                                    const input = modal.querySelector(`input[name="${inputName}"]`);
                                    if (input) input.focus();
                                    observer.disconnect();
                                }
                            });
                            observer.observe(modal, { attributes: true, attributeFilter: ['class'] });
                        }
                    });
                });
            }

            focusModalInput('#editUserRemarksModal', 'tme_remarks');
            focusModalInput('#editAdminRemarksModal', 'tme_admin_remarks');

            window.previewImage = function (input, previewId) {
                const file = input.files[0];
                const preview = document.getElementById(previewId);

                if (file && preview) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                } else if (preview) {
                    preview.src = '';
                    preview.classList.add('d-none');
                }
            };
        });
    </script>

    <script>
        function previewImage(input, previewId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('d-none');
            }
        }
    </script>


@endsection