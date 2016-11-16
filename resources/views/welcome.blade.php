@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')

    {{-- Error message Section --}}
    @include('includes.form-message-block')

    <section class="row">

        {{-- Register Section --}}
        <div class="col-md-6">
            <h3>Register</h3>
            <form action="{{ route('register') }}" method="post">
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }} ">
                    <label for="email">Your E-Mail</label>
                    <input class="form-control " type="text" name="email" id="email" value="{{ Request::old('email') }}">
                    @if($errors->has('email'))
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="inputError2Status" class="sr-only">(error)</span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }} ">
                    <label for="name">Your Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ Request::old('name') }}">
                    @if($errors->has('name'))
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="inputError2Status" class="sr-only">(error)</span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }} ">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                    @if($errors->has('password'))
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
            <form action="{{ route('login') }}" method="post">
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }} ">
                    <label for="email">Your E-Mail</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email')  }}">
                    @if($errors->has('email'))
                        <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                        <span id="inputError2Status" class="sr-only">(error)</span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }} ">
                    <label for="password">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password" >
                    @if($errors->has('password'))
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