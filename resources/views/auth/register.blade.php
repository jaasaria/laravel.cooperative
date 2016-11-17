@extends('back.layouts.auth')


@section('authcontent')

                <h2 >Registration</h2>
                <p>Create account bellow:</p>
                
                <form  method="POST" action="{{ url('/register') }}" id="login">

                        {{ csrf_field() }}
              

                         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" class="cls-controls form-control" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="cls-controls form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="cls-controls form-control" placeholder="Password" name="password" required>
                        </div>

                        <div class="form-group">
                                <input id="password-confirm" type="password" class="cls-controls form-control" placeholder="Confirm Password" name="password_confirmation" required>
                        </div>


                        {{-- button bellow --}}

                       <button class="btn btnhover btn-login" id="voyager-login-btn">
                            <span class="login_text">
                                <i class="voyager-lock"></i> Register
                            </span>
                            <span class="login_loader">
                                <img class="btn-loading"
                                        src="{{ asset('img/logo-light.png') }}"> Registering
                            </span>
                        </button>

                        <div id="forgot" class="hidden-xs">
                            <a class="btn-link" href="{{ url('/login') }}">
                                    <small>Return to Login?</small>
                            </a> 
                             
                        </div>
                </form>









@stop
