@extends('layouts.dashboard')

@section('content')
    <div class="d-flex flex-column align-items-center">
        <h1>Crea un nuovo Tag per i tuoi posts</h1>
        <div class="mt-5" style="width: 300px">
            <form action="{{ route('admin.tags.store') }}" class="d-flex flex-column" style="row-gap: 20px" method="post">
                @csrf
                <input type="text" name="name" min=3 max=255 required />
                <input class="btn btn-success" type="submit" value="Crea" style="width: 100px; margin: 0 auto">
            </form>
        </div>
    </div>
@endsection
