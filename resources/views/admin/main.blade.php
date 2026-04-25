@extends('templates.backend.layouts.main')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Home</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3></h3>
                        <p>TOTAL MEMBERS</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{ action('AdminController@members') }}" class="small-box-footer">Registered members <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3></h3>
                        <p>MEMBERS IN GOOD STANDING</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-thumbs-up"></i>
                    </div>
                    <a href="{{ action('AdminController@migs') }}" class="small-box-footer">Members who can vote <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3></h3>
                        <p>NOMINATED</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-star-half"></i>
                    </div>
                    <a href="{{ action('AdminController@nominated') }}" class="small-box-footer">Members who have already nominated <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3></h3>
                        <p>VOTED</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="{{ action('AdminController@voted') }}" class="small-box-footer">Members who have already voted <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <hr />

        <div class="card-body">
            <h4>Election Process Results</h4>
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-content-below-home-tab" data-bs-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Nominations</a>
                </li>
                @if(session('is_admin') == '1')
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-profile-tab" data-bs-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Election - Board of Trustees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-profile2-tab" data-bs-toggle="pill" href="#custom-content-below-profile2" role="tab" aria-controls="custom-content-below-profile2" aria-selected="false">Election - Zone Representative</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-messages-tab" data-bs-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Election - Officers</a>
                    </li>
                @endif
            </ul>

            <div class="tab-content" id="custom-content-below-tabContent">
                <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                    <br/>

                    @php
                        $zoneList = [
                            'Board of Trustees',
                            'Zone Representative - Davao City',
                            'Zone Representative - Davao Oriental',
                            'Zone Representative - Davao del Norte',
                            'Zone Representative - Davao de Oro'
                        ];
                    @endphp

                    @foreach ($zoneList as $zone)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        Nominated Members ({{ $zone }})
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
                                                {{-- Nomination data goes here --}}
                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
