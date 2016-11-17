<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Show Dashboard
    // Gets all the uses and displays the dashboard view
    public function getDashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('dashboard', ['posts' => $posts]);
    }

    // Publish a Post
    // Adds the post to the database
    public function postCreatePost(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:500'
        ]);

        $post = new Post();
        $post->content = $request['content'];

        $returnMessage = 'The post could not be submitted';
        if ($request->user()->posts()->save($post)){
            $returnMessage = 'Your post was submitted!';
        }

        return redirect()->route('dashboard')->with(['message' => $returnMessage]);
    }

    // Delete a Post
    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();

        // Verify that the user deleting the post is the user who created it
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }

        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'Successfully deleted!']);
    }

    // Edit a Post
    public function postEditPost(Request $request){

        // validate the request
        $this->validate($request, [
            'content' => 'required'
        ]);

        // Find in database
        $post = Post::find($request['postId']);

        // Verify that the user editing the post is the user who created it
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }

        // Update post
        $post->content = $request['content'];
        $post->update();
        return response()->json(['message' => 'Successfully edited!'], 200);

    }

}