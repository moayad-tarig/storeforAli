
@extends('layouts.app')

@section('content')
    <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background: url('{{ asset('assets/sliders/hero-banner-alt.jpg') }}')">
        <div class="container py-5">
            <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                    <p class="text-muted small text-uppercase mb-2">{{ __('new products') }}</p>
                    <h1 class="h2 text-uppercase mb-3">{{ __('20% off on new season') }}</h1>
                    <a class="btn btn-dark" href="#">{{ __('See new products') }}</a>
                </div>
            </div>
        </div>
    </section>


    <livewire:frontend.featured-product />

    <!-- SERVICES-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="d-inline-block">
                        <div class="media align-items-end">
                            <svg class="svg-icon svg-icon-big svg-icon-light">
                                <use xlink:href="#delivery-time-1"></use>
                            </svg>
                            <div class="media-body text-left ml-3">
                                <h6 class="text-uppercase mb-1">{{ __('Free shipping') }}</h6>
                                <p class="text-small mb-0 text-muted">{{ __('Free shipping worldwide') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="d-inline-block">
                        <div class="media align-items-end">
                            <svg class="svg-icon svg-icon-big svg-icon-light">
                                <use xlink:href="#helpline-24h-1"></use>
                            </svg>
                            <div class="media-body text-left ml-3">
                                <h6 class="text-uppercase mb-1">{{ __('24 x 7 service') }}</h6>
                                <p class="text-small mb-0 text-muted">{{ __('Fast and prompt service') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-inline-block">
                        <div class="media align-items-end">
                            <svg class="svg-icon svg-icon-big svg-icon-light">
                                <use xlink:href="#label-tag-1"></use>
                            </svg>
                            <div class="media-body text-left ml-3">
                                <h6 class="text-uppercase mb-1">{{ __('with the customer') }}</h6>
                                <p class="text-small mb-0 text-muted">{{ __('We always stand with the customer') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWSLETTER-->
    <section class="py-5">
        <div class="container p-0">
            <div class="row">
                <div class="col-lg-8 mb-3 mb-lg-0">
                    <h5 class="text-uppercase">{{ __('Let\'s be friends') }} ----></h5>
                    {{-- <p class="text-small text-muted mb-0">Nisi nisi tempor consequat laboris nisi.</p> --}}
                </div>
                <div class="col-lg-4">
                    <form action="#">
                        <div class="input-group flex-column flex-sm-row mb-3">
                            <input class="form-control form-control-lg py-3" type="text"
                                   value="00972597845484" disabled aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <a href="https://wa.me/00972597845484" class="btn btn-dark btn-block" id="button-addon2" type="button">{{ __('whatsapp number') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


