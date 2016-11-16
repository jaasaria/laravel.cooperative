@extends('back.layouts.auth')


@section('authcontent')

                <h2 >Reset Password</h2>
                {{-- <p>Enter email to send reset link:</p> --}}

                <form  method="POST" action="{{  url('/password/reset')  }}" id="login">

                        {{ csrf_field() }}

                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ $email or old('email') }}" required autofocus>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>


                        {{-- button bellow --}}

                       <button class="btn btnhover btn-login" id="voyager-login-btn">
                            <span class="login_text">
                                <i class="voyager-lock"></i> Reset Password
                            </span>
                            <span class="login_loader">
                                <img class="btn-loading"
                                        src="{{ asset('img/logo-light.png') }}"> Resetting
                            </span>
                        </button>

                        <div id="forgot" class="hidden-xs">
                            <a class="btn-link" href="{{ url('/login') }}">
                                    <small>Return to Login?</small>
                            </a> 
                             
                        </div>
                </form>

                @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                @endif


@stop
