<?php
namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Show Dashboard
    // Gets all the uses and displays the dashboard view
    public function getDashboard()
    {
        // get authenticated user
        $user = Auth::user();

        // get all posts
        $posts = Post::orderBy('created_at', 'desc')->get();

        // loop through posts and attach "like" and "dislike" text values for dom
        foreach($posts as $post){

            $like_a = "Like";
            $dislike_a = "Dislike";

            // if user has liked/disliked
            $like_db = $user->likes()->where('post_id', $post->id)->first();
            if ($like_db){
                if ($like_db->like == 1)
                    $like_a = "Unlike";
                else
                    $dislike_a = "Remove Dislike";
            }

            // add to return array
            $post->{"like_a"} = $like_a;
            $post->{"dislike_a"} = $dislike_a;
        }

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

    // Like a Post
    public function postLikePost(Request $request)
    {
        // Get post data
        $post_id = $request['postId'];
        $post_new_like = $request['postLiked'] === 'true' ? true : false;
        $updating = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }

        // Get authenticated user
        $user = Auth::user();

        // Check if post has already been liked/disliked
        $post_db_like = $user->likes()->where('post_id', $post_id)->first();
        if ($post_db_like){
            $post_old_like = $post_db_like->like;
            $updating = true;
            if ($post_old_like == $post_new_like){
                $post_db_like->delete();
                return null;
            }
        }
        // If post has not already been liked/disliked, create new like
        else {
            $post_db_like = new Like();
        }

        // Update the database
        $post_db_like->user_id = $user->id;
        $post_db_like->post_id = $post->id;
        $post_db_like->like = $post_new_like;
        if ($updating) {
            // update if exists
            $post_db_like->update();
        } else {
            // create new if it does not exist
            $post_db_like->save();
        }

        // return msg
        return null;
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