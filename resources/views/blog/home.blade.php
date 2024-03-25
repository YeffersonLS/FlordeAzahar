@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Categorias</h2>
    <div class="row">
        @foreach ( $blogs as $blog )
        <div class="col-md-10">
            <div class="blog">
                <a href="{{ route('blogs.show', ['id' => $blog->t01id])  }}">
                    <div class="blog-image-container">
                        <img src="{{ asset($blog->t01image_path) }}" class="card-img-top-blog">
                    </div>
                    <div class="card-blog">
                        <h5 class="card-title-blog">{{ $blog->t01nombre }}</h5>
                        <p class="card-subtitle-category">{{ $blog->t02nombre }}</p>
                        <p class="card-description-blog">{{ $blog->t01descripcion }}</p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('js')

@endsection


