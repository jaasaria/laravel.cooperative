@extends('back.layouts.auth')
@section('authcontent')
                <h2>Reset Password</h2>
                <p>Enter email to send reset link:</p>

                <form  method="POST" action="{{  url('/password/email') }}" id="login">

                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="cls-controls form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                        </div>

                        {{-- button bellow --}}

                       <button class="btn btnhover btn-login" id="voyager-login-btn">
                            <span class="login_text">
                                <i class="voyager-lock"></i> Send Password Reset Link
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
@stop
