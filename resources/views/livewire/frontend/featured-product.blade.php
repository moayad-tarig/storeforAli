<div wire:ignore>
    <!-- TRENDING PRODUCTS-->
    <section class="py-5">
        <header>
            <p class="small text-muted small text-uppercase mb-1">{{ __('The products are carefully made') }}</p>
            <h2 class="h5 text-uppercase mb-4">{{ __('Top trending products') }}</h2>
        </header>
        <div class="row">
            {{-- @foreach ($featuredProducts as $featuredProduct)
                
            @endforeach --}}
            @forelse ($featuredProducts as $featuredProduct)
            {{-- {{ dd($featuredProduct) }} --}}
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="product text-center">
                        <div class="position-relative mb-3">
                            <div class="badge text-white badge-"></div>
                            <a class="d-block" href="{{ route('frontend.product', $featuredProduct->id) }}">
                                <img class="img-fluid w-100" src="{{ asset('assets/products/' . $featuredProduct->firstMedia->file_name) }}" alt="{{ $featuredProduct->name }}">
                            </a>
                            <div class="product-overlay">
                                <ul class="mb-0 list-inline">
                                    <li class="list-inline-item m-0 p-0">
                                        <a wire:click.prevent="addToWishList({{ $featuredProduct->id }})" class="btn btn-sm btn-outline-dark aw">
                                            <i  class="far fa-heart wi"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item m-0 p-0">
                                        <a style="color:white" wire:click.prevent="addToCart({{ $featuredProduct->id }})" class="btn btn-sm btn-dark">{{ __('Add to cart') }}</a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a
                                            wire:click.prevent="$emit('showProductModalAction', '{{ $featuredProduct->id }}')"
                                            class="btn btn-sm btn-outline-dark aw"
                                            data-target="#productView"
                                            data-toggle="modal">
                                            <i  class="fas fa-expand wi"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h6>
                            <a class="reset-anchor" href="{{ route('frontend.product', $featuredProduct->id) }}">
                                {{ $featuredProduct->name }}
                            </a>
                        </h6>
                        <p class="small text-muted">${{ $featuredProduct->price }}</p>
                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </section>
</div>
