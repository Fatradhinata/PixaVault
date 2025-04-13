@extends('templates.admin')

@section('breadcrumb')
    <li class="breadcrumb-item text-sm text-dark fw-bold" aria-current="page">Report</li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-report.css') }}">
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
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder">Complainant</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Type</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Reason</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Status</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report as $index => $item)
                                        <tr>
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
                                                @if (is_null($item->id_content) && is_null($item->id_comment))
                                                    <span class="badge badge-danger">User</span>
                                                @elseif (is_null($item->id_comment))
                                                    <span class="badge badge-warning">Content</span>
                                                @else
                                                    <span class="badge badge-dark">Comment</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-sm">{{ $item->reason }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                @if ($item->status == 'pending')
                                                    <span class="btn btn-sm px-3 mb-0 btn-secondary hover btn-resolve" data-url="{{ route('admin.report') }}/resolve/{{ $item->id }}">
                                                        Pending
                                                    </span>
                                                @else
                                                    <span class="btn btn-sm px-3 mb-0 btn-dark mb-0">Approved</span>
                                                @endif
                                            </td>
                                            <td class="px-4 text-center">
                                                <div class="text-center flex justify-center space-x-4 actions">
                                                    <img src="{{ asset('assets/img/weui_eyes-on-filled.svg') }}" class="btn-detail"
                                                        data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#formDetail">
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

    
    <div class="modal fade" id="formDetail"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formDetailLabel">Report Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="card-container card-user">
                    </div>

                    <div class="card-container card-content show">
                    </div>

                    <div class="card-container card-comment">
                    </div>

                    <div class="detail-report">
                        <div class="mb-3">
                            <label class="form-label text-sm text-muted">Reason :</label>
                            <input type="text" class="form-control" id="reason" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-sm text-muted">Detail :</label>
                            <textarea class="form-control" id="detail" rows="10" disabled></textarea>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    <form action="{{ route('admin.report') }}" method="POST" style="display: none" id="form-delete">
        @csrf
        @method('DELETE')

        <input type="hidden" name="id">
    </form>
    
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/report.js') }}"></script>
@endsection
