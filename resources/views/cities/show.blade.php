@extends('layouts.default')

@section('content')
    <div class="page-title">
        <h4>Account Setting</h4>
    </div>
    <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-info" href="{{ route('cities.index') }}">  <i class="fa fa-arrow-circle-left"></i> Cities </a>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-heading border bottom">
                            <h4 class="card-title">City Info</h4>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="mrg-top-10 text-dark"> <b>Name</b></p>
                                </div>
                                <div class="col-md-6">
                                    {{ $cities['name'] }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="mrg-top-10 text-dark"> <b>Country Name</b></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mrg-top-10">{{ $cities['countries']['name'] }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="mrg-top-10 text-dark"> <b>State Name</b></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mrg-top-10">{{ $cities['states']['name'] }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="mrg-top-10 text-dark"> <b>Status</b></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mrg-top-10">
                                        <span class="mrg-left-10"><td>@if ($cities->active == 1) <span class="text-success"><i class="fa fa-check"></i></span> @else <span class="text-danger"><i class="fa fa-times"></i></span> @endif </td></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection