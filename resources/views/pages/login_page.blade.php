@extends('layouts.login')

@section('content')

    <<!-- inner header wrapper end -->
    <!-- login wrapper start -->
    <div class="login_wrapper fixed_portion float_left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="login_top_box float_left">
                        <div class="login_form_wrapper" style="border-left-width: 34px;margin-left: 206px;">
                            <div class="sv_heading_wraper heading_wrapper_dark dark_heading hwd">
                                <h3> login to enter</h3>
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
                            </div>
                            {!! Form::open(['route' => 'userLogin', 'method' => 'GET', 'role'=>'form', 'id'=>'form-validation', 'novalidate'=>"novalidate"]) !!}
                            <div class="form-group icon_form comments_form">
                                <!-- <input type="text" class="form-control require" name="full_name" placeholder="Email Address*"> -->
                                {!! Form::text('email', null, ['class' => 'form-control require', 'data-parsley-type'=>"email", 'placeholder'=>'Email Address', 'required']) !!}
                            </div>
                            <div class="form-group icon_form comments_form">
                                <input name="password" type="password" class="form-control required" placeholder="Password *">
                                <!--{!! Form::password('password', null, ['class' => 'form-control', 'placeholder'=>'Password','type'=>'password','required']) !!}-->
                            </div>
                            <div class="login_remember_box">
                                <label class="control control--checkbox">Remember me
                                    <input type="checkbox">
                                    <span class="control__indicator"></span>
                                </label>
                                <a href="#" class="forget_password">
                                    Forgot Password
                                </a>
                            </div>
                            <div class="about_btn login_btn float_left">
                                <a href="Javascript:void(0)" onclick="loginProcess()">login</a>
                            </div>
                            <div class="dont_have_account float_left">
                                <p>Don’t have an acount ? <a href="{{ secure_asset('/register') }}">Sign up</a></p>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login wrapper end -->
    <!-- payments wrapper start -->
    <div class="payments_wrapper float_left">
        <div class="container">
            <div class="row">
                
            </div>
        </div>
    </div>
    <!-- payments wrapper end -->
    <!-- footer section start-->
    <!-- @if(Auth::user())
      <script>window.location = "{{ secure_asset('/home') }}";</script>
    @endif -->
@endsection
 <script type="text/javascript">
    function loginProcess(){
        var validate = $('#form-validation').parsley().validate();
            if (validate) {
                $("#form-validation").submit();
            }
    }
</script>