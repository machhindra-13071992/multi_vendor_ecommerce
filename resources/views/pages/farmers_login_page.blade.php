@extends('layouts.admin_login')
@section('content')
<div class="app">
        <div class="authentication">
            <div class="sign-in-2">
                <div class="container-fluid no-pdd-horizon bg" style="background-image: url( {{ secure_asset('resources/assets/images/others/img-30.jpg') }} )">
                    <div class="row">
                        <div class="col-md-10 mr-auto ml-auto">
                            <div class="row">
                                <div class="mr-auto ml-auto full-height height-100 d-flex align-items-center">
                                    <div class="vertical-align full-height">
                                        <div class="table-cell">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="pdd-horizon-30 pdd-vertical-30">
                                                        <div class="mrg-btm-30">
                                                            <img class="img-responsive inline-block" src="{{ secure_asset('resources/assets/images/logo/logo-old.png') }}" alt="">
                                                            <h2 class="inline-block pull-right no-mrg-vertical pdd-top-15">Farmers Login</h2>
                                                        </div>
                                                        <p class="mrg-btm-15 font-size-13">Please enter your mobile number and OTP to login</p>
														@if ($message = Session::get('error'))
															<div class="alert alert-danger alert-dismissible fade show" role="alert">
																	<strong>{{ $message }}</strong>
																	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
														@endif
														@if(Input::get('error') == '1')
															<div class="alert alert-danger alert-dismissible">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Error!</strong> Please check your OTP and try again.
															</div>
														@endif
														@if(Input::get('error') == '2')
															<div class="alert alert-success alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Success!</strong> Registration successfully done.please login.
															</div>
														@endif
														@if(Input::get('error') == '3')
															<div class="alert alert-danger alert-dismissible">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Error!</strong> Mobile number exists in the system.
															</div>
														@endif
														@if(Input::get('otp_send') == '1')
															<div class="alert alert-success alert-dismissible">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Success!</strong> OTP is sent to your mobile number.
															</div>
														@endif
                                                        {!! Form::open(['route' => 'farmerLoginbackend', 'method' => 'GET', 'role'=>'form', 'id'=>'form-validation', 'novalidate'=>"novalidate"]) !!}
                                                            <div class="form-group">
																{!! Form::hidden('is_farmer_login',1, [ ]); !!}
                                                                {!! Form::text('mobile', Input::get('mobile'), ['class' => 'form-control require', 'placeholder'=>'Mobile Number', 'required']) !!}
                                                            </div>
															@if(Input::get('mobile'))
																<div class="form-group">
																	<input name="otp" type="text" class="form-control required" placeholder="OTP *">
																</div>
															@endif
                                                            <div class="checkbox font-size-13 inline-block no-mrg-vertical no-pdd-vertical">
                                                                <input id="agreement" name="agreement" type="checkbox">
                                                                <label for="agreement">Keep Me Signed In</label>
                                                            </div>
                                                            <div class="mrg-top-20 text-right">
                                                                <button class="btn btn-info" type="button" onclick="loginProcess()">Login</button>
                                                            </div>
                                                         {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 <script type="text/javascript">
    function loginProcess(){
        var validate = $('#form-validation').parsley().validate();
            if (validate) {
                $("#form-validation").submit();
            }
    }
</script>