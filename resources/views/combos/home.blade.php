@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Combos</h2>
    <div class="row">
        @foreach ( $combos as $combo )
        <div class="col-md-10">
            <div class="combo">
                <a href="{{ route('combos.show', ['id' => $combo->t10id])  }}">
                    <div class="blog-image-container">
                        <img src="{{ asset($combo->t10image) }}" class="card-img-top-blog">
                    </div>
                    <div class="card-blog">
                        <h5 class="card-title-blog">{{ $combo->t10nombre }}</h5>
                        {{-- <p class="card-subtitle-category">{{ $combo->t02nombre }}</p> --}}
                        {{-- <p class="card-description-blog">{{ $combo->t01descripcion }}</p> --}}
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


