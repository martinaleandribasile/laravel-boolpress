@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12 py-2">
            <h2 class="text-success">Titolo:</h2>
            <h3>{{ $post->title }}</h3>
        </div>
        <div class="col-12 py-2">
            <h2 class="text-success">Content:</h2>
            <h3>{{ $post->content }}</h3>
        </div>
        <div class="col-12 py-2">
            <h2 class="text-success">Slug:</h2>
            <h3>{{ $post->slug }}</h3>
        </div>
        <div class="col-12 py-2">
            <a class="text-primary" href="{{ route('admin.categories.index') }}" style="text-decoration: underline">
                <h2>Category:</h2>
            </a>
            <div class="d-flex">
                <h3>{{ $post->category_id == null ? 'Non Assegnata' : $post->category->name }}</h3>
                @if ($post->category_id != null)
                    <a href="{{ route('admin.categories.show', $post->category->slug) }}">info</a>
                @endif
            </div>
            <!--grazie al modello le tabelle sono collegate-->
        </div>
        <div class="col-12 py-2">
            <a class="text-primary" href="{{ route('admin.tags.index') }}" style="text-decoration: underline">
                <h2>Tags:</h2>
            </a>
            @if (count($post->tags) > 0)
                @foreach ($post->tags as $tag)
                    <div class="d-flex">
                        <h3> - {{ $tag->name }}</h3>
                        <a href="{{ route('admin.tags.show', $tag->id) }}">info</a>
                    </div>
                @endforeach
            @else
                <h6>Nessun Tag assegnato</h6>
            @endif

        </div>
    </div>
    <div class="row py-2">
        <div class="col-2">
            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Aggiorna</a>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-2">
            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="conferma(event)">
                @csrf
                @method('delete')
                <input type="submit" value="Cancella Post" class="btn btn-danger">
            </form>
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
