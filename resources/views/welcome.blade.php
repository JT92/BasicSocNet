@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')

    {{-- Error message Section --}}
    @include('includes.form-message-block')

    <section class="row">

        {{-- Registration Section --}}
        <div class="col-md-6">
            <h3>Register</h3>
            <form action="{{ route('register') }}" method="post">
                <div class="form-group has-feedback {{ $errors->has('registration-email') ? 'has-error' : '' }} ">
                    <label for="email">Your E-Mail</label>
                    <input class="form-control " type="text" name="registration-email" id="email" value="{{ Request::old('registration-email') }}">
                    @if($errors->has('registration-email'))
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="inputError2Status" class="sr-only">(error)</span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('registration-name') ? 'has-error' : '' }} ">
                    <label for="name">Your Name</label>
                    <input class="form-control" type="text" name="registration-name" id="name" value="{{ Request::old('registration-name') }}">
                    @if($errors->has('registration-name'))
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="inputError2Status" class="sr-only">(error)</span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('registration-email') ? 'has-error' : '' }} ">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="registration-password" id="password">
                    @if($errors->has('registration-password'))
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="inputError2Status" class="sr-only">(error)</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Sign Up!</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>

        {{-- Log in Section --}}
        <div class="col-md-6">
            <h3>Log In</h3>
            <form action="{{ route('account.login') }}" method="post">
                <div class="form-group has-feedback {{ $errors->has('login-email') ? 'has-error' : '' }} ">
                    <label for="email">Your E-Mail</label>
                    <input class="form-control" type="text" name="login-email" id="email" value="{{ Request::old('login-email')  }}">
                    @if($errors->has('login-email'))
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="inputError2Status" class="sr-only">(error)</span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('login-password') ? 'has-error' : '' }} ">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="login-password" id="password" >
                    @if($errors->has('login-password'))
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="inputError2Status" class="sr-only">(error)</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Log In!</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>

    </section>

@endsection