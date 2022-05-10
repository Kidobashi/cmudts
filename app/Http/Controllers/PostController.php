<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Offices;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $office = Offices::all();
        
        return view('posts.index', ['office' => $office]);
    }

    public function edit(Post $post)
    {
        return view ('posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {

        request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update([
            'title' => request('title'),
            'content' => request('content'),
        ]);

        return redirect('/posts');
    }

    public function create(Offices $office)
    {
        return view('posts.create');
    }

    public function store(Offices $office)
    {

        Offices::create([
            'title' => request('officeName'),
        ]);

        return redirect('/posts');
    }
}
