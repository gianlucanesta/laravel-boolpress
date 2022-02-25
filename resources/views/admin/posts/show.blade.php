@extends('layouts.dashboard')

@section('content')

    <h1>{{ $post->title }}</h1>

    <div class="mb-3"><strong>Slug:</strong> {{ $post->slug }}</div>
    
    <p>{{ $post->content }}</p>

    <form action="{{ route('admin.posts.edit', ['post' => $post->id])}}">
        <button type="submit" class="btn btn-primary">Edit</button>
     </form>

     <form action="{{ route('admin.posts.destroy', ['post' => $post->id])}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
     </form>
@endsection