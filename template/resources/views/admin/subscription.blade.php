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
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Plans</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Status</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Date limit</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Created at</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder"> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscription as $index => $item)
                                        <tr {!! Request::get('q') == $item->id ? 'class="bg-warning-subtle"' : '' !!} data-k="{{ Request::get('q') }}" data-n="{{ $item->id }}">
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}</span>
                                            </td>
                                            <td class="px-4">
                                                <div class="d-flex py-1">
                                                    <div>
                                                        <img src="{{ $item->user?->photo ? asset('storage/profile_photos/' . $item->user->photo) : asset('img/icons/user-elipse.svg') }}"
                                                            class="avatar avatar-sm me-3" loading="lazy" alt="User Profile">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->user?->name ?? 'anonymous' }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item->user?->email ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 text-center">
                                                <span class="text-secondary text-xs fw-bold">{{ $item->plans }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                @if ($item->status == 'pending')
                                                    <span class="badge bg-gradient-warning">Pending</span>
                                                @elseif ($item->ex_status)
                                                    <span class="badge bg-gradient-info">Active</span>
                                                @else
                                                    <span class="badge bg-gradient-danger">Expired</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary fw-bold text-xs">{{ date('d-m-Y H:m', strtotime($item->date_limit)) }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary fw-bold text-xs">{{ date('d-m-Y H:m', strtotime($item->created_at)) }}</span>
                                            </td>
                                            <td class="px-4 text-center">
                                                <div class="text-center flex justify-center space-x-4 actions">
                                                    <img src="{{ asset('assets/img/material-symbols_edit.svg') }}" class="btn-edit" 
                                                        data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#formModal">
                                                    <img src="{{ asset('assets/img/material-symbols_delete.svg') }}" class="btn-delete" 
                                                        data-id="{{ $item->id }}">
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

    <!-- Form Modal -->
    <div class="modal fade" id="formModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.subscription') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id">
    
                        <div class="mb-3">
                            <label class="form-label">Plans</label>
                            <select class="form-control" name="plans" id="plans" required>
                                <option value="Premium">Premium (1 Month)</option>
                                <option value="Premium Pro">Premium Pro (1 Year)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="pending">Pending</option>
                                <option value="active">Active</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date limit</label>
                            <input type="datetime-local" class="form-control" name="date_limit" id="date_limit" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info mb-0 btn-submit">Submit</button>
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
