@extends('layouts.default')
@section('content')

<style>
    .label-info {background-color: #2bafff !important;}
</style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('countries.index') }}"> <i class="fa fa-arrow-circle-left"></i> Back To Listing </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading border bottom">
                    <h4 class="card-title">Edit Country</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                {!! Form::model($country, ['id'=>'form-validation', 'novalidate'=>"novalidate", 'method' => 'PATCH','route' => ['countries.update', $country->id]]) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group required">
                                                {!! Form::Label('name', 'Country') !!}
                                                {!! Form::hidden('id', $country->id, [ ]); !!}
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Country', 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::Label('alpha_2_code', 'Alpha 2 Code') !!}
                                                {!! Form::text('alpha_2_code', null, ['class' => 'form-control', 'placeholder'=>'Alpha 2 Code']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::Label('alpha_3_code', 'Alpha 3 Code') !!}
                                                {!! Form::text('alpha_3_code', null, ['class' => 'form-control', 'placeholder'=>'Alpha 3 Code']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::Label('calling_code', 'Calling Code') !!}
                                                {!! Form::text('calling_code', null, ['class' => 'form-control', 'placeholder'=>'Calling Code' ]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::Label('is_domestic_country', 'Is Domestic Country') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('is_domestic_country', '0', true, ['class'=>'radio','id'=>'rad12']) }}
                                                        <label for="rad12">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('is_domestic_country', '1', true, ['class'=>'radio','id'=>'rad22']) }}
                                                        <label for="rad22">Yes</label>
                                                    </div>
                                                </div>
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
                                    <a href="{{ route('countries.index')}}" class="btn btn-danger">Cancel</a>
                                    {{-- <button class="btn btn-default" type="reset">Reset</button> --}}
                                <!-- </form> -->
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection