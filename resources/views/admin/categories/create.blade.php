@extends('layouts.dashboard')

@section('content')
    <div class="d-flex flex-column align-items-center">
        <h1>Crea una nuova Categoria per i tuoi posts</h1>
        <div class="mt-5" style="width: 300px">
            <form action="{{ route('admin.categories.store') }}" class="d-flex flex-column" style="row-gap: 20px"
                method="post">
                @csrf
                <input type="text" name="name">
                <input class="btn btn-success" type="submit" value="Crea Nuova Categoria">
            </form>
        </div>
    </div>
@endsection
