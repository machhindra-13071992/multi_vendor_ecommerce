@extends('layouts.default')
@section('content')

<style>
    .label-info {background-color: #2bafff !important;}
</style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('sub_categories.index') }}"> <i class="fa fa-arrow-circle-left"></i> Back To Listing </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading border bottom">
                    <h4 class="card-title">Edit Category</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                {!! Form::model($sub_categories, ['id'=>'form-validation','novalidate'=>"novalidate",'enctype'=>"multipart/form-data",'method' => 'PATCH','route' => ['sub_categories.update', $sub_categories->id]]) !!}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required">
                                                {!! Form::Label('category_id', 'Category') !!}
                                                {!! Form::select('category_id',['' => 'Select'] + $categories, null, array( 'class' => 'form-control','required')) !!}
                                            </div>
                                        </div>   
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required">
                                                {!! Form::Label('name', 'Sub Category') !!}
                                                {!! Form::hidden('id', $sub_categories->id, [ ]); !!}
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Sub Category', 'required']) !!}
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
                                    <a href="{{ route('sub_categories.index')}}" class="btn btn-danger">Cancel</a>
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