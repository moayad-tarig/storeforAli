@extends('layouts.app')

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <!-- PRODUCT SLIDER-->
                    <div class="row m-sm-0">
                        <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
                            <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
                                @foreach($product->media as $media)
                                <div class="owl-thumb-item flex-fill mb-2 {{ !$loop->last ? 'mr-2 mr-sm-0' : null }}">
                                    <img class="w-100" src="{{ asset('assets/products/'.$media->file_name) }}" alt="{{ $product->name }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-10 order-1 order-sm-2">
                            <div class="owl-carousel product-slider" data-slider-id="1">
                                @foreach($product->media as $media)
                                <a class="d-block" href="{{ asset('assets/products/'.$media->file_name) }}" data-lightbox="product" title="{{ $product->name }}">
                                    <img class="img-fluid" src="{{ asset('assets/products/'.$media->file_name) }}" alt="{{ $product->name }}">
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT DETAILS-->
                <div class="col-lg-6">
                    <h1>{{ $product->name }}</h1>
                    <p class="text-muted lead">${{ $product->price }}</p>

                    <livewire:frontend.show-product-component :product="$product" />
                </div>
            </div>

            <!-- DETAILS TABS-->
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">{{ __('Product description') }}</a>
                </li>

            </ul>

            <div class="tab-content mb-5" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <div class="p-1 p-lg-4 bg-white">
                        <p class="text-muted text-small mb-0">
                            {!! $product->description !!}
                        </p>
                    </div>
                </div>

            </div>
            <!-- RELATED PRODUCTS-->

            <livewire:frontend.related-products-component :relatedProducts="$relatedProducts" />
        </div>
    </section>
@endsection
