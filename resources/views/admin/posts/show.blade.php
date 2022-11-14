@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12 py-2">
            <h2 class="text-primary">Titolo:</h2>
            <h3>{{ $post->title }}</h3>
        </div>
        <div class="col-12 py-2">
            <h2 class="text-primary">Content:</h2>
            <h3>{{ $post->content }}</h3>
        </div>
        <div class="col-12 py-2">
            <h2 class="text-primary">Slug:</h2>
            <h3>{{ $post->slug }}</h3>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-2">
            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Aggiorna</a>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-2">
            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                onsubmit="confirm('Are u sure u want to delete it??')">
                @csrf
                @method('delete')
                <input type="submit" value="Cancella Post" class="btn btn-danger">
            </form>
        </div>
    </div>
@endsection
