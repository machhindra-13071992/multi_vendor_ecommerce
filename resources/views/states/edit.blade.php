@extends('layouts.default')

@section('content')
<!-- <div class="page-title">
    <h4>User Add</h4>
</div> -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-info" href="{{ route('states.index') }}"> <i class="fa fa-arrow-circle-left"></i> Back</a>
        </div>
    </div>
</div>
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading border bottom">
                    <h4 class="card-title">Update Details</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                {!! Form::model($states, ['id'=>'form-validation', 'novalidate'=>"novalidate",'method' => 'PATCH','route' => ['states.update', $states->id]]) !!}
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {!! Form::Label('name', 'Name') !!}
                                                {!! Form::hidden('id', $states->id, [ ]); !!}
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Enter your name', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                {!! Form::Label('country_id', 'Country Name') !!}
                                                {!! Form::select('country_id',['' => 'Select'] + $countries, null, ['class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::Label('active', 'Active') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('active', '0', true, ['class'=>'radio','id'=>'rad1']) }}
                                                        <label for="rad1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('active', '1', true, ['class'=>'radio','id'=>'rad2']) }}
                                                        <label for="rad2">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::hidden('created_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                            {!! Form::hidden('modified_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Submit</button>
                                    <a href="{{ route('states.index')}}" class="btn btn-danger">Cancel</a>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection