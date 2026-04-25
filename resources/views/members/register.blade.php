@extends('templates.frontend.layouts.main')
@section('content')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('{{ asset('frontend/images/bg_1.jpg') }}')">
        <div class="container">
            <div class="row align-items-end justify-content-center text-center">
                <div class="col-lg-7">
                    <h2 class="mb-0">Register</h2>
                    <p>All registration for membership will undergo screening process.</p>
                </div>
            </div>
        </div>
    </div> 
    
    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ action('MainController@home') }}">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Member Registration</span>
        </div>
    </div>

    @if(session('errorMessage'))
    <div class="site-section">
        <div class="container">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                You have already registered using this e-mail adrress. Please <a href="{{ action('MemberController@login') }}">LOGIN</a> instead.
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <h2><strong>Member Registration</strong></h2>
            <p>Completely fill-out the form below and submit for membership evaluation.</p>
            <div class="row">
                <div class="col-md-12 mx-0">
                    <div class="track">
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"><small>Register</small></span></div>
                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><small>Approval</small></span></div>
                        <div class="step"> <span class="icon"> <i class="fa fa-tasks"></i> </span> <span class="text"><small>Nominate</small></span></div>
                        <div class="step"> <span class="icon"> <i class="fa fa-star-half-full"></i> </span> <span class="text"><small>Vote</small></span></div>
                        <div class="step"> <span class="icon"> <i class="fa fa-line-chart"></i> </span> <span class="text"><small>Results</small></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <form action="{{ action('MemberController@save') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="mem_last_name">Family Name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="mem_last_name" id="mem_last_name" value="{{ old('mem_last_name') }}" required/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="mem_first_name">First Name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="mem_first_name" id="mem_first_name" value="{{ old('mem_first_name') }}" required/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="mem_middle_name">Middle Name</label>
                            <input type="text" class="form-control" name="mem_middle_name" id="mem_middle_name" value="{{ old('mem_middle_name') }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="mem_sex">Sex <span style="color:red;">*</span></label>
                            <select class="form-control" id="mem_sex" name="mem_sex">
                                @if(old('mem_sex')=='F')
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
                            <input type="date" class="form-control" name="mem_bdate" id="mem_bdate" value="{{ old('mem_bdate') }}" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="mem_address">Address</label>
                            <input type="text" class="form-control" name="mem_address" id="mem_address" value="{{ old('mem_address') }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="zone_id">Zone <span style="color:red;">*</span></label>
                            <select class="form-control" id="zone_id" name="zone_id">
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->zone_id }}">{{ $zone->zone_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="mem_mobile">Mobile Number <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="mem_mobile" id="mem_mobile" minlength="10" maxlength="11" value="{{ old('mem_mobile') }}" required/>
                            <span class="form-text small" style="color:red;">11 digit format eg. 09109005555</span>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="mem_email">Email Address <span style="color:red;">*</span></label>
                            <input type="email" class="form-control" name="mem_email" id="mem_email" value="{{ old('mem_email') }}" required/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="mem_fb">Facebook Profile Link</label>
                            <input type="text" class="form-control" name="mem_fb" id="mem_fb" value="{{ old('mem_fb') }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="mem_sector">Sector <span style="color:red;">*</span></label>
                            <select class="form-control" id="mem_sector" name="mem_sector">
                                @if(old('mem_sector')=='public')
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
                            <input type="text" class="form-control" name="mem_prc" id="mem_prc" value="{{ old('mem_prc') }}" required/>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="mem_prc_image">Attach License <span style="color:red;">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="mem_prc_image" name="mem_prc_image" required/>
                                <label class="custom-file-label" for="mem_prc_image">Choose file</label>
                                <span class="form-text small" style="color:red;">Allowed files: jpg and png only</span>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="mem_image">Attach Your Photo <span style="color:red;">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="mem_image" name="mem_image" required/>
                                <label class="custom-file-label" for="mem_image">Choose file</label>
                                <span class="form-text small" style="color:red;">Allowed files: jpg and png only (preferably 1x1 or 2x2)</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

@endsection