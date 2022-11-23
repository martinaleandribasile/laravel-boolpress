<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Error;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $postsObject = Post::paginate(5);

            $data = [
                'results' => $postsObject,
                'success' => count($postsObject) > 0
            ];
        } catch (Error $e) {
            $data = [
                'error' => $e->messagge,
                'success' => false
            ];
        };

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $post = Post::find($id)->with(['tags','category'])->first();
        //  SE USO LO SLUG $post = Post::where('slug', $slug)->with(['tags', 'category'])->first();
        $post = Post::where('id', $id)->with(['tags', 'category'])->first(); //aggancio i metodi definiti nel post model //esiste anche il without per togliere relazioni
        $data = [
            'results' => $post,
            'success' => isset($post),

            // IN JS SICURAMENTE ESISTE...in laravel ?   !!$post // scrittura per la doppia negazione SE L OGGETTO ESISTE -> !-> false !!-> true
        ];
        return response()->json($data);


        // se avessi il bind con il modello
        /*$data = [
            'results' => $post,
            'success' => true
        ];
        return response()->json($data);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
