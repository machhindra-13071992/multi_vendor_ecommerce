@extends('layouts.default')

@section('content')
<!-- <div class="page-title">
    <h4>User Add</h4>
</div> -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-info" href="{{ route('users.index') }}"> <i class="fa fa-arrow-circle-left"></i> Back</a>
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
                    <h4 class="card-title">User Add Details</h4>
                </div>
                <div class="card-block">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                            {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'role'=>'form', 'id'=>'form-validation', 'novalidate'=>"novalidate"]) !!}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group required">
                                            {!! Form::Label('f_name', 'First Name') !!}
                                            {!! Form::text('f_name', null, ['class' => 'form-control', 'placeholder'=>'First Name','required']) !!}
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::Label('m_name', 'Middle Name') !!}
                                            {!! Form::text('m_name', null, ['class' => 'form-control', 'placeholder'=>'Middle Name' ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group required">
                                            {!! Form::Label('l_name', 'Last Name') !!}
                                            {!! Form::text('l_name', null, ['class' => 'form-control', 'placeholder'=>'Last Name','required']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::Label('user_name', 'User Name') !!}
                                            {!! Form::text('user_name', null, ['class' => 'form-control', 'placeholder'=>'User Name']) !!}
                                        </div>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group required">
                                            {!! Form::Label('role_id', 'Role') !!}
                                            {!! Form::select('role_id',['' => 'Select'] + $roles, null, array( 'class' => 'form-control','required')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group required">
                                            {!! Form::Label('email', 'Email 1') !!}
                                            {!! Form::email('email', null, array('placeholder' => 'Enter Email 1', 'class' => 'form-control', 'required')) !!}
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group required">
                                            {!! Form::Label('mobile_no', 'Contact Number 1') !!}
                                            {!! Form::text('mobile_no', null, array('placeholder' => 'Contact Number 1', 'class' => 'form-control','required')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
									<div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::Label('password', 'Password') !!}
                                            <input class="form-control" placeholder="Password" autocomplete="off" value="" name="password" type="password" id="password">
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::Label('confirm_password', 'Confirm Password') !!}
											<input class="form-control" placeholder="Re-type Password" autocomplete="off" name="confirm_password" type="password" value="" id="confirm_password">
                                        </div>
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
                                {!! Form::hidden('created_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                {!! Form::hidden('updated_at', date('Y-m-d H:i:s'), ['class' => 'form-control', 'required']) !!}
                                {!! Form::hidden('created_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                {!! Form::hidden('modified_by', Auth::id(), ['class' => 'form-control', 'required']) !!}
                                <button class="btn btn-primary">Submit</button>
                                <a href="{{ route('users.index')}}" class="btn btn-danger">Cancel</a>
                                <button class="btn btn-default">Reset</button>
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(function() {
        $( ".datepickerData" ).datepicker({
            dateFormat:'yy-mm-dd'
        });
    });
    </script>
@endsection