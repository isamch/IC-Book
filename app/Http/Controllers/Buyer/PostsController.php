<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{


    public function index()
    {
        $posts = $this->fetchPosts();

        // dd($posts);

        return view('buyer.posts.index', compact('posts'));
    }


    public function loadMore(Request $request, int $offset)
    {
        if ($offset > 1000) {
            return response()->json(['message' => 'Too many requests'], 429);
        }

        $posts = $this->fetchPosts($offset);


        // dd($posts);

        $view = view('buyer.posts.components.card', compact('posts'))->render();

        return response(['html' => $view], 200, ['Content-Type' => 'text/html']);
    }


    private function fetchPosts(int $offset = 0)
    {
        return Post::latest()
            ->skip($offset)
            ->take(5)
            // ->pluck('id');
            ->get();
    }
}
