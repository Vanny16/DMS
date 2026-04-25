@extends('templates.backend.layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Members</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        @include('templates.backend.partials.alerts') 

        <div class="card">
            <div class="card-header">
                Active Members
            </div>
            <div class="card-body">
                <table style="width:100%" class="table table-hover table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Birth Date</th>
                            <th>Standing</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->mem_code }}</td>
                                <td>
                                    {{ $member->mem_last_name }}, {{ $member->mem_first_name }} {{ $member->mem_middle_name }}
                                </td>
                                <td>{{ $member->mem_email }}</td>
                                <td>{{ $member->mem_bdate }}</td>
                                <td>
                                    @if($member->mem_is_good_standing == '0')
                                        <span class="badge badge-danger">Viewing only</span>
                                    @else
                                        <span class="badge badge-success">Can Vote</span>
                                    @endif
                                    @if($member->mem_can_be_nominated == '0')
                                        @if($member->mem_decline_reason <> '')
                                            <span class="badge badge-danger" data-toggle="tooltip" title="{{ $member->mem_decline_reason }}">Declined nomination</span>
                                        @else
                                            <span class="badge badge-danger">Cannot be nominated</span>
                                        @endif
                                    @else
                                        <span class="badge badge-success">Can be nominated</span>
                                    @endif
                                </td>
                                <td>
                                    @if($member->mem_has_nominated == '0')
                                        <span class="badge badge-warning">Not Voted</span>
                                    @elseif($member->mem_has_nominated == '1')
                                        <span class="badge badge-info">Has Nominated</span>
                                    @elseif($member->mem_has_voted1 == '1')
                                        <span class="badge badge-success">Has Voted</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-success btn-sm" href="{{ action('MemberController@edit',[$member->mem_id]) }}"><span class="fa fa-eye"></span> Details</a>
                                    <a class="btn btn-danger btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#deleteModal-{{ $member->mem_id }}"><span class="fa fa-trash"></span> Deactivate</a>
                                </td>
                            </tr>

                            <div id="deleteModal-{{ $member->mem_id }}" class="modal fade" role="dialog">
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
                                            <a class="btn btn-danger btn-sm" href="{{ action('MemberController@delete',[$member->mem_id]) }}"><span class="fa fa-trash"></span> Deactivate</a>
                                        </div>
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