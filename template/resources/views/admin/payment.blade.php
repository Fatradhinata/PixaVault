@extends('templates.admin')

@section('styles')
    <style>
        .hover {
            transition: transform 0.2s;

            &:hover {
                transform: scale(1.1);
            }
        }
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item text-sm text-dark fw-bold" aria-current="page">Subscription</li>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-1 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="datatable-init">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">No</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Order ID</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Amount (Rp)</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Payment Action</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Created At</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Status</th>
                                        {{-- <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Subscription</th> --}}
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment as $index => $item)
                                        <tr>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}</span>
                                            </td>
                                            <td class="px-4 text-center">
                                                <span class="badge bg-gradient-dark fw-bold ">{{ $item->order_id }}</span>
                                            </td>
                                            <td class="px-4 text-center">
                                                <p class="text-sm fw-bold mb-0">Rp {{ number_format($item->amount, 0, ',', '.'); }}</p>
                                            </td>
                                            <td class="px-4 text-center">
                                                <span class="text-secondary text-xs fw-bold">{{ ucfirst($item->action) }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary fw-bold text-xs">{{ date('d-m-Y H:m', strtotime($item->created_at)) }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                @if ($item->status == 'pending')
                                                    <span class="badge bg-gradient-warning">Pending</span>
                                                @elseif ($item->status == 'paid')
                                                    <span class="badge bg-gradient-success">Paid</span>
                                                @elseif ($item->status == 'rejected')
                                                    <span class="badge badge-dark text-white">Rejected</span>
                                                @endif
                                            </td>   
                                            {{-- <td class="px-4 text-center">
                                                <a class="btn bg-gradient-info btn-sm hover px-3 mb-0" href="">Detail</a>
                                            </td> --}}
                                            <td class="px-4 text-center">
                                                <div class="text-center flex justify-center space-x-4 actions">
                                                    <img src="{{ asset('assets/img/material-symbols_delete.svg') }}" class="btn-delete" data-id="{{ $item->id }}">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    <form action="{{ route('admin.payment') }}" method="POST" style="display: none" id="form-delete">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id">
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/payment.js') }}"></script>
@endsection
