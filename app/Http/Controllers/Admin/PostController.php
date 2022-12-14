<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
        $tags = Tag::all();
        return view('admin.posts.create', compact(['categories', 'tags']));
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

        if (array_key_exists('image', $datas)) {
            $cover_path = Storage::put('post_covers', $datas['image']);
            $datas['cover_path'] = $cover_path;
        }


        $newpost = new Post();
        $newpost->fill($datas);

        $slug = $this->getSlug($newpost->title);
        $newpost->slug = $slug;
        $newpost->save();

        if (array_key_exists('tags', $datas)) {
            $newpost->tags()->sync($datas['tags']);
        }
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
        $tags = Tag::all();
        return view('admin.posts.edit', compact(['post', 'categories', 'tags']));
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

        if ($post->title != $postupdate['title']) {
            $slug = $this->getSlug($postupdate['title']);
            $postupdate['slug'] = $slug;
        }

        if (array_key_exists('image', $postupdate)) {
            if ($post->cover_path) {
                Storage::delete($post->cover_path);
            }
            $cover_path = Storage::put('post_covers', $postupdate['image']);
            $postupdate['cover_path'] = $cover_path;
        }

        if (array_key_exists('tags', $postupdate)) {
            $post->tags()->sync($postupdate['tags']);
        } else {
            $post->tags()->sync([]);
        }

        $post->update($postupdate);

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
        if ($post->cover_path) {
            Storage::delete($post->cover_path);
        }
        $post->tags()->sync([]);  // tolgo prima tutte le relazioni nella tabella ponte riferite al post che vado a cancellare
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    public function validationInput(request $request)
    {
        $request->validate([
            'title' => 'required|max:255|min:5',
            'content' => 'required|min:5',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|image|max:1024'
        ]);
    }

    private function getSlug($title)
    {
        $slug = Str::slug($title);
        $slug_base = $slug;

        $existingPost = Post::where('slug', $slug)->first();
        $counter = 1;
        while ($existingPost) {
            $slug = $slug_base . '_' . $counter;
            $counter++;
            $existingPost = Post::where('slug', $slug)->first();
        }
        return $slug;
    }
}
