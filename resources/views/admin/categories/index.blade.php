@extends('layouts.dashboard')

@section('content')
    <section>
        <h1>Lista delle categorie:</h1>

        <ul class="list-group">
            @foreach ($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                   <a href="{{ route('admin.category_info', ['slug' => $category->slug])}}">{{ $category->name }}</a> 
                </li>
            @endforeach
            
        </ul>
    </section>

@endsection