@extends('layouts.dashboard')

@section('content')
    <div>
        <h6 class="my-3">Titoli post associati: </h6>
        <ul class="mt-3">
            @foreach ($posts as $post)
                @if ($post->category_id == $category->id)
                    <li><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></li>
                @endif
            @endforeach

        </ul>
    </div>
    <div>
        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" onsubmit="conferma(event)">
            @csrf
            @method('delete')
            <input class="btn btn-danger" type="submit" value="Canella Repo">
        </form>
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
