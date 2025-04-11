@extends('templates.admin')

@section('styles')
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
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">No</th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder">User</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">subs package</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">order id</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">amount (Rp)</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">method</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">status</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">date limit</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">created at</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder"> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscription as $item)
                                        
                                        <tr>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs font-weight-bold">1</span>
                                            </td>
                                            <td class="px-4">
                                                <div class="d-flex py-1">
                                                    <div>
                                                        <img src="{{ $item->user?->photo ? asset('storage/profile_photos/' . $item->user->photo) : asset('img/icons/user-elipse.svg') }}" 
                                                            class="avatar avatar-sm me-3" loading="lazy" alt="User Profile">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->user?->name ?? "anonymous" }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item->user?->email ?? "-" }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    @if ($item->month_diff < 12)
                                                        {{ $item->month_diff }} month
                                                    @else
                                                        1 year
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="px-4 text-center">
                                                <span class="text-secondary text-xs fw-bold">{{ $item->order_id }}</span>
                                            </td>
                                            <td class="px-4 text-center">
                                                <p class="text-sm fw-bold mb-0">Rp {{ number_format($item->amount, 0, ',', '.'); }}</p>
                                            </td>
                                            <td class="px-4 text-center">
                                                <span class="text-secondary text-xs fw-bold">{{ ucfirst($item->payment_type) }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                @if ($item->status == 'pending')
                                                    <span class="badge bg-gradient-warning">Pending</span>
                                                @elseif ($item->status == 'pending' && $item->ex_status)
                                                    <span class="badge bg-gradient-info">Active</span>
                                                @else
                                                    <span class="badge bg-gradient-danger">Expired</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary fw-bold text-xs">{{ date('d-m-Y', strtotime($item->date_limit)) }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary fw-bold text-xs">{{ date('d-m-Y H:m', strtotime($item->created_at)) }}</span>
                                            </td>
                                            <td class="px-4 text-center">
                                                <div class="text-center flex justify-center space-x-4 actions">
                                                    <img src="{{ asset('assets/img/material-symbols_edit.svg') }}" class="btn-edit">
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
    <form action="{{ route('admin.subscription') }}" method="POST" style="display: none" id="form-delete">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id">
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/subscription.js') }}"></script>
@endsection
