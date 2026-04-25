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
                Member Details
            </div>
            <div class="card-body">
                <form action="{{ action('MemberController@update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="mem_last_name">Family Name <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="mem_last_name" id="mem_last_name" value="{{ $member->mem_last_name }}" required/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="mem_first_name">First Name <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="mem_first_name" id="mem_first_name" value="{{ $member->mem_first_name }}" required/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="mem_middle_name">Middle Name</label>
                                <input type="text" class="form-control" name="mem_middle_name" id="mem_middle_name" value="{{ $member->mem_middle_name }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="mem_sex">Sex <span style="color:red;">*</span></label>
                                <select class="form-control" id="mem_sex" name="mem_sex">
                                    @if($member->mem_sex=='F')
                                        <option value="M">MALE</option>
                                        <option value="F" selected>FEMALE</option>
                                    @else
                                        <option value="M" selected>MALE</option>
                                        <option value="F">FEMALE</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="mem_bdate">Birth Date <span style="color:red;">*</span></label>
                                <input type="date" class="form-control" name="mem_bdate" id="mem_bdate" value="{{ $member->mem_bdate }}" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 form-group">
                                <label for="mem_address">Address</label>
                                <input type="text" class="form-control" name="mem_address" id="mem_address" value="{{ $member->mem_address }}" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="zone_id">Zone <span style="color:red;">*</span></label>
                                <select class="form-control" id="zone_id" name="zone_id">
                                    @foreach($zones as $zone)
                                        @if($member->zone_id == $zone->zone_id)
                                            <option value="{{ $zone->zone_id }}" selected>{{ $zone->zone_name }}</option>
                                        @else
                                            <option value="{{ $zone->zone_id }}">{{ $zone->zone_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="mem_mobile">Mobile Number <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="mem_mobile" id="mem_mobile" minlength="10" maxlength="11" value="{{ $member->mem_mobile }}" required/>
                                <span class="form-text small" style="color:red;">11 digit format eg. 09109005555</span>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="mem_email">Email Address <span style="color:red;">*</span></label>
                                <input type="email" class="form-control" name="mem_email" id="mem_email" value="{{ $member->mem_email }}" required/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="mem_fb">Facebook Profile Link</label>
                                <input type="text" class="form-control" name="mem_fb" id="mem_fb" value="{{ $member->mem_fb }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="mem_sector">Sector <span style="color:red;">*</span></label>
                                <select class="form-control" id="mem_sector" name="mem_sector">
                                    @if($member->mem_sector=='public')
                                        <option value="private">PRIVATE</option>
                                        <option value="public" selected>PUBLIC</option>
                                    @else
                                        <option value="private" selected>PRIVATE</option>
                                        <option value="public">PUBLIC</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="mem_prc">PRC License No. <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="mem_prc" id="mem_prc" value="{{ $member->mem_prc }}" required/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="mem_prc_image">Download License <span style="color:red;">*</span></label>
                                <div class="custom-file">
                                    <a class="btn btn-info" href="{{ action('MemberController@downloadID',[$member->mem_id]) }}"><span class="fa fa-download"></span> Download</a>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="mem_image">Download Photo <span style="color:red;">*</span></label>
                                <div class="custom-file">
                                    <a class="btn btn-info" href="{{ action('MemberController@downloadPhoto',[$member->mem_id]) }}"><span class="fa fa-download"></span> Download</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="mem_status">Membership Status <span style="color:red;">*</span></label>
                                <select class="form-control" id="mem_status" name="mem_status">
                                    @if($member->mem_is_good_standing=='1')
                                        <option value="1" selected>GOOD STANDING</option>
                                        <option value="0">NOT IN GOOD STANDING</option>
                                    @else
                                        <option value="1">GOOD STANDING</option>
                                        <option value="0" selected>NOT IN GOOD STANDING</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="mem_can_be_nominated">Can member be nominated? <span style="color:red;">*</span></label>
                                <select class="form-control" id="mem_can_be_nominated" name="mem_can_be_nominated">
                                    @if($member->mem_can_be_nominated=='1')
                                        <option value="1" selected>CAN BE NOMINATED</option>
                                        <option value="0">CANNOT BE NOMINATED</option>
                                    @else
                                        <option value="1">CAN BE NOMINATED</option>
                                        <option value="0" selected>CANNOT BE NOMINATED</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" name="mem_id" id="mem_id" value="{{ $member->mem_id }}" required/>
                                <button type="submit" class="btn btn-primary btn-lg px-5">Save Changes</button>
                                <a class="btn btn-primary btn-lg px-5" href="{{ action('MemberController@list') }}"><span class="fa fa-arrow-left"></span> Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection