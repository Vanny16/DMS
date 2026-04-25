<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Member Login</h4>
                <button type="button pull-right" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{ action([App\Http\Controllers\LoginController::class, 'validateUser']) }}">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="mem_email">E-mail</label>
                        <input type="email" class="form-control" name="mem_email" id="mem_email" required/>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="mem_code">Member Code</label>
                        <input type="password" class="form-control" name="mem_code" id="mem_code" required/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn" data-toggle="modal" data-target="#forgotModal" data-dismiss="modal" style="background-color:#ffd200;">Forgot Code</button>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="forgotModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Retrieve Member Code</h4>
                <button type="button pull-right" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ action('MemberController@retrieve') }}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="mem_email">E-mail</label>
                        <input type="email" class="form-control" name="mem_email" id="mem_email" required/>
                        <span class="form-text small" style="color:red;">Member Code will be sent to your e-mail address and mobile number (if available).</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Retrieve Code</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="registerModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Member Registration</h4>
                <button type="button pull-right" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ action('MemberController@save') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <p>Completely fill-out the form below and submit for membership evaluation.</p>
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            {{-- <div class="track">
                                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"><small>Register</small></span></div>
                                <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"><small>Approval</small></span></div>
                                <div class="step"> <span class="icon"> <i class="fa fa-tasks"></i> </span> <span class="text"><small>Nominate</small></span></div>
                                <div class="step"> <span class="icon"> <i class="fa fa-star-half-full"></i> </span> <span class="text"><small>Vote</small></span></div>
                                <div class="step"> <span class="icon"> <i class="fa fa-line-chart"></i> </span> <span class="text"><small>Results</small></span></div>
                            </div> --}}
                        </div>
                    </div>
                        <div class="col-md-12 form-group">
                            <label for="mem_last_name">Family Name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="mem_last_name" id="mem_last_name" value="{{ old('mem_last_name') }}" required/>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="mem_first_name">First Name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="mem_first_name" id="mem_first_name" value="{{ old('mem_first_name') }}" required/>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="mem_middle_name">Middle Name</label>
                            <input type="text" class="form-control" name="mem_middle_name" id="mem_middle_name" value="{{ old('mem_middle_name') }}" />
                        </div>
                        <div class="col-md-12 form-group">
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
                        <div class="col-md-12 form-group">
                            <label for="mem_bdate">Birth Date <span style="color:red;">*</span></label>
                            <input type="date" class="form-control" name="mem_bdate" id="mem_bdate" value="{{ old('mem_bdate') }}" required/>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="mem_address">Address</label>
                            <input type="text" class="form-control" name="mem_address" id="mem_address" value="{{ old('mem_address') }}" />
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="zone_id">Zone <span style="color:red;">*</span></label>
                            <select class="form-control" id="zone_id" name="zone_id">
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->zone_id }}">{{ $zone->zone_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="mem_mobile">Mobile Number <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="mem_mobile" id="mem_mobile" minlength="10" maxlength="11" value="{{ old('mem_mobile') }}" required/>
                            <span class="form-text small" style="color:red;">11 digit format eg. 09109005555</span>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="mem_email">Email Address <span style="color:red;">*</span></label>
                            <input type="email" class="form-control" name="mem_email" id="mem_email" value="{{ old('mem_email') }}" required/>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="mem_fb">Facebook Profile Link</label>
                            <input type="text" class="form-control" name="mem_fb" id="mem_fb" value="{{ old('mem_fb') }}" />
                        </div>
                        <div class="col-md-12 form-group">
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
                        <div class="col-md-12 form-group">
                            <label for="mem_prc">PRC License No. <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" name="mem_prc" id="mem_prc" value="{{ old('mem_prc') }}" required/>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="mem_prc_image">Attach License <span style="color:red;">*</span></label><br/>
                            {{-- <div class="custom-file"> --}}
                                <input type="file" id="mem_prc_image" name="mem_prc_image" required/>
                                {{-- <label class="custom-file-label" for="mem_prc_image">Choose file</label> --}}
                                <span class="form-text small" style="color:red;">Allowed files: jpg and png only</span>
                            {{-- </div> --}}
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="mem_image">Attach Your Photo <span style="color:red;">*</span></label><br/>
                            {{-- <div class="custom-file"> --}}
                                <input type="file" id="mem_image" name="mem_image" required/>
                                {{-- <label class="custom-file-label" for="mem_image">Choose file</label> --}}
                                <span class="form-text small" style="color:red;">Allowed files: jpg and png only (preferably 1x1 or 2x2)</span>
                            {{-- </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>