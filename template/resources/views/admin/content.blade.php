@extends('templates.admin')

@section('styles')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item text-sm text-dark fw-bold" aria-current="page">Content</li>
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
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder ">Author</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Photo</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Title</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Views</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Downloads</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Likes</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder "> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($content as $index => $item)
                                        <tr {!! Request::get('q') == $item->id ? 'class="bg-warning-subtle"' : '' !!}>
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
                                                        <h6 class="mb-0 text-sm">{{ $item->user?->name ?? "anonymous" }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item->user?->email ?? "-" }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 text-center">
                                                <div class="w-100">
                                                    <img src="{{ route('image', $item->photo) }}" class="avatar-lg" loading="lazy" alt="Image">
                                                </div>
                                            </td>
                                            <td class="px-4 text-center">
                                                <p class="text-sm font-weight-bold mb-0">{{ $item->name }}</p>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-sm">{{ $item->views }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-sm">{{ $item->downloads }}</span>
                                            </td>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-sm">{{ $item->likes }}</span>
                                            </td>
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
    <form action="{{ route('admin.content') }}" method="POST" style="display: none" id="form-delete">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id">
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('js/admin/content.js') }}"></script>
@endsection
