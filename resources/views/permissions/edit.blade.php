@extends('layouts.default')

@section('content')
<style>
.label-info {background-color: #2bafff !important;}
</style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('permissions.index') }}"> <i class="fa fa-arrow-circle-left"></i> Back To Listing </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading border bottom">
                    <h4 class="card-title">Update permissions</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                {!! Form::model($permissions, ['id'=>'form-validation', 'novalidate'=>"novalidate",'method' => 'PATCH','route' => ['permissions.update', $permissions->id]]) !!}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group required">
												{!! Form::hidden('id', $permissions->id, [ ]); !!}
                                                {!! Form::Label('name', 'Permission Name') !!}
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Permission', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::Label('description', 'Description') !!}
                                                {!! Form::text('description', null, ['class' => 'form-control', 'placeholder'=>'Role description']) !!}
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::Label('active', 'Active') !!}
                                                <div class="col-md-10">
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('status', '0', true, ['class'=>'radio','id'=>'rad1']) }}
                                                        <label for="rad1">No</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        {{ Form::radio('status', '1', true, ['class'=>'radio','id'=>'rad2']) }}
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
                                    <a href="{{ route('permissions.index')}}" class="btn btn-danger">Cancel</a>
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