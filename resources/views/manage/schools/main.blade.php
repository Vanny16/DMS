@extends('templates.backend.layouts.main')

@section('content')

<style>
    .page-header-modern {
        background: linear-gradient(135deg, #20c997, #0d6efd);
        border-radius: 18px;
        padding: 25px;
        color: #fff;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,.12);
    }

    .modern-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0,0,0,.08);
    }

    .modern-table thead th {
        background: #f8fafc;
        font-size: 13px;
        text-transform: uppercase;
    }

    .btn-modern {
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
    }
</style>

<div class="content-header">
    <div class="container-fluid">

        <div class="page-header-modern d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h2 class="mb-1 font-weight-bold">School Management</h2>
                <p class="mb-0">Manage list of registered schools.</p>
            </div>

            <button class="btn btn-light btn-modern"
                data-toggle="modal"
                data-target="#createSchoolModal">

                <i class="fa fa-plus"></i> Add School
            </button>

        </div>

    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card modern-card">

            <div class="card-header">
                <h5 class="mb-0 font-weight-bold">
                    <i class="fa fa-school text-primary"></i>
                    School List
                </h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover modern-table" id="example1">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>BEIS No</th>
                                <th>School Name</th>
                                <th>Region</th>
                                <th>Division</th>
                                <th>District</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($schools as $school)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $school->beis_school_no }}</td>
                                    <td>{{ $school->school_name }}</td>
                                    <td>{{ $school->region }}</td>
                                    <td>{{ $school->division_id }}</td>
                                    <td>{{ $school->district_id }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </div>
</section>

{{-- MODAL --}}
<div class="modal fade" id="createSchoolModal">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form method="POST" action="{{ route('manage_schools.save') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-plus"></i> Add School
                    </h5>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>BEIS School No</label>
                                <input type="text" name="beis_school_no" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>School Name</label>
                                <input type="text" name="school_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Region</label>
                                <input type="text" name="region" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Division ID</label>
                                <input type="text" name="division_id" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>District ID</label>
                                <input type="text" name="district_id" class="form-control" required>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success btn-modern" type="submit">
                        <i class="fa fa-save"></i> Save
                    </button>

                    <button type="button" class="btn btn-secondary btn-modern" data-dismiss="modal">
                        Cancel
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
