@extends('layouts.dashboard')

@section('content')
    <div class="d-flex flex-column align-items-center">
        <h1>Modifica la Categoria</h1>
        <div class="mt-5" style="width: 300px">
            <form action="{{ route('admin.categories.update', $category->id) }}" class="d-flex flex-column"
                style="row-gap: 20px" method="post">
                @csrf
                @method('put')
                <input type="text" name="name" min=3 max=255 required value="{{ old('name', $category->name) }}" />
                @error('name')
                    <div class='alert alert-danger p-1 ms-3 mb-0'>
                        {{ __($message) }}
                        <!-- i __ sono per aggiungere le traduzioni per le lingue-->
                    </div>
                @enderror
                <input class="btn btn-success" type="submit" value="Modifica Categoria">
            </form>
        </div>
    </div>
@endsection
