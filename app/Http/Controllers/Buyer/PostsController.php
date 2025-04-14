<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{


    public function index()
    {


        $posts = $this->fetchPosts();


        return view('buyer.posts.index', compact('posts'));
    }


    public function loadMore(Request $request, int $offset)
    {
        if ($offset > 1000) {
            return response()->json(['message' => 'Too many requests'], 429);
        }

        $posts = $this->fetchPosts($offset);


        $view = view('buyer.posts.components.card', compact('posts'))->render();

        return response(['html' => $view], 200, ['Content-Type' => 'text/html']);
    }


    private function fetchPosts(int $offset = 0)
    {

        return Post::latest()
            ->with('comments', function($query){
                $query->orderBy('created_at', 'desc');
            })
            ->skip($offset)
            ->take(5)
            ->get()
            ->map(function ($post) {
                $post->liked_by_user = $post->likes->pluck('user_id')->contains(Auth::id());
                return $post;
            });

    }




    // post gestion:
    public function storePost(Request $request)
    {



        $request->validate([
            'content' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('images/posts', 'public');
        }


        Post::create([
            'content' => $request->input('content'),
            'photo' => $photoPath,
            'user_id' => Auth::id(),
        ]);


        return redirect()->back()->with('success', 'Post created successfully!');
    }






    // like and cmments :
    public function toggleLike(Post $post)
    {

        $userId = Auth::user()->id;

        if ($post->likes()->where('user_id', $userId)->exists()) {

            $post->likes()->where('user_id', $userId)->delete();

            return response()->json(['liked' => false, 'count' => $post->likes->count()]);
        } else {

            $post->likes()->create(['user_id' => $userId]);
            return response()->json(['liked' => true, 'count' => $post->likes->count()]);
        }
    }



    public function addComment(Request $request, Post $post)
    {

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = $post->comments()->create([
            'user_id' => Auth::user()->id,
            'content' => $request->content,
        ]);


        return response()->json([
            'comment' => $comment,
            'user' => [
                'photo' => Auth::user()->photo,
                'first_name' => Auth::user()->first_name
            ]
        ]);
    }
}
