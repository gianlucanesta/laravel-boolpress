@extends('layouts.dashboard')

@section('content')

    <h1>{{ $post->title }}</h1>

    <div class="mb-3"><strong>Slug:</strong> {{ $post->slug }}</div>
    
    <p>{{ $post->content }}</p>
@endsection