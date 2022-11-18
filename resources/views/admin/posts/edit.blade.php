@extends('layouts.dashboard')
@section('content')
    <div class="">
        <h1 class="text-center text-uppercase text-warning pb-5">Aggiorna il Post</h1>
        <form enctype="multipart/form-data" action="{{ route('admin.posts.update', $post->id) }}" method="post">
            @csrf
            @method('put')
            <div class="d-flex flex-column " style="row-gap: 50px">
                <div class="d-flex justify-content-center align-items-center" style="column-gap: 20px">
                    <label class="" for="title">Titolo:</label>
                    <input class="p-2" style="width: 300px" type="text" name="title"
                        value='{{ old('title', $post->title) }}' required maxlength="250" minlength="1" />
                    @error('title')
                        <div class='alert alert-danger p-1 ms-3 mb-0'>
                            {{ __($message) }}
                            <!-- i __ sono per aggiungere le traduzioni per le lingue-->
                        </div>
                    @enderror

                </div>
                <div class="d-flex justify-content-center align-items-center" style="column-gap: 20px">
                    <label class="" for="content">Content:</label>
                    <textarea type="text" name="content" minlength="1" rows="30" cols="70" class="p-4">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class='alert alert-danger p-1 ms-3 mb-0'>
                            {{ __($message) }}
                            <!-- i __ sono per aggiungere le traduzioni per le lingue-->
                        </div>
                    @enderror

                </div>

                <div class="d-flex justify-content-center align-items-center" style="column-gap: 20px">
                    @if ($post->cover_path)
                        <img src="{{ asset('storage/' . $post->cover_path) }}" alt="{{ $post->title }}">
                    @endif
                    <label for="image">Poster:</label>
                    <input type="file" name="image">
                    @error('image')
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
                                {{ $category->id == old('category_id', $post->category->id) ? 'selected' : '' }}>
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


                @if ($errors->any())
                    <div class="d-flex justify-content-center align-items-center" style="column-gap: 80px"
                        @error('tags') class="is-invalid" @enderror>
                        <p class="m-0 p-0">Tags:</p>
                        <div class="d-flex justify-content-center align-items-center" style="column-gap: 80px">
                            @foreach ($tags as $tag)
                                <div class="d-flex" style="column-gap:10px">
                                    <label class="p-0 m-0" for="tags[]">{{ $tag->name }}</label>
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center" style="column-gap: 80px">
                        <p class="m-0 p-0 me-5">Tags:</p>
                        <div class="d-flex" style="column-gap: 40px">
                            @foreach ($tags as $tag)
                                <div class="d-flex" style="column-gap:10px">
                                    <label class="p-0 m-0" for="tags[]">{{ $tag->name }}</label>
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                        {{ $post->tags->contains($tag) ? 'checked' : '' }} />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('tags')
                        <div class='alert alert-danger p-1 ms-3 mb-0'>
                            {{ __($message) }}
                            <!-- i __ sono per aggiungere le traduzioni per le lingue-->
                        </div>
                    @enderror
                @endif

            </div>
    </div>
    <div class=" pt-5 d-flex justify-content-center">
        <input type="submit" class="btn btn-warning" value="Aggiorna">
    </div>
    </form>
    </div>
@endsection
