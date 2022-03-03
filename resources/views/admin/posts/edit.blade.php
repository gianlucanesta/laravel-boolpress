@extends('layouts.dashboard')

@section('content')
    <h1>Modifica Post</h1>

    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria</label>
            <select class="form-select" name="category_id" id="category_id">
                <option value="">Nessuna</option>
                
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <p class="mb-1">Tags</p>
        
            {{-- {{ dd($tags) }}  --}}
            {{-- {{ dd($post->tags) }}  --}}
            @foreach($tags as $tag)
            <div class="form-check">
    			@if ($errors->any())
    				{{-- Se ci sono errori di validazioni decido se mettere checked o meno in base al valore old contenuto in un array--}}
    				<input {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
    			@else
    				{{-- Altrimenti metto checked in base a $post->tags->contains che è una collection--}}
    				<input {{ $post->tags->contains($tag) ? 'checked' : '' }} class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                @endif
                <input {{ $post->tags->contains($tag) ? 'checked' : '' }} class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                <label class="form-check-label" for="tag-{{ $tag->id }}">
                {{ $tag->name}}
                </label>
            </div>
        @endforeach
            
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea name="content" class="form-control"  id="content" cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection