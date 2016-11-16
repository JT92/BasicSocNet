@extends('layouts.master')

@section('title')
    Dashboard!
@endsection

@section('content')

    {{-- Error Message Section --}}
    @include('includes.form-message-block')

    {{-- Heading --}}
    <section class="row">
        <header class="col-md-6 col-md-offset-3"><h1>My Dashboard</h1></header>
    </section>

    {{-- New Post Section --}}
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Write a post:</h3></header>
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="content" id="new-post" rows="4" placeholder="Post Here..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Post</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>

    {{-- Display Posts Section --}}
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Posts:</h3></header>
            @foreach($posts as $post)
                <article class="post">
                    <p>{{ $post->content }}</p>
                    <div class="info">Posted by {{ $post->user->name }} on {{ $post->created_at }}</div>
                    <div class="interaction">
                        <a href="javascript(void);">Like</a> |
                        <a href="javascript(void);">Dislike</a>
                        @if(Auth::user() == $post->user)
                        |
                            <a href="javascript(void);">Edit</a> |
                            <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach

        </div>
    </section>

@endsection

