@extends('layouts.dashboard')

@section('content')
    <div class="mb-4">
        <h3 class="text-center text-info border border-4 border-primary p-2" style="width: 500px; margin: 0 auto">
            {{ $category->name }}</h3>
    </div>
    <div class="pt-4">
        <h6 class="my-3">Titoli post associati: </h6>
        <ul class="mt-3">
            @foreach ($posts as $post)
                @if ($post->category_id == $category->id)
                    <li><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></li>
                @endif
            @endforeach

        </ul>
    </div>
    <div class="d-flex justify-content-center pt-4" style="column-gap: 20px">
        <div>
            <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="post"
                onsubmit="conferma(event)">
                @csrf
                @method('delete')
                <input class="btn btn-danger" type="submit" value="Canella Categoria">
            </form>
        </div>
        <div>
            <a href="{{ route('admin.categories.edit', $category->slug) }}" class="btn btn-warning">Modifica Categoria</a>
        </div>
    </div>
@endsection

<script>
    function conferma(event) {
        const confirmdelete = confirm(
            "Are u sure u want to delete it?"
        );
        if (!confirmdelete) {
            event.preventDefault(); // evento che inibisce submit del form
        }
    }
</script>
