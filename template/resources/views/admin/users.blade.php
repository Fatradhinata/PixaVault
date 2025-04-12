@extends('templates.admin')

@section('styles')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item text-sm text-dark fw-bold" aria-current="page">Users</li>
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
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Photo</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Username</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Fullname</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Role</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Email</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Phone Number</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Credit Remaining</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Verified At</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Created At</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($users as $index => $item)
                                        <tr {!! ($item->role == 'admin') ? 'class="bg-warning-subtle"' : '' !!}>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <div>
                                                    <img src="{{ ($item->photo) ? asset('storage/profile_photos/' . $item->photo) : asset('img/icons/user-elipse.svg') }}" 
                                                        class="avatar avatar-sm me-3" loading="lazy" alt="User Profile">
                                                </div>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $item->name }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $item->full_name ?: "-" }}</span>
                                            </td>
                                            <td class="px-4 text-center">
                                                @if ($item->role == 'admin')
                                                    <span class="badge bg-gradient-warning">Admin</span>
                                                @else
                                                    <span class="badge badge-info">User</span>
                                                @endif
                                            </td>
                                            <td class="px-4 text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $item->email }}</span>
                                            </td>
                                            <td class="px-4 text-center">
                                                <p class="text-sm font-weight-bold mb-0">{{ $item->phone_number ?: '-' }}</p>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs">{{ $item->free_limit }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs">
                                                    @if ($item->verified_at)
                                                        {{ date('d-m-Y H:m', strtotime($item->verified_at)) }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs">{{ date('d-m-Y H:m', strtotime($item->created_at)) }}</span>
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
                    <form action="{{ route('admin.users') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="-">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="-">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-control" name="role" id="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="-">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="phone_number" id="phone_number" placeholder="-">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Credit Remaining</label>
                            <input type="number" class="form-control" name="free_limit" id="free_limit" placeholder="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Verified At</label>
                            <input type="datetime-local" class="form-control" name="verified_at" id="verified_at">
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
    <form action="{{ route('admin.users') }}" method="POST" style="display: none" id="form-delete">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id">
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/users.js') }}"></script>
@endsection
