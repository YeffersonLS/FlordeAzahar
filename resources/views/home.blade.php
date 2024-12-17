@extends('layouts.app')

@section('content')
<div class="row justify-center">
    @foreach($banners as $index => $banner)
    <div class="banner carousel-banner" style="background-image: url('{{ asset($banner->t06image_path) }}');">
    </div>
    @endforeach
</div>

<div class="row justify-center mt-3">
    <div class="col-2">
        <video controls style="width: 100%; max-height: 300px;">
            <source src="{{ asset('public/storage/videos/navidad.mp4') }}" type="video/mp4">
        </video>
    </div>
</div>
    <div class="container">
        <div>
            <br>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="tab-header">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Recomendados</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Populares</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three" aria-selected="false">Nuevos Productos</button>
                            </li>
                        </ul>
                        <a href="#" class="view-more d-none d-md-flex">Ver Todo<i class="fi-rs-angle-double-small-right"></i></a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($products as $product)
                            <div class="col-md-6 col-lg-3">
                                <div class="productos">
                                    <a href="{{ route('product.show', ['t04slug' => $product->t04slug]) }}">
                                        <div class="card">
                                            <img src="{{ asset($product->image_path) }}" class="card-img-top" alt="{{ $product->t02nombre }}">
                                            <div class="card-info">
                                                <p class="subcategoria-productos">{{ $product->t02nombre }}</p>
                                                <h5 class="card-title">{{ $product->t04nombre }}</h5>
                                                <p class="card-money">{{ '$' . $product->t04precio . ' MXN' }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-header-category">{{ __('Categorias') }}</div>
                <div class="card-body">
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
            </div>
        </div>

        <br>
        {{-- <div class="row justify-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Marcas') }}</div>
                    <div class="row">
                        <div class="card-body">
                            Imagenes Categoria
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var banners = $('.carousel-banner');
        var dotsContainer = $('.banner-dots');

        banners.each(function(index) {
            dotsContainer.append('<span class="dot" data-index="' + index + '"></span>');
        });

        var dots = $('.dot');
        var currentIndex = 0;

        function showBanner(index) {
            banners.hide().eq(index).show();
            dots.removeClass('active-dot').eq(index).addClass('active-dot');
        }

        showBanner(currentIndex);

        $('.prev-arrow').click(function() {
            currentIndex = (currentIndex === 0) ? banners.length - 1 : currentIndex - 1;
            showBanner(currentIndex);
        });

        $('.next-arrow').click(function() {
            currentIndex = (currentIndex === banners.length - 1) ? 0 : currentIndex + 1;
            showBanner(currentIndex);
        });

        dots.click(function() {
            var index = $(this).data('index');
            showBanner(index);
        });

        setInterval(function() {
            currentIndex = (currentIndex === banners.length - 1) ? 0 : currentIndex + 1;
            showBanner(currentIndex);
        }, 10000);
    });
</script>
@endsection


