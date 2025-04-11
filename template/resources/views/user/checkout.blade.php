@extends('templates.user')

@section('title', 'Pricing')

@section('navbar')
    @include('components.navbar')
    <style>
        .mil-top-panel {
            .mil-logo img {
                filter: invert(1);
            }

            .nav-min-sm {
                filter: invert(1);
                transition: filter 0.3s ease;
            }

            .mil-credit,
            .mil-explore {
                color: black
            }

            .nav-horizontal-dot {
                img {
                    filter: invert(1);
                }

                &:hover {
                    background-color: #000;

                    img {
                        filter: invert(0);
                    }
                }
            }

            &.mil-active {
                .nav-horizontal-dot {
                    img {
                        filter: invert(0) !important;
                    }

                    &:hover {
                        background-color: #fff;

                        img {
                            filter: invert(1) !important;
                        }
                    }
                }

                .nav-min-sm {
                    filter: invert(0) !important;
                }

                .mil-credit * {
                    color: white;
                }
            }
        }

        .detail-payments {
            h3 {
                font-size: clamp(1.5rem, 4vw, 2.2rem);
                font-weight: 600;
                color: gray;
                margin-bottom: 1.5rem;
                padding-left: 1.5rem;
                border-left: 5px solid rgb(229, 229, 229);
                border-image: repeating-linear-gradient(-45deg, transparent, transparent 1px, #A0A0A0 1px, #A0A0A0 3px) 5;
            }

            .table-responsive {
                margin: 1rem auto;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;

                table {
                    min-width: 100%;
                    border-collapse: collapse;
                    border: none !important;
                    outline: 1px solid #ddd;
                    overflow: hidden;
                    border-radius: 12px;

                    &,
                    th,
                    td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        font-size: 1.2rem;
                    }

                    td {
                        padding: 1rem;
                    }
                }
            }

            @media (max-width: 1200px) {
                order: 2;
            }

            .fw-bold {
                font-weight: 500;
            }

            .buttons {
                button {
                    font-size: 1rem;

                    &.mil-button-danger {
                        cursor: pointer;
                        display: inline-flex;
                        width: 100%;
                        align-items: center;
                        justify-content: center;
                        border: none;
                        background-color: #ef4444 !important;
                        color: white;
                        padding: 0 60px;
                        height: 70px;
                        text-transform: uppercase;
                        font-weight: 600;
                        transition: 0.2s cubic-bezier(0, 0, 0.3642, 1);

                        &:hover {
                            background-color: #dc2626 !important;
                        }
                    }
                }
            }


        }
    </style>
@endsection

@section('content')
    <!-- team -->
    <section id="subscribe" style="background-color: #f0f0f0;">
        <div class="container mil-p-120-90 price">
            <div class="mil-background-grid mil-softened"></div>
            <div class="row">
                <div class="col-12">
                    <div class="mil-center mil-mb-40">
                        <h3 class="mil-suptitle mil-upper mil-up mil-mb-30 mt-5">Checkout</h3>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mil-price-card mil-up mil-mb-30 p-5" style="background-color: white;">
                        <div class="row">
                            <div class="col-lg-12 col-xl-7 flex-column align-items-start justify-content-center detail-payments">
                                <h3>Detail Payment</h3>
                                <div class="table-responsive">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Title</td>
                                                <td class="fw-bold">
                                                    @if ($payment->action == 'purchase')
                                                        Purchase Subsciption Plan
                                                    @else
                                                        Extends Subsciption Plan
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Type</td>
                                                <td class="fw-bold">
                                                    @if ($payment->action == 'purchase')
                                                        @if ($payment->subscription->plans == 'Premium')
                                                            Premium (1 Month)
                                                        @else
                                                            Premium Pro (1 Year)
                                                        @endif
                                                    @else    
                                                        @if ($payment->action == 'extends 1 month')
                                                            Premium (1 Month)
                                                        @elseif ($payment->action == 'extends 1 year')
                                                            Premium Pro (1 Year)
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Gross Amount</td>
                                                <td class="fw-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row buttons">
                                    <div class="col-md-6">
                                        <button type="button" class="mil-button mil-fw radius-8 mt-4" id="pay-btn">
                                            Pay Now
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="mil-button-danger mil-fw radius-8 mt-4" id="cancel-btn" data-id="{{ $payment->id }}">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-5 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('img/logo/logo_pixavault_black.png') }}" class="my-5" alt="pixavault">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form action="{{ route('payment.cancel', $payment->id) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

@endsection


@section('scripts')

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Gi66zXjpaBnxlOjR"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const snapToken = "{{ $snapToken }}";
            const cancelBtn = document.getElementById('cancel-btn');
            const payBtn = document.getElementById('pay-btn');

            payBtn.addEventListener('click', function() {
                try {
                    snap.pay(snapToken, {
                        onSuccess: function(result) {
                            const orderId = result.order_id;
                            window.location.href = "{{ route('payment', '') }}/" + orderId;
                        },
                        onPending: function(result) {},
                        onError: function(result) {}
                    });
                } catch (error) {
                    console.error("Error:", error);
                }
            });

            cancelBtn.addEventListener('click', function() {
               Swal.fire({
                    title: 'Caution',
                    text: "Are you sure want to cancel this payment?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#1f1f1f',
                    confirmButtonText: 'Yes, delete it!'
                }).then(res => {
                    if (res.isConfirmed) {
                        document.getElementById('delete-form').submit();   
                    }
                });
            });
        });
    </script>

@endsection
