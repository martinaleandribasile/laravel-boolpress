@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <h1 class="text-success">I miei Tag</h1>
        @foreach ($tags as $tag)
            <div class="col-12 py-4">
                <a href="{{ route('admin.tags.show', $tag->id) }}">{{ $tag->name }}</a>

            </div>
        @endforeach
    </div>
    <div>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-success">Crea un nuovo Tag</a>
    </div>
@endsection
