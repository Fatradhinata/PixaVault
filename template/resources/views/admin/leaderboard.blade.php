@extends('templates.admin')

@section('styles')
    <style>
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #dddddd;
            border: none;
            border-radius: 2rem;
            margin-right: 5px;
            transition:  0.3s ease;
            transition-property: background-color, color;

            &.active {
                background-color: #0f0f0f;
                color: white;
            }
        }

        .tab-content {
            display: none;

            &.active {
                display: block;
            }
        }

        #extend-sub {
            display: none;

            &.show {
                display: block;
            }
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item text-sm text-dark fw-bold" aria-current="page">Leaderboard</li>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <button class="tab active" id="toggle-tab-likes">Likes</button>
                            <button class="tab" id="toggle-tab-downloads">Downloads</button>
                        </div>
                        <h3 class="text-secondary">{{ \Carbon\Carbon::now()->format('F Y') }}</h3>
                    </div>
                    <div class="card-body px-1 pt-0 pb-2">

                        <div class="table-responsive p-0 tab-content active" id="tab-likes">
                            <table class="table align-items-center mb-0 datatable-init">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">No</th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder">User</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Total Likes</th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder">Best Content 1</th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder">Best Content 2</th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder">Best Content 3</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaderboardLike as $index => $item)
                                        <tr>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}</span>
                                            </td>
                                            <td class="px-4">
                                                <div class="d-flex py-1">
                                                    <div>
                                                        <img src="{{  $item['photo'] ? asset('storage/profile_photos/' .  $item['photo']) : asset('img/icons/user-elipse.svg') }}"
                                                            class="avatar avatar-sm me-3" loading="lazy" alt="User Profile">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item['name'] ?? 'anonymous' }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item['email'] ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 text-center">
                                                <span class="text-secondary text-xs fw-bold">{{ $item['total'] }} Likes</span>
                                            </td>

                                            @php $contents = $item['top_contents']; @endphp

                                            <td class="px-4 text-center">
                                                <div class="d-flex flex-column justify-content-center text-start">
                                                    <a href="{{ route('admin.content') }}?q={{ $contents[0]['content_id'] }}" 
                                                        class="mb-0 text-sm fw-bold link">{{ mb_strimwidth($contents[0]['name'], 0, 30, "...") }}</a>
                                                    <p class="text-xs text-secondary mb-0">{{ $contents[0]['subtotal'] }} Likes</p>
                                                </div>
                                            </td>
                                            <td class="px-4 text-center">
                                                <div class="d-flex flex-column justify-content-center text-start">
                                                    <a href="{{ route('admin.content') }}?q={{ $contents[1]['content_id'] }}" 
                                                        class="mb-0 text-sm fw-bold link">{{ mb_strimwidth($contents[1]['name'], 0, 30, "...") }}</a>
                                                    <p class="text-xs text-secondary mb-0">{{ $contents[1]['subtotal'] }} Likes</p>
                                                </div>
                                            </td>
                                            <td class="px-4 text-center">
                                                <div class="d-flex flex-column justify-content-center text-start">
                                                    <a href="{{ route('admin.content') }}?q={{ $contents[2]['content_id'] }}" 
                                                        class="mb-0 text-sm fw-bold link">{{ mb_strimwidth($contents[2]['name'], 0, 30, "...") }}</a>
                                                    <p class="text-xs text-secondary mb-0">{{ $contents[2]['subtotal'] }} Likes</p>
                                                </div>
                                            </td>

                                            <td class="px-4 text-center">
                                                <div class="text-center flex justify-center space-x-4 actions">
                                                    <i class="fas fa-gift" style="transform: translateY(1px);" 
                                                        data-id="{{ $item['id'] }}" data-bs-toggle="modal" data-bs-target="#formModal"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive p-0 tab-content" id="tab-downloads">
                            <table class="table align-items-center mb-0 datatable-init">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">No</th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder">User</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Total Downloads</th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder">Best Content 1</th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder">Best Content 2</th>
                                        <th class="text-uppercase text-dark text-xs font-weight-bolder">Best Content 3</th>
                                        <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaderboardDownloads as $index => $item)
                                        <tr>
                                            <td class="align-middle text-center px-4">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}</span>
                                            </td>
                                            <td class="px-4">
                                                <div class="d-flex py-1">
                                                    <div>
                                                        <img src="{{  $item['photo'] ? asset('storage/profile_photos/' .  $item['photo']) : asset('img/icons/user-elipse.svg') }}"
                                                            class="avatar avatar-sm me-3" loading="lazy" alt="User Profile">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item['name'] ?? 'anonymous' }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item['email'] ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 text-center">
                                                <span class="text-secondary text-xs fw-bold">{{ $item['total'] }} Downloads</span>
                                            </td>

                                            @php $contents = $item['top_contents']; @endphp

                                            <td class="px-4 text-center">
                                                <div class="d-flex flex-column justify-content-center text-start">
                                                    <a href="{{ route('admin.content') }}?q={{ $contents[0]['content_id'] }}" 
                                                        class="mb-0 text-sm fw-bold link">{{ mb_strimwidth($contents[0]['name'], 0, 30, "...") }}</a>
                                                    <p class="text-xs text-secondary mb-0">{{ $contents[0]['subtotal'] }} Downloads</p>
                                                </div>
                                            </td>
                                            <td class="px-4 text-center">
                                                <div class="d-flex flex-column justify-content-center text-start">
                                                    <a href="{{ route('admin.content') }}?q={{ $contents[1]['content_id'] }}" 
                                                        class="mb-0 text-sm fw-bold link">{{ mb_strimwidth($contents[1]['name'], 0, 30, "...") }}</a>
                                                    <p class="text-xs text-secondary mb-0">{{ $contents[1]['subtotal'] }} Downloads</p>
                                                </div>
                                            </td>
                                            <td class="px-4 text-center">
                                                <div class="d-flex flex-column justify-content-center text-start">
                                                    <a href="{{ route('admin.content') }}?q={{ $contents[2]['content_id'] }}" 
                                                        class="mb-0 text-sm fw-bold link">{{ mb_strimwidth($contents[2]['name'], 0, 30, "...") }}</a>
                                                    <p class="text-xs text-secondary mb-0">{{ $contents[2]['subtotal'] }} Downloads</p>
                                                </div>
                                            </td>

                                            <td class="px-4 text-center">
                                                <div class="text-center flex justify-center space-x-4 actions">
                                                    <i class="fas fa-gift" style="transform: translateY(1px);" 
                                                        data-id="{{ $item['id'] }}" data-bs-toggle="modal" data-bs-target="#formModal"></i>
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
                    <h1 class="modal-title fs-5" id="formModalLabel">Send Gift</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.leaderboard') }}" method="POST">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="id" id="id">

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Most..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tier</label>
                            <select class="form-control" name="tier" id="tier">
                                <option hidden>Select Option</option>
                                <option value="mythic">Mythic (Background Purple)</option>
                                <option value="gold">Gold (Background Gold)</option>
                                <option value="silver">Silver (Background Silver)</option>
                                <option value="common">Common (Background Orange)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Badge Link (public link)</label>
                            <input type="text" class="form-control" name="badge" id="badge" placeholder="https://..." required>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="with-token" id="with-token">
                            <label class="form-check-label" for="with-token">With Token</label>
                        </div>
                        <div class="mb-3" id="extend-sub">
                            <label class="form-label">Extend Sub (Choose Plans)</label>
                            <select class="form-control" name="plans" id="plans">
                                <option hidden>Select Option</option>
                                <option value="Premium">Premium (1 Month)</option>
                                <option value="Premium Pro">Premium Pro (1 year)</option>
                            </select>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary mb-0 btn-submit">Send</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
    <script src="{{ asset('js/admin/leaderboard.js') }}"></script>
@endsection
