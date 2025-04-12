@extends('templates.user')

@section('title', 'Pricing')

@section('navbar')
    @include('components.navbar', ['search' => true])
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

        /* card subscription */

        .card-subscription {
            background: rgba(255, 255, 255, 0.20);
            box-shadow: 0 0 8px 0 rgba(120, 120, 120, 0.30);
            backdrop-filter: blur(4px);

            .detail-subscription {
                gap: 8px;

                & * {
                    text-align: left;
                    color: white;
                }

                h3 {
                    display: inline-block;
                    width: 100%;
                    padding-bottom: 10px;
                    font-size: clamp(2rem, 2vw, 3rem);
                    margin-bottom: 1rem;
                    border-bottom: 4px solid rgb(229, 229, 229);
                    border-image: repeating-linear-gradient(-45deg, transparent, transparent 1px, rgb(229, 229, 229) 1px, rgb(229, 229, 229) 3px) 5;
                }

                progress {
                    margin-top: 2rem;
                    width: 100%;
                    height: 12px;
                    border: none;
                    border-radius: 6px;
                    overflow: hidden;
                }

                progress::-webkit-progress-bar {
                    background-color: rgba(170, 170, 170, 0.464);
                }

                progress::-webkit-progress-value {
                    background-color: #BCFF00;
                }

                span {
                    display: inline-block;
                    width: 100%;
                    text-align: end;
                    font-size: 12px;
                }

                @media (max-width: 768px) {
                    order: 2;
                }
            }

            @media (max-width: 768px) {
                &>.row> :not(.detail-subscription) {
                    padding-top: 5rem !important;
                    padding-bottom: 0 !important;
                }
            }
        }
    </style>
@endsection

@section('content')
    <!-- banner -->
    <section class="mil-banner mil-banner-sm" style="height: min-content; min-height: 60vh;">
        <img src="{{ asset('img/foto/jan-derungs-XMwAnYLHShE-unsplash.jpg') }}" class="mil-bg-img mil-scale" data-value-1=".4" data-value-2="1.4" alt="image" />
        <div class="mil-overlay"></div>
        <div class="container h-100 px-4 pb-5" style="padding-top: 10rem;">
            <div class="mil-banner-content mil-center card card-subscription h-100 p-0">
                <div class="row m-0 h-100">
                    <div class="col-md-7 col-lg-6 d-flex flex-column align-items-start justify-content-center detail-subscription p-5">
                        <h3>Detail Subscription</h3>
                        <p>TYPE :
                            <b style="color: #c0fd00;">
                                @if ($subscription->month_diff >= 12)
                                    Premium Pro (1 Year)
                                @else
                                    Premium (1 Month)
                                @endif
                            </b>
                        </p>
                        @php
                            $now = new DateTime();
                            $end = new DateTime($subscription->date_limit);
                            $total_diff = (new DateTime($subscription->created_at))->diff($end)->days;

                            $remaining_days = $subscription->day_diff;
                        @endphp
                        <p class="badge badge-pfimary">CREATED : <b>{{ date('d-m-Y', strtotime($subscription->created_at)) }}</b></p>
                        <p class="badge badge-pfimary">EXPIRED : <b>{{ date('d-m-Y', strtotime($subscription->date_limit)) }}</b></p>
                        <progress id="file" value="{{ $remaining_days }}" max="{{ $total_diff }}"></progress>
                        <span>Expiry Left: <b>{{ $remaining_days }} day</b></span>
                    </div>
                    <div class="col-md-5 col-lg-6 d-flex justify-content-center align-items-center p-5">
                        <img src="{{ asset('img/logo/logo_pixavault.png') }}" style="width: min(360px, 100%); height: unset; border-radius: unset;" alt="pixavault">
                    </div>
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
                            <form href="{{ route('extends', 1) }}" method="POST">
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
                            <form action="{{ route('extends', 2) }}" method="POST">
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
