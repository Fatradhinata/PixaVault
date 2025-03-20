@extends('templates.blank')
@section('title', 'Pricing | PixaVault')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
    <!-- Flash Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   <!-- content -->
   <div id="content">
    <div class="payment-details">
        <div class="payment-back">
            <img src="{{ asset('/img/icons/back.svg') }}" alt="back-icon">
            <p>Back</p>
        </div>
        <div class="payment-content">
            <div class="payment-method-wrapper">
                <h3>Payment details</h3>
                <div class="payment-method">
                    <p class="payment-method-title">Choose a payment method</p>
                    <div class="payment-bank">
                        <p>Transfer bank</p>
                        <div class="payment-option">
                            <input type="radio" id="bca-v-acc">
                            <label for="bca-v-acc">
                                <p>BCA Virtual Account</p>
                                <img src="{{ asset('/img/logo/bca.svg') }}" alt="BCA Virtual Account">
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" id="bri-v-acc">
                            <label for="bri-v-acc">
                                <p>BRI Virtual Account</p>
                                <img src="{{ asset('/img/logo/bri.svg') }}" alt="BRI Virtual Account">
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" id="mandiri-v-acc">
                            <label for="mandiri-v-acc">
                                <p>Mandiri Virtual Account</p>
                                <img src="{{ asset('/img/logo/mandiri.svg') }}" alt="Mandiri Virtual Account">
                            </label>
                        </div>
                    </div>
                    <div class="payment-ewallet">
                        <p>E-wallet</p>
                        <div class="payment-option">
                            <input type="radio" id="gopay-wallet">
                            <label for="gopay-wallet">
                                <p>Gopay</p>
                                <img src="{{ asset('/img/logo/Gopay.svg') }}" alt="Gopay">
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" id="shopeepay-wallet">
                            <label for="shopeepay-wallet">
                                <p>Shopeepay</p>
                                <img src="{{ asset('/img/logo/Shopee Pay.svg') }}" alt="Shopeepay">
                            </label>
                        </div>
                        <div class="payment-option">
                            <input type="radio" id="ovo-wallet">
                            <label for="ovo-wallet">
                                <p>OVO</p>
                                <img src="{{ asset('/img/logo/ovo.svg') }}" alt="OVO">
                            </label>
                        </div>
                    </div>
                    <div class="payment-email">
                        <p>Enter your email</p>
                        <input type="text" placeholder="Email">
                    </div>
                </div>
            </div>
            <hr>
            <div class="plan">
                <h3>Premium Pro</h3>
                <div class="plan-details">
                    <p>$7.00 <span>/ Month</span></p>
                    <div class="plan-options-wrapper">
                        <div class="plan-option-details">
                            <select name="select-plan" id="select-plan">
                                <option value="1 month">1 Month</option>
                                <option value="1 year">1 Year</option>
                            </select>
                            <hr>
                            <div class="plan-unlimited">
                                <p>Unlimited Access <span>X $7.00</span></p>
                                <p>$7.00</p>
                            </div>
                        </div>
                        <div class="plan-summary">
                            <div class="plan-summary-text plan-subtotal">
                                <p>Subtotal</p>
                                <p>$7.00</p>
                            </div>
                            <div class="plan-summary-text plan-tax">
                                <p>Tax</p>
                                <p>$0.00</p>
                            </div>
                            <hr>
                            <div class="plan-summary-text plan-total">
                                <p>Total due today</p>
                                <h4>$7.00</h4>
                            </div>
                        </div>
                    </div>
                    <button class="subscribe-button">SUBSCRIBE</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/upload.js') }}"></script>
@endsection
