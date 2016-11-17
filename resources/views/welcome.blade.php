@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')

    {{-- Error message Section --}}
    @include('includes.form-message-block')

    <section class="row login-container">

        {{-- Registration Section --}}
        <div class="col-md-4 col-md-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Register</h3>
                </div>
                <div class="panel-body">
                    <form action="{{ route('register') }}" method="post">
                        <fieldset>
                            <div class="form-group has-feedback {{ $errors->has('registration-email') ? 'has-error' : '' }} ">
                                <input class="form-control" placeholder="Email" name="registration-email" type="email" value="{{ Request::old('registration-email') }}" >
                                @if($errors->has('registration-email'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span id="inputError2Status" class="sr-only">(error)</span>
                                @endif
                            </div>

                            <div class="form-group has-feedback {{ $errors->has('registration-name') ? 'has-error' : '' }} ">
                                <input class="form-control" placeholder="Name" name="registration-name" value="{{ Request::old('registration-name') }}" >
                                @if($errors->has('registration-name'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span id="inputError2Status" class="sr-only">(error)</span>
                                @endif
                            </div>

                            <div class="form-group has-feedback {{ $errors->has('registration-password') ? 'has-error' : '' }} ">
                                <input class="form-control" placeholder="Password" name="registration-password" type="password" value="{{ Request::old('registration-password') }}">
                                @if($errors->has('registration-password'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span id="inputError2Status" class="sr-only">(error)</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-md btn-success btn-block">Sign Up!</button>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

        {{-- Login Section --}}
        <div class="col-md-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign In</h3>
                </div>
                <div class="panel-body">
                    <form action="{{ route('account.login') }}" method="post">
                        <fieldset>
                            <div class="form-group has-feedback {{ $errors->has('login-email') ? 'has-error' : '' }} ">
                                <input class="form-control" placeholder="Email" name="login-email" type="email" value="{{ Request::old('login-email') }}">
                                @if($errors->has('login-email'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span id="inputError2Status" class="sr-only">(error)</span>
                                @endif
                            </div>

                            <div class="form-group has-feedback {{ $errors->has('login-password') ? 'has-error' : '' }} ">
                                <input class="form-control" placeholder="Password" name="login-password" type="password" value="{{ Request::old('login-password') }}">
                                @if($errors->has('login-password'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                    <span id="inputError2Status" class="sr-only">(error)</span>
                                @endif
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input name="login-remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>

                            <button type="submit" class="btn btn-md btn-success btn-block">Sign In!</button>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection