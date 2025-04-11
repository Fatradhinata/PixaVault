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
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">No</th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder ">photo</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">username</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">fullname</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">email</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">phone number</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">credit remaining</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">verified at</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">created at</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($users as $index => $item)
                                        <tr>
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
                                                <span class="text-secondary text-xs font-weight-bold">{{ $item->email }}</span>
                                            </td>
                                            <td class="px-4 text-center">
                                                <p class="text-sm font-weight-bold mb-0">{{ $item->phone_number ?: '-' }}</p>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs">{{ $item->free_limit }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs">{{ date('d-m-Y H:m', strtotime($item->verified_at)) }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs">{{ date('d-m-Y H:m', strtotime($item->created_at)) }}</span>
                                            </td>
                                            <td class="px-4 text-center">
                                                <div class="text-center flex justify-center space-x-4 actions">
                                                    <img src="{{ asset('assets/img/weui_eyes-on-filled.svg') }}" class="btn-detail">
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
    <form action="{{ route('admin.users') }}" method="POST" style="display: none" id="form-delete">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id">
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin-users.js') }}"></script>
@endsection
