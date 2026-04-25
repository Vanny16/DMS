@extends('templates.backend.layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Members Who Nominated</h1> 
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div  class="card-header">
                Members who have already nominated
            </div>
            <div class="card-body">
                <table style="width:100%" class="table table-hover table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Zone</th>
                            <th>Date Nominated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>
                                    {{ $member->mem_last_name }}, {{ $member->mem_first_name }} {{ $member->mem_middle_name }}
                                </td>
                                <td>{{ $member->zone_name }}</td>
                                <td>{{ $member->mem_date_nominated }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>

        <a href="{{ action('AdminController@main') }}" class="btn btn-default"><i class="fas fa-arrow-circle-left"></i> Back to Main</a>

    </div>
</section>

@endsection