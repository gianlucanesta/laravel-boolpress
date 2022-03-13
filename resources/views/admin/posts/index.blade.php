@extends('layouts.dashboard')

@section('content')
    <section>
        <div>
            <h1>Lista dei Post</h1>

            <div class="row row-cols-3">
                @foreach ($posts as $post)
                    <div class="col">
                        <div class="card mt-4">
                            @if($post->cover)
                                <div>
                                    <img src="{{ asset('storage/' .  $post->cover)}}" alt="{{ $post->title}}" class="card-img-top">
                                </div>
                            @endif 
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::substr($post->content, 0, 100)}}...</p>
                                <a href="{{ route('admin.posts.show', ['post' => $post->id])}}" class="btn btn-primary">Leggi di più</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-3">{{ $posts->links()}}</div>
        </div>
    </section>
@endsection