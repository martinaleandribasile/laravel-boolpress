<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validationInput($request);
        $datas = $request->all();
        $newpost = new Post();
        $newpost->fill($datas);
        $slug = Str::slug($newpost->title);
        $slug_base = $slug;
        $existingslug = Post::where('slug', $slug)->first();
        $counter = 1;
        while ($existingslug) {
            $slug = $slug_base . '_' . $counter;
            $existingslug = Post::where('slug', $slug)->first();
            $counter++;
        }
        $newpost->slug = $slug;
        $newpost->save();
        return redirect()->route('admin.posts.show', $newpost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validationInput($request);
        $postupdate = $request->all();
        $post->update($postupdate);
        $slug = Str::slug($post->title);
        $slug_base = $slug;
        $existingslug = Post::where('slug', $slug)->first();
        $counter = 1;
        while ($existingslug) {
            $slug = $slug_base . '_' . $counter;
            $existingslug = Post::where('slug', $slug)->first();
            $counter++;
        }
        $post->slug = $slug;
        $post->save();
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    public function validationInput(request $request)
    {
        $request->validate([
            'title' => 'required|max:255|min:5',
            'content' => 'required|min:5',
            'category_id' => 'nullable|exists:categories,id'
        ]);
    }
}
