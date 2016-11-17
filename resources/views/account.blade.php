@extends('layouts.master')

@section('title')
    Account Settings
@endsection

@section('content')
    <section class="row">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Account Settings</h3></header>
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="name">
                </div>
                <div class="form-group">
                    <label for="profile-image">Profile Image (.jpg only):</label>
                    <input type="file" name="profile-image" class="form-control" id="profile_image">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    @if (Storage::disk('local')->has($user->id . '_profile_img.jpg'))
        <section class="row row-padded">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ route('account.image', ['filename' => $user->id . '_profile_img.jpg']) }}" alt="" class="img-responsive">
            </div>
        </section>
    @endif
@endsection