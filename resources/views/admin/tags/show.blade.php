@extends('layouts.dashboard')

@section('content')
    <div class="mb-4">
        <h3 class="text-center text-info border border-4 border-primary p-2" style="width: 500px; margin: 0 auto">
            {{ $tag->name }}</h3>
    </div>
    <div class="pt-4">
        <h6 class="my-3">Titoli post associati: </h6>
        <ul class="mt-3">
            @foreach ($postsRelated as $post)
                <li><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></li>
            @endforeach

        </ul>
    </div>
    <div class="d-flex justify-content-center pt-4" style="column-gap: 20px">
        <div>
            <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="post" onsubmit="conferma(event)">
                @csrf
                @method('delete')
                <input class="btn btn-danger" type="submit" value="Canella Tag">
            </form>
        </div>
        <div>
            <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-warning">Modifica Tag</a>
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
