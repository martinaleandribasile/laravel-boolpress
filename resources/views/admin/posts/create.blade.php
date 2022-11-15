@extends('layouts.dashboard')
@section('content')
    <div class="">
        <h1 class="text-center text-uppercase text-success pb-5">Crea un nuovo Post</h1>
        <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf
            <div class="d-flex flex-column " style="row-gap: 50px">
                <div class="d-flex justify-content-center align-items-center" style="column-gap: 20px">
                    <label class="" for="title">Titolo:</label>
                    <input class="p-2" style="width: 300px" type="text" name="title" value='{{ old('title', '') }}'
                        required maxlength="250" minlength="1" />
                    @error('title')
                        <div class='alert alert-danger p-1 ms-3 mb-0'>
                            {{ __($message) }}
                            <!-- i __ sono per aggiungere le traduzioni per le lingue-->
                        </div>
                    @enderror

                </div>
                <div class="d-flex justify-content-center align-items-center" style="column-gap: 20px">
                    <label class="" for="content">Content:</label>
                    <textarea type="text" name="content" minlength="1" rows="30" cols="70" class="p-4">{{ old('content', '') }}</textarea>
                    @error('content')
                        <div class='alert alert-danger p-1 ms-3 mb-0'>
                            {{ __($message) }}
                            <!-- i __ sono per aggiungere le traduzioni per le lingue-->
                        </div>
                    @enderror

                </div>
                <div class="d-flex justify-content-center align-items-center" style="column-gap: 20px">
                    <label for="category_id">Categoria:</label>
                    <select name="category_id" id="">
                        <option value="">Non definita</option>
                        <!--se voglio una cat non definita-->
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == old('category_id', -1) ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class='alert alert-danger p-1 ms-3 mb-0'>
                            {{ __($message) }}
                            <!-- i __ sono per aggiungere le traduzioni per le lingue-->
                        </div>
                    @enderror

                </div>
            </div>

            <div class=" pt-5 d-flex justify-content-center">
                <input type="submit" class="btn btn-success" value="Registra">
            </div>
        </form>
    </div>
@endsection
