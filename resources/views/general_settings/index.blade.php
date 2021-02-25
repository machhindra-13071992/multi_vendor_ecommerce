@extends('layouts.default')

@section('content')
<style>
.label-info {background-color: #2bafff !important;}
</style>
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-heading border bottom">
                <h4 class="card-title">General Settings</h4>
            </div>
            <div class="card-block">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12 ml-auto mr-auto">
                            @if(isset($general_settings))
                                {!! Form::model($general_settings, ['id'=>'form-validation','novalidate'=>"novalidate",'enctype'=>"multipart/form-data",'method' => 'PATCH','route' => ['general_settings.update', $general_settings->id]]) !!}
                            @else
                                {!! Form::open(['route' => 'general_settings.store', 'method' => 'POST', 'role'=>'form','enctype'=>"multipart/form-data",'id'=>'form-validation', 'novalidate'=>"novalidate"]) !!}
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        {!! Form::Label('site_name', 'Site Name') !!}
                                        {!! Form::text('site_name', null, ['class' => 'form-control', 'placeholder'=>'Site Name', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        {!! Form::Label('site_description', 'Site Description') !!}
                                        {!! Form::text('site_description', null, ['class' => 'form-control', 'placeholder'=>'Site Description', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        {!! Form::Label('meta_title', 'Meta title') !!}
                                        {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder'=>'Meta title', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        {!! Form::Label('meta_key', 'Meta keywords') !!}
                                        {!! Form::text('meta_key', null, ['class' => 'form-control', 'placeholder'=>'Meta keywords', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group required">
                                        {!! Form::Label('meta_desc', 'Meta description') !!}
                                        {!! Form::text('meta_desc', null, ['class' => 'form-control', 'placeholder'=>'Meta description', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::hidden('created_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('user_id', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('uuid',$uuid,['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('modified_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <button class="btn btn-primary">Update</button>
                            <button class="btn btn-default" type="reset">Reset</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</div>
@endsection