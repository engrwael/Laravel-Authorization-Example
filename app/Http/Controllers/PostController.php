<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->get();
        return view('dashboard', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);
        return view('create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        Post::create([
            'title'=> $request->input('title'),
            'content'=> $request->input('content'),
            'user_id' => auth()->id()
        ]);
        return to_route('dashboard')->with('success', 'Created Successfully');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->only('title','content'));

        return to_route('dashboard')->with('success', 'Updated Successfully');
    }


    public function delete(Post $post)
    {
       $this->authorize('delete', $post);
       if ($post){
           $post->delete();
       }
       return to_route('dashboard')->with('success', 'Deleted Successfully');
    }
}
