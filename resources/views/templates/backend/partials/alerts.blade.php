

@if(session('errorMessage'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-ban"></i> Alert!</h5>
    {!! session('errorMessage') !!}
</div>
@endif
@if(session('successMessage'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-check"></i> Alert!</h5>
    {!! session('successMessage') !!}
</div>
@endif
@if(session('infoMessage'))
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-info"></i> Alert!</h5>
    {!! session('infoMessage') !!}
</div>
@endif
@if(session('warningMessage'))
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fa fa-exclamation-triangle"></i> Alert!</h5>
    {!! session('warningMessage') !!}
</div>
@endif


