@extends('layouts.dashboard')

@section('content')

{{-- {{ dd($categories) }} --}}

    <section>
        <h1>Crea un nuovo post</h1>

        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf
            @method('POST')

            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select class="form-select" name="category_id" id="category_id">
                    <option value="">Nessuna</option>
                    
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            @error('Tags')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <p class="mb-1">Tags</p>
            
                {{-- {{ dd($tags) }} <-- deve tornarmi una collection --}}
                {{-- {{ dd( old('tags')) }} <-- deve tornarmi null oppure un array se la checkbox è selezionata  --}}
                
                @foreach($tags as $tag)
                    <div class="form-check">
                        {{-- Per ogni tag stampato in checkbox che si trova nell'array old metto checked altrimenti stringa vuota --}}
			            <input {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} class="form-check-input" name="tags[]" type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}">
                        <label class="form-check-label" for="tag-{{$tag->id}}">
                        {{ $tag->name}}
                        </label>
                    </div>
                @endforeach
            </div>

            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="content" class="form-label">Contenuto</label>
                <textarea name="content" class="form-control"  id="content" cols="30" rows="10">{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Invia</button>
        </form>

    </section>    
@endsection