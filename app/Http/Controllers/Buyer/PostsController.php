<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Buyer\PostService as BuyerPostService;


class PostsController extends Controller
{

    protected $postService;

    public function __construct(BuyerPostService $postService)
    {
        $this->postService = $postService;
    }


    public function index()
    {
        $posts = $this->postService->fetchPosts();
        return view('buyer.posts.index', compact('posts'));
    }


    public function loadMore(int $offset)
    {
        $posts = $this->postService->loadMore($offset);
        $view = view('buyer.posts.components.card', compact('posts'))->render();
        return response(['html' => $view], 200, ['Content-Type' => 'text/html']);
    }







    // post gestion:
    public function storePost(Request $request)
    {
        if ($this->postService->storePost($request)) {
            return redirect()->back()->with('success', 'Post created successfully!');
        } else {
            return redirect()->back()->withErrors(['Post not created. Something went wrong.']);
        }
    }




    // like and cmments :
    public function toggleLike(Post $post)
    {
        $result = $this->postService->toggleLike($post);
        return response()->json($result);
    }



    public function addComment(Request $request, Post $post)
    {
        $comment = $this->postService->addComment($request, $post);
        return response()->json([
            'comment' => $comment,
            'user' => [
                'photo' => Auth::user()->photo,
                'first_name' => Auth::user()->first_name
            ]
        ]);
    }
}
