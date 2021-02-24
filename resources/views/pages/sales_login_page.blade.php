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
                                                            <h2 class="inline-block pull-right no-mrg-vertical pdd-top-15">Sales Login</h2>
                                                        </div>
                                                        <p class="mrg-btm-15 font-size-13">Please enter your user name and password to login</p>
														@if ($message = Session::get('error'))
															<div class="alert alert-danger alert-dismissible fade show" role="alert">
																	<strong>{{ $message }}</strong>
																	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
														@endif
														@if(Input::get('error'))
															<div class="alert alert-danger alert-dismissible">
															<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
															<strong>Error!</strong> Please check your login details and try again.
															</div>
														@endif
                                                        {!! Form::open(['route' => 'adminLoginbackend', 'method' => 'GET', 'role'=>'form', 'id'=>'form-validation', 'novalidate'=>"novalidate"]) !!}
                                                            <div class="form-group">
																{!! Form::hidden('is_sales_login',1, [ ]); !!}
                                                                {!! Form::text('name', null, ['class' => 'form-control require', 'placeholder'=>'User Name', 'required']) !!}
                                                            </div>
                                                            <div class="form-group">
                                                                <input name="password" type="password" class="form-control required" placeholder="Password *">
                                                            </div>
                                                            <div class="checkbox font-size-13 inline-block no-mrg-vertical no-pdd-vertical">
                                                                <input id="agreement" name="agreement" type="checkbox">
                                                                <label for="agreement">Keep Me Signed In</label>
                                                            </div>
                                                            <!--<div class="pull-right">
                                                                <a href="">Forgot Password?</a>
                                                            </div>-->
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