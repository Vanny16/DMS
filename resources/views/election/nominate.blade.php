@extends('templates.backend.layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Nomination</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @include('templates.backend.partials.alerts') 

        @if($member->mem_has_nominated == '0')

            @if(is_nomination_start()==true)
                @if(is_nomination_end()==false)
                    <form action="{{ action('ElectionController@nominateSubmit') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="nom_nominated_id">Nominations (Board of Trustees)<span style="color:red;">* (maximum of 9 nominees)</span></label>
                                <select id="nom_nominated_id" class="select2" multiple="multiple" data-placeholder="Select nominees" style="width: 100%;" name="nom_nominated_id[]" required>
                                    @foreach($members as $member)
                                        <option value="{{ $member->mem_id }}">{{ $member->mem_last_name }}, {{ $member->mem_first_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="zone_nominated_id">Nominations (Zone Representative)<span style="color:red;">* (select 1 nominee)</span></label>
                                <select id="zone_nominated_id" class="form-control" data-placeholder="Select nominee" style="width: 100%;" name="zone_nominated_id" required>
                                    @foreach($zone_members as $member)
                                        <option value="{{ $member->mem_id }}">{{ $member->mem_last_name }}, {{ $member->mem_first_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <button type="button" class="btn btn-primary px-5" data-toggle="modal" data-target="#myModal">Submit Nomination</button>
                            </div>
                        </div>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Confirm Your Nomination!</h4>
                                        <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Once you submit your nomination, your choice(s) will be considered as final and can no longer be voided or changed.</p>
                                        <p>Confirm your choice below:</p>
                                        <button type="submit" class="btn btn-primary"><span class="fa fa-thumbs-up"></span> Submit Nomination</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="fa fa-times-circle"></span> Let me review my choice(s)</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="alert alert-danger">
                        <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                        Nomination period has already ended.
                    </div>
                @endif
            @else
                <div class="alert alert-warning">
                    <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                    Nomination period has not yet started.
                </div>
            @endif

        @else

            @if(is_nomination_start()==true)
                @if(is_nomination_end()==false)
                        <div class="alert alert-success">
                        <h5><i class="icon fa fa-info-circle"></i> Alert!</h5>
                        Nomination period is on going.
                    </div>
                @else
                    <div class="alert alert-danger">
                        <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                        Nomination period has already ended.
                    </div>
                @endif
            @else
                <div class="alert alert-warning">
                    <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                    Nomination period has not yet started.
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-12"> 
                    <div class="card card-secondary">
                        <div class="card-header">
                            My Nominations (Board of Trustees)
                        </div>
                        <div class="card-body">
                            <table style="width:100%" class="table table-hover table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Sector</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nominations as $nomination)
                                    <tr>
                                        <td>
                                            {{ $nomination->mem_last_name }}, {{ $nomination->mem_first_name }} {{ $nomination->mem_middle_name }}
                                        </td>
                                        <td>
                                            {{ $nomination->mem_sector }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12"> 
                    <div class="card card-secondary">
                        <div class="card-header">
                            My Nominations (Zone Representative)
                        </div>
                        <div class="card-body">
                            <table style="width:100%" class="table table-hover table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Sector</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($zone_nominations as $nomination)
                                    <tr>
                                        <td>
                                            {{ $nomination->mem_last_name }}, {{ $nomination->mem_first_name }} {{ $nomination->mem_middle_name }}
                                        </td>
                                        <td>
                                            {{ $nomination->mem_sector }}
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

<script type="text/javascript">
    document.getElementById('nom_nominated_id').onchange = function(e) {
        var selectedOptions = $('#nom_nominated_id option:selected');
        if (selectedOptions.length >= 10) {
            selectedOptions.removeAttr("selected");
            alert('You have already selected more than the allowed limit. Please limit your selection to 9 nominees only.');
        }
    };
</script>

@endsection