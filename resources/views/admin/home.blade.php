@extends('layouts.dashboard')

@section('content')
    <h1 class="text-center text-uppercase py-5 text-primary">I miei Posts</h1>
    <div class="border border-3 p-3 my-5">
        <h3 class="text-primary">Il mio ultimo post:</h3>
        <div>
            <p class="text-primary">Data: <span class="text-dark">{{ $lastpost->updated_at }}</span></p>
            <h6 class="text-primary">Titolo: <span class="text-dark">{{ $lastpost->title }}</span></h6>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <a class="btn btn-success" href="{{ route('admin.posts.create') }}">Crea un nuovo Post</a>
    </div>
@endsection
