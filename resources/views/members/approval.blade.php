@extends('templates.backend.layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Member Registration</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @include('templates.backend.partials.alerts') 

        <div class="card">
            <div class="card-header">
                Member Requests
            </div>
            <div class="card-body">
                <table id="example1" style="width:100%" class="table table-hover table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Birth Date</th>
                            <th>Sector</th>
                            <th>PRC Lic. No.</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                        <tr>
                            <td>
                                {{ $member->mem_last_name }}, {{ $member->mem_first_name }} {{ $member->mem_middle_name }}
                            </td>
                            <td>{{ $member->mem_sex }}</td>
                            <td>{{ $member->mem_bdate }}</td>
                            <td>{{ $member->mem_sector }}</td>
                            <td><a href="{{ action('MemberController@downloadID',[$member->mem_id]) }}">{{ $member->mem_prc }} <span class="fa fa-download"></span></a></td>
                            <td class="text-right">
                                <a class="btn btn-info btn-sm" href="{{ action('MemberController@view',[$member->mem_id]) }}"><span class="fa fa-eye"></span> Details</a>
                                <a class="btn btn-success btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#approveModal-{{ $member->mem_id }}"><span class="fa fa-check"></span> Approve</a>
                                <a class="btn btn-danger btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#disapproveModal-{{ $member->mem_id }}"><span class="fa fa-trash"></span> Disapprove</a>
                            </td>
                        </tr>

                        <div id="disapproveModal-{{ $member->mem_id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Confirm Deletion</h4>
                                        <button type="button pull-right" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to deactivate {{ $member->mem_last_name }}, {{ $member->mem_first_name }} {{ $member->mem_middle_name }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-danger btn-sm" href="{{ action('MemberController@disapprove',[$member->mem_id]) }}"><span class="fa fa-trash"></span> Disapprove</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="approveModal-{{ $member->mem_id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Confirm Approval</h4>
                                        <button type="button pull-right" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{ action('MemberController@approve') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="mem_status">Membership Status <span style="color:red;">*</span></label>
                                            <select class="form-control" id="mem_status" name="mem_status">
                                                <option value="1" selected>GOOD STANDING</option>
                                                <option value="0">NOT IN GOOD STANDING</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mem_can_be_nominated">Can member be nominated? <span style="color:red;">*</span></label>
                                            <select class="form-control" id="mem_can_be_nominated" name="mem_can_be_nominated">
                                                <option value="1" selected>CAN BE NOMINATED</option>
                                                <option value="0">CANNOT BE NOMINATED</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="mem_id" id="mem_id" value="{{ $member->mem_id }}" required/>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success"><span class="fa fa-check"></span> Approve</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</section>

@endsection