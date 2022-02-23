@extends('layouts.dashboard')

@section('content')
    <section>
        <div class="container">
            <h1>Lista dei Post</h1>

            <div class="row row-cols-3">
                @foreach ($posts as $post)
                    <div class="col">
                        <div class="card mt-4">
                            {{-- <img src="" class="card-img-top" alt=""> --}}
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::substr($post->content, 0, 100)}}...</p>
                                <a href="#" class="btn btn-primary">Leggi di più</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection