@extends('layouts.master')

@section('title')
    Dashboard!
@endsection

@section('content')

    {{-- Error Message Section --}}
    @include('includes.form-message-block')

    {{-- Heading --}}
    <section class="row">
        <header class="col-md-6 col-md-offset-3"><h1>Dashboard</h1></header>
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
                <article class="post" data-postid="{{ $post->id }}">
                    <p class="post-content">{{ $post->content }}</p>
                    <div class="info">Posted by {{ $post->user->name }} on {{ $post->created_at }}</div>
                    <div class="interaction">
                        <a class="inter-post-like" href="javascript:void(0)">{{ $post->like_a }}</a> |
                        <a class="inter-post-dislike" href="javascript:void(0)">{{ $post->dislike_a }}</a>
                        @if(Auth::user() == $post->user)
                            | <a  class="inter-post-edit" href="javascript:void(0)">Edit</a>
                            | <a  class="inter-post-delete" href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach

        </div>
    </section>

    {{-- Modal: Edit Post --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-edit-post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <textarea class="form-control post-content" name="post-content" rows="3" placeholder="Enter post here..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token = '{{ Session::token() }}';
        var likeUrl = '{{ route('post.like') }}'
        var editUrl = '{{ route('post.edit') }}';
    </script>

@endsection

