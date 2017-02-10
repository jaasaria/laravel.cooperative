
@extends('back.layouts.auth')

@section('authcontent')

                <h2>Sign In</h2>
                <p>Sign in below:</p>
                
                <form  method="POST" action="{{ url('/login') }}" id="login">

                            {{ csrf_field() }}
              
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" type="email" class="cls-controls form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email Address">
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="password" class="cls-controls form-control block" placeholder="Password" name="password" required>
                            </div>

                            <div class="form-group">
                                <label id="group_remember"><input type="checkbox" name="remember"> Remember Me</label> 
                            </div>

                           <button class="btn btnhover btn-login" id="voyager-login-btn">
                                <span class="login_text">
                                    <i class="voyager-lock"></i> Login
                                </span>
                                <span class="login_loader">
                                    <img class="btn-loading"
                                            src="{{ asset('img/logolight.png') }}"> Logging in
                                </span>
                            </button>

                            <div id="forgot" class="hidden-xs">
                                <a class="btn-link" href="{{ url('/password/reset') }}">
                                        <small>Forgot Your Password</small>
                                </a> 
                                <br>
                                <a class="btn-link" href="{{ url('/register') }}">
                                        <small>Register New User</small>
                                </a>
                                @if (old('token'))
                                    <br>
                                    <a class="btn-link" href="{{ url('/register/resend/' . old('token')) }}">
                                            <small>Resend Verification Link</small>
                                    </a>      
                                @endif
                            </div>

                            <br><br>
                            <div id="notes" class="hidden-xs">

                                <small>User registration not working due to smpt/email server. Please use sample user's for convenient</small>

                                <br>
                                <small>email: asaria.ja@gmail.com pass: 123123</small>
                                <br>
                                <small>email: b@yahoo.com pass: 123123</small>


                            </div>




                </form>


             


@stop

