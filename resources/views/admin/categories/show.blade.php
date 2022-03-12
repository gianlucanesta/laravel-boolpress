@extends('layouts.dashboard')

@section('content')
    <section>
        <h1>
            {{ $category->name }}
        </h1>
        <ul  class="list-group">
            @forelse ($posts as $post)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.posts.show', ['post' => $post->id])}}">{{ $post->title }}</a>
                </li>
            @empty
                <div>Nessun post trovato</div>
            @endforelse
        </ul>
    </section>
@endsection