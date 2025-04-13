<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">

    <title>Pixavault - Admin</title>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link rel="stylesheet" href="{{ asset('assets/css/soft-ui-dashboard.css') }}" />
    <style>
        .actions :is(img, i) {
            color: #868686;
            cursor: pointer;
            transition: filter 0.3s ease;

            &:hover {
                filter: brightness(0.5);
            }
        }

        .hover {
            transition: transform 0.2s;

            &:hover {
                transform: scale(1.1);
            }
        }

        .dataTable-container {
            max-width: 100% !important;
            overflow-x: auto !important;
            margin-bottom: 1rem !important;
        }
    </style>
    
    @yield('styles')

</head>

<body class="g-sidenav-show  bg-gray-100">
    
    @include('components.flasher')

    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0 text-center" href="{{ route('admin') }}">
                <img src="{{ asset('assets/img/logos/logo pixa black.png') }}" 
                    class="navbar-brand-img text-center" alt="main_logo" style="width: 200px; object-fit: cover;">
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin') ? 'active' : '' }}" href="{{ route('admin') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas text-sm fa-home" style="transform: scale(1) translateY(-2px); color: black;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.content') ? 'active' : '' }}" href="{{ route('admin.content') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas text-sm fa-image" style="transform: scale(1) translateY(-2px); color: black;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Content</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.leaderboard') ? 'active' : '' }}" href="{{ route('admin.leaderboard') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas text-sm fa-flag" style="transform: scale(1) translateY(-2px); color: black;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Leaderboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.subscription') ? 'active' : '' }}" href="{{ route('admin.subscription') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas text-sm fa-credit-card" style="transform: scale(1) translateY(-2px); color: black;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Subscription</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.payment') ? 'active' : '' }}" href="{{ route('admin.payment') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas text-sm fa-receipt" style="transform: scale(1) translateY(-2px); color: black;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Payment</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas text-sm fa-user" style="transform: scale(1) translateY(-2px); color: black;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Users</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.report') ? 'active' : '' }}" href="{{ route('admin.report') }}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas text-sm fa-flag" style="transform: scale(1) translateY(-2px); color: black;"></i>
                        </div>
                        <span class="nav-link-text ms-1">Report</span>
                    </a>
                </li>

            </ul>
        </div>

    </aside>


    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 p-0 ps-2 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-dark">Admin</a>
                        </li>

                        @yield('breadcrumb')

                    </ol>
                </nav>
                <div class="collapse navbar-collapse justify-content-end mt-sm-0 mt-2 me-2" id="navbar">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-sm btn-outline-dark my-0 px-3 me-sm-4 me-xl-0" href="{{ route('logout') }}">
                            Logout
                        </a>
                    </div>
                    <ul class="navbar-nav" style="width: unset;">
                        <li class="nav-item d-xl-none d-flex align-items-center">
                            <button type="button" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <footer class="footer pb-3 px-3">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">

                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    </main>

    <!--   Core JS Files   -->
    <script src="{{ asset('js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/soft-ui-dashboard.min.js') }}"></script>
    <script src="{{ asset('js/plugins/swal.min.js') }}"></script>

    <script src="{{ asset('js/plugins/datatable.js') }}"></script>

    @yield('scripts')
    
    <input type="checkbox" id="navbarFixed" style="display: none;" checked>
    <script>
        if (document.getElementById('datatable-init')) {
            const dataTableBasic = new simpleDatatables.DataTable("#datatable-init");
        }

        document.addEventListener('DOMContentLoaded', () => {
            navbarFixed(document.querySelector('#navbarFixed'));
        })
    </script>
</body>

</html>
