@extends('layouts.dashboard')

@section('content')
    <section>
        <h1>Crea un nuovo post</h1>

        <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="" class="form-control"  id="content" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </section>    
@endsection