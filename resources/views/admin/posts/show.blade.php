@extends('layouts.dashboard')

@section('content')

   <h1>{{ $post->title }}</h1>

   <div class="mb-3"><strong>Slug:</strong> {{ $post->slug }}</div>
   
   <div class="mb-3"><strong>Categoria:</strong> {{ $post->category ? $post->category->name : 'nessuna'}}</div>

   <div class="mb-2"><strong>Tags:</strong>
      @forelse($post->tags as $tag)
         {{-- {{ dd($tag )}} --}}
         {{ $tag->name }} {{ $loop->last ? '' : ', '}}
      @empty
         Nessuno
      @endforelse			
   </div>		

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