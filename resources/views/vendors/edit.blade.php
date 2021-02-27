@extends('layouts.default')

@section('content')
<!-- <div class="page-title">
    <h4>User Add</h4>
</div> -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-info" href="{{ route('vendors.index') }}"> <i class="fa fa-arrow-circle-left"></i> Back</a>
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
            <div class="card-block">
                <div class="row">
                    <div class="col-md-7">
                        <h4 class="card-title">Add Vendor Account</h4>
                        {!! Form::model($vendors, ['id'=>'form-validation', 'novalidate'=>"novalidate",'method' => 'PATCH','route' => ['vendors.update', $vendors->id]]) !!}
                            <div class="form-group row">
                                <label for="form-1-1" class="col-md-2 control-label">First Name</label>
                                <div class="col-md-10">
                                    {!! Form::text('f_name', isset($vendors['users']['f_name'])?$vendors['users']['f_name']:null, ['class' => 'form-control', 'placeholder'=>'First Name','required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form-1-2" class="col-md-2 control-label">Last Name</label>
                                <div class="col-md-10">
                                    {!! Form::text('l_name', isset($vendors['users']['l_name'])?$vendors['users']['l_name']:null, ['class' => 'form-control', 'placeholder'=>'Last Name','required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form-1-3" class="col-md-2 control-label">Email</label>
                                <div class="col-md-10">
                                    {!! Form::email('email', isset($vendors['users']['email'])?$vendors['users']['email']:null, array('placeholder' => 'Enter Email', 'class' => 'form-control', 'required')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form-1-3" class="col-md-2 control-label">Mobile</label>
                                <div class="col-md-10">
                                    {!! Form::text('mobile_no', isset($vendors['users']['mobile_no'])?$vendors['users']['mobile_no']:null, array('placeholder' => 'Contact Number', 'class' => 'form-control','required')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form-1-3" class="col-md-2 control-label">GST Number</label>
                                <div class="col-md-10">
                                    {!! Form::text('gst_number',null,array('placeholder' =>'Enter GST','class' =>'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form-1-3" class="col-md-2 control-label">Commission(<span>%</span>)</label>
                                <div class="col-md-10">
                                    {!! Form::text('commission_per', null, array('placeholder' => 'Enter Admin Commission', 'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="form-1-3" class="col-md-2 control-label">Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" placeholder="Password" autocomplete="off" value="{{ isset($vendors['users']['password'])?$vendors['users']['password']:null }}" name="password" type="password" id="password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" style="display:block;">
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
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-10">
                                    {!! Form::hidden('created_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('id', null, ['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('uuid', null, ['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('user_id', null, ['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('is_created_by_admin',isset($vendors['users']['is_created_by_admin'])?$vendors['users']['is_created_by_admin']:false,['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('modified_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                    {!! Form::hidden('role_id',2, ['class' => 'form-control', 'required']) !!}
                                   <div class="text-right mrg-top-15">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button class="btn btn-default">Clear</button>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(function() {
        $( ".datepickerData" ).datepicker({
            dateFormat:'yyyy-mm-dd'
        });
    });
    </script>
@endsection
