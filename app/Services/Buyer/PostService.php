<?php

namespace App\Services\Buyer;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostService
{

    public function fetchPosts(int $offset = 0)
    {
        return Post::latest()
            ->with('comments', function ($query) {
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


    public function loadMore(int $offset)
    {
        if ($offset > 1000) {
            return response()->json(['message' => 'Too many requests'], 429);
        }

        $posts = $this->fetchPosts($offset);

        return $posts;
    }



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

        $post = Post::create([
            'content' => $request->input('content'),
            'photo' => $photoPath,
            'user_id' => Auth::id(),
        ]);

        return $post;
    }


    public function toggleLike(Post $post)
    {
        $userId = Auth::id();

        if ($post->likes()->where('user_id', $userId)->exists()) {
            $post->likes()->where('user_id', $userId)->delete();
            return ['liked' => false, 'count' => $post->likes->count()];
        } else {
            $post->likes()->create(['user_id' => $userId]);
            return ['liked' => true, 'count' => $post->likes->count()];
        }
    }



    public function addComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        return $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);
    }
}
