@extends('templates.user')

@section('title', 'Pricing')

@section('navbar')
    @include('components.navbar')
    <style>
        .mil-top-panel {
            &.mil-active {
                background-color: rgba(255, 255, 255, 0.6) !important;

                .nav-horizontal-dot {
                    img {
                        filter: invert(1) !important;
                    }

                    &:hover {
                        background-color: #000;

                        img {
                            filter: invert(0) !important;
                        }
                    }
                }

                .mil-logo img {
                    filter: invert(1);
                }

                .nav-min-sm {
                    filter: invert(1);
                    transition: filter 0.3s ease;
                }

                .nav-max-sm * {
                    color: black
                }
            }
        }
    </style>
@endsection

@section('content')
    <!-- banner -->
    <section class="mil-banner mil-banner-sm">
        <img src="{{ asset('img/foto/jan-derungs-XMwAnYLHShE-unsplash.jpg') }}" class="mil-bg-img mil-scale" data-value-1=".4" data-value-2="1.4" alt="image" />
        <div class="mil-overlay"></div>
        <div class="container">
            <div class="mil-background-grid mil-top-space"></div>
            <div class="mil-banner-content mil-center">
                <div class="mil-mb-90">
                    <h1 class="mil-light mil-upper mil-mb-30">Pricing</h1>
                    <ul class="mil-breadcrumbs mil-center">
                        <li><a href="home-1.html">Home</a></li>
                        <li><a href="about.html">Pricing</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- banner end -->

    <!-- team -->
    <section id="subscribe">
        <div class="container mil-p-120-90 price">
            <div class="mil-background-grid mil-softened"></div>
            <div class="row">
                <div class="col-12">
                    <div class="mil-center mil-mb-90">
                        <span class="mil-suptitle mil-upper mil-up mil-mb-30">Flexible Plans</span>
                        <h3 class="mil-upper mil-up mil-mb-30">Affordable Memberships, <br>Premium Features</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mil-price-card mil-up mil-mb-30">
                        <div class="mil-price-head mil-up mil-mb-15">
                            <div class="mil-upper mil-dark mil-mb-10 mil-sm-center">Premium Pro</div>
                            <div class="mil-flex align-items-center gap-sm flex-max-sm-column mil-mb-30 justify-content-between">
                                <div class="mil-dark font-lg-24 text-max-sm-center l-height-normal font-700 l-height-30">UPGRADE TO <br class="d-max-sm-none">12
                                    MONTHS</div>
                                <h3 class="mil-dark mil-price-text text-max-sm-center mil-right l-height-30">$56.00<br class="d-max-sm-none"><span class="mil-text-lg mil-extra-thin">/ Year</span></h3>
                            </div>
                        </div>
                        <div class="mil-divider-lg mil-up mil-mb-30"></div>
                        <div class="mil-price-body">
                            <ul class="mil-icon-list mil-mb-30">
                                <li class="mil-accent mil-up"><img src="{{ asset('img/icons/checklist-black.svg') }}" style="width: 47.65px; height: 37px; padding: 7px;" alt="icon"
                                        class="mx-2 mx-sm-4">
                                    <p class="break-sm-spaces">Free access Download Photo</p>
                                </li>
                                <li class="mil-accent mil-up"><img src="{{ asset('img/icons/checklist-black.svg') }}" style="width: 47.65px; height: 37px; padding: 7px;" alt="icon"
                                        class="mx-2 mx-sm-4">
                                    <p class="break-sm-spaces">Free access Upload Photo</p>
                                </li>
                            </ul>
                        </div>
                        <div class="mil-price-button mil-up">
                            <form action="{{ route('purchase', 1) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="mil-button mil-fw radius-8" style="background-color: #BCFF00 !important;">SUBSCRIBE</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mil-price-card mil-up mil-mb-30">
                        <div class="mil-price-head mil-up mil-mb-15">
                            <div class="mil-upper mil-dark mil-mb-10 mil-sm-center">Premium</div>
                            <div class="mil-flex align-items-center gap-sm flex-max-sm-column mil-mb-30 justify-content-between">
                                <div class="mil-dark font-lg-24 text-max-sm-center l-height-normal font-700 l-height-30">UPGRADE TO <br class="d-max-sm-none">1 MONTH
                                </div>
                                <h3 class="mil-dark mil-price-text text-max-sm-center mil-right l-height-30">$7.00<br class="d-max-sm-none"><span class="mil-text-lg mil-extra-thin">/ Month</span></h3>
                            </div>
                        </div>
                        <div class="mil-divider-lg mil-up mil-mb-30"></div>
                        <div class="mil-price-body">
                            <ul class="mil-icon-list mil-mb-30">
                                <li class="mil-accent mil-up"><img src="{{ asset('img/icons/checklist-black.svg') }}" style="width: 47.65px; height: 37px; padding: 7px;" alt="icon"
                                        class="mx-2 mx-sm-4">
                                    <p class="break-sm-spaces">Free access Download Photo</p>
                                </li>
                                <li class="mil-accent mil-up"><img src="{{ asset('img/icons/checklist-black.svg') }}" style="width: 47.65px; height: 37px; padding: 7px;" alt="icon"
                                        class="mx-2 mx-sm-4">
                                    <p class="break-sm-spaces">Free access Upload Photo</p>
                                </li>
                            </ul>
                        </div>
                        <div class="mil-price-button mil-up">
                            <form action="{{ route('purchase', 2) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="mil-button mil-fw radius-8">SUBSCRIBE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
@endsection
