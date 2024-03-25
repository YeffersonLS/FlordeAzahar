@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Categorias</h2>
    <div class="row">
        @foreach ( $categorys as $category )
        <div class="col-md-3">
            <div class="category">
                <a href="{{ route('category.show', ['id' => $category->t02id])  }}">
                    <div class="card">
                        <img src="{{ asset($category->t02image_path) }}" class="card-img-top-category">
                        <h5 class="card-title-category">{{ $category->t02nombre }}</h5>
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


