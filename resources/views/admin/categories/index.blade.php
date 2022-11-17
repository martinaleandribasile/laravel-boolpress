@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <h1 class="text-success">Le mie categorie</h1>
        @foreach ($categories as $category)
            <div class="col-12 py-4">
                <a href="{{ route('admin.categories.show', $category->slug) }}">{{ $category->name }}</a>

            </div>
        @endforeach
    </div>
    <div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Crea nuova Categoria</a>
    </div>
@endsection
