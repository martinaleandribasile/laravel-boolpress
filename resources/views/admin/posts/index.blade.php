@extends('layouts.dashboard')

@section('content')
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-12 py-4">
                <a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
            </div>
        @endforeach
    </div>
@endsection
