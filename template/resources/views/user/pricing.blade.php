@extends('templates.user')

@section('title', 'Pricing')

@section('navbar')
    @include('components.navbar-white')
@endsection

@section('content')
    <!-- banner -->
    <section class="mil-banner mil-banner-sm">
        <img src="{{ asset('img/foto/jan-derungs-XMwAnYLHShE-unsplash.jpg') }}" class="mil-bg-img mil-scale"
            data-value-1=".4" data-value-2="1.4" alt="image" />
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
                                <h3 class="mil-dark mil-price-text text-max-sm-center mil-right l-height-30">$56.00<br class="d-max-sm-none"><span
                                        class="mil-text-lg mil-extra-thin">/ Year</span></h3>
                            </div>
                        </div>
                        <div class="mil-divider-lg mil-up mil-mb-30"></div>
                        <div class="mil-price-body">
                            <ul class="mil-icon-list mil-mb-30">
                                <li class="mil-accent mil-up"><img
                                        src="{{ asset('img/icons/checklist-black.svg') }}"
                                        style="width: 47.65px; height: 37px; padding: 7px;" alt="icon" class="mx-2 mx-sm-4">
                                    <p class="break-sm-spaces">Free access Download Photo</p></li>
                                <li class="mil-accent mil-up"><img
                                        src="{{ asset('img/icons/checklist-black.svg') }}"
                                        style="width: 47.65px; height: 37px; padding: 7px;" alt="icon" class="mx-2 mx-sm-4">
                                    <p class="break-sm-spaces">Free access Upload Photo</p></li>
                            </ul>
                        </div>
                        <div class="mil-price-button mil-up">
                            <div class="mil-button mil-fw radius-8" style="background-color: #BCFF00 !important;"
                                onclick="payNow(56)">SUBSCRIBE</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mil-price-card mil-up mil-mb-30">
                        <div class="mil-price-head mil-up mil-mb-15">
                            <div class="mil-upper mil-dark mil-mb-10 mil-sm-center">Premium Pro</div>
                            <div class="mil-flex align-items-center gap-sm flex-max-sm-column mil-mb-30 justify-content-between">
                                <div class="mil-dark font-lg-24 text-max-sm-center l-height-normal font-700 l-height-30">UPGRADE TO <br class="d-max-sm-none">1 MONTH
                                </div>
                                <h3 class="mil-dark mil-price-text text-max-sm-center mil-right l-height-30">$7.00<br class="d-max-sm-none"><span
                                        class="mil-text-lg mil-extra-thin">/ Month</span></h3>
                            </div>
                        </div>
                        <div class="mil-divider-lg mil-up mil-mb-30"></div>
                        <div class="mil-price-body">
                            <ul class="mil-icon-list mil-mb-30">
                                <li class="mil-accent mil-up"><img
                                        src="{{ asset('img/icons/checklist-black.svg') }}"
                                        style="width: 47.65px; height: 37px; padding: 7px;" alt="icon" class="mx-2 mx-sm-4">
                                    <p class="break-sm-spaces">Free access Download Photo</p></li>
                                <li class="mil-accent mil-up"><img
                                        src="{{ asset('img/icons/checklist-black.svg') }}"
                                        style="width: 47.65px; height: 37px; padding: 7px;" alt="icon" class="mx-2 mx-sm-4">
                                    <p class="break-sm-spaces">Free access Upload Photo</p></li>
                            </ul>
                        </div>
                        <div class="mil-price-button mil-up">
                            <div class="mil-button mil-fw radius-8" onclick="payNow(7)">SUBSCRIBE</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('scripts')

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Gi66zXjpaBnxlOjR"></script>

    <script defer>
        async function getExchangeRate() {
            let response = await fetch("https://api.exchangerate-api.com/v4/latest/USD");
            let data = await response.json();
            return data.rates.IDR; // Ambil rate USD ke IDR
        }


        async function payNow(amount) {
            let exchangeRate = await getExchangeRate();
            let amountIDR = Math.round(amount * exchangeRate);
            try {
                let response = await fetch("{{ route('create.transaction') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    },
                    body: JSON.stringify({
                        amount: amountIDR
                    }),
                });

                let result = await response.json();
                if (result.snap_token) {
                    snap.pay(result.snap_token, {
                        // Optional
                        onSuccess: function (result) {
                            console.log(result); // Lihat hasil response lengkap

                            // Ambil data yang dibutuhkan dari result
                            const orderId = result.order_id;
                            const fraudStatus = result.fraud_status;
                            const grossAmount = result.gross_amount;
                            const statusCode = result.status_code;

                            fetch("{{ route('payment.notification') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "Accept": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                                },
                                body: JSON.stringify({
                                    order_id: orderId,
                                    fraud_status: fraudStatus,
                                    gross_amount: grossAmount,
                                    status_code: statusCode,
                                }),
                            })
                                .then(response => response.json())
                                .then(data => {
                                    console.log("Data sent to server: ", data);
                                })
                                .catch(error => {
                                    console.error("Error:", error);
                                });
                        },
                        // Optional
                        onPending: function (result) {
                        },
                        // Optional
                        onError: function (result) {
                    /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        }
                    });
                } else {
                    alert(`Gagal mendapatkan token pembayaran`);
                }
            } catch (error) {
                console.error("Error:", error);
            }
        }
    </script>

@endsection