@extends('templates.backend.layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Election of Officers</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @include('templates.backend.partials.alerts') 

        @if($member->mem_has_voted2 == '0')

            @if(is_election2_start()==true)
                @if(is_election2_end()==false)
                    <form action="{{ action('ElectionController@elect2Submit') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($members as $member)
                                                <tr>
                                                    <td>{{ get_member_name($member->mem_elected_id) }}</td>
                                                    <td>
                                                        <input type="hidden" name="mem_elected_id[]" value="{{ $member->mem_elected_id }}">  
                                                        <select class="form-control" name="mem_position[]">
                                                            @foreach($positions as $position)
                                                                <option value="{{ $position->pos_id }}">{{ $position->pos_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <button type="button" class="btn btn-primary px-5" data-toggle="modal" data-target="#myModal">Cast Vote</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Confirm Your Vote!</h4>
                                        <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Once you submit your vote, your choice(s) will be considered as final and can no longer be voided or changed.</p>
                                        <p>Confirm your choice below:</p>
                                        <button type="submit" class="btn btn-primary"><span class="fa fa-thumbs-up"></span> Submit Vote</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="fa fa-times-circle"></span> Let me review my choice(s)</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="alert alert-danger">
                        <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                        Election period has already ended.
                    </div>
                @endif
            @else
                <div class="alert alert-warning">
                    <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                    Election period has not yet started.
                </div>
            @endif

        @else

            @if(is_election2_start()==true)
                @if(is_election2_end()==false)
                        <div class="alert alert-success">
                        <h5><i class="icon fa fa-info-circle"></i> Alert!</h5>
                        Election period is on going.
                    </div>
                @else
                    <div class="alert alert-danger">
                        <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                        Election period has already ended.
                    </div>
                @endif
            @else
                <div class="alert alert-warning">
                    <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                    Election period has not yet started.
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card card-secondary">
                        <div class="card-header">
                            My Votes (Officers)
                        </div>
                        <div class="card-body">
                            <table style="width:100%" class="table table-hover table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Sector</th>
                                        <th>Position</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($officers as $officer)
                                    <tr>
                                        <td>
                                            {{ $officer->mem_last_name }}, {{ $officer->mem_first_name }}
                                        </td>
                                        <td>
                                            {{ $officer->mem_sector }}
                                        </td>
                                        <td>
                                            {{ $officer->pos_name }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection