<!--
=========================================================
* Soft UI Dashboard 3 - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Soft UI Dashboard 3 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.1.0') }}" rel="stylesheet" />

  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

  <style>
         .report-card {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;  /* Agar bisa mengecil */
    max-width: 510px;  /* Batas maksimum */
    min-width: 510px;  /* Supaya tidak terlalu kecil */
    height: auto;
}

/* Tambahkan media query untuk layar kecil */
@media (max-width: 600px) {
    .report-card {
      max-width: 510px;  /* Batas maksimum */
      min-width: 280px;  /* Supaya tidak terlalu kecil */
      padding: 15px;
    }
}

        .report-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 22px;
             border-bottom: 2px solid #eee; /* Garis bawah */
        }
        .chart-container {
            position: relative;
            width: 250px;
            height: 250px;
            margin: auto;
        }
        .report-average {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 32px;
            font-weight: 700;
            color: #222;
        }
        .report-legend {
            text-align: left;
            padding-top: 25px;
            padding-left: 50px;
            padding-right: 50px;

        }
        .report-legend-item {
            display: flex;
            align-items: center;
            font-size: 16px;
            font-weight: bold;
            color: #555;
            margin: 6px 0;
            padding: 10px;
            justify-content: space-between; /* Meletakkan teks di kiri dan angka di kanan */
        }
        .report-legend-color {
            width: 12px;
            height: 12px;
            display: inline-block;
            margin-right: 10px;
            border-radius: 50%;
        }
        .report-label {
    display: flex;
    align-items: center;
    gap: 10px; /* Beri jarak antara warna dan teks */
}

.report-value {
    font-weight:300; /* Bisa diatur lebih tegas */
    color: #7F7F7F;
}
        .report-approved { background: #b0ff27; }
        .report-pending { background: #ccc; }
        .report-review { background: #666; }
        .report-rejected { background: black; }

        .card-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: auto;
            
           
        }
        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            padding-bottom: 22px;
            border-bottom: 2px solid #eee; /* Garis bawah */
        }
        .chart-wrapper {
            position: relative;
            width: 100%;
            height: 250px;
            margin: auto;
        }

      
        .chart-joined {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: auto;
        } 

        .chart-title, .chart-subtitle {
            margin: 5px 0;
            color: #333;
        }
</style>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0 text-center" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html " target="_blank">
      <img src="{{ asset('assets/img/logos/logo pixa black.png') }}" class="navbar-brand-img h-100 text-center" alt="main_logo">
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  active" href="{{ route('admin') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.305 9C14.075 9 13.8833 8.92333 13.73 8.77C13.5767 8.61667 13.5 8.421 13.5 8.183V4.817C13.5 4.579 13.578 4.38333 13.734 4.23C13.89 4.07667 14.0833 4 14.314 4H19.194C19.4253 4 19.6173 4.07667 19.77 4.23C19.9227 4.38333 19.9993 4.579 20 4.817V8.183C20 8.42167 19.922 8.61733 19.766 8.77C19.61 8.92333 19.4167 9 19.186 9H14.305ZM4.805 12C4.575 12 4.38333 11.9233 4.23 11.77C4.07667 11.6167 4 11.4267 4 11.2V4.8C4 4.57333 4.078 4.38333 4.234 4.23C4.39 4.07667 4.58333 4 4.814 4H9.694C9.92533 4 10.1173 4.07667 10.27 4.23C10.4227 4.38333 10.4993 4.57333 10.5 4.8V11.2C10.5 11.4267 10.422 11.6167 10.266 11.77C10.11 11.9233 9.91667 12 9.686 12H4.805ZM14.305 20C14.075 20 13.8833 19.9233 13.73 19.77C13.5767 19.6167 13.5 19.4267 13.5 19.2V12.8C13.5 12.5733 13.578 12.3833 13.734 12.23C13.89 12.0767 14.0833 12 14.314 12H19.194C19.4253 12 19.6173 12.0767 19.77 12.23C19.9227 12.3833 19.9993 12.5733 20 12.8V19.2C20 19.4267 19.922 19.6167 19.766 19.77C19.61 19.9233 19.4167 20 19.186 20H14.305ZM4.805 20C4.575 20 4.38333 19.9233 4.23 19.77C4.07667 19.6167 4 19.421 4 19.183V15.817C4 15.579 4.078 15.3833 4.234 15.23C4.39 15.0767 4.58333 15 4.814 15H9.694C9.92533 15 10.1173 15.0767 10.27 15.23C10.4227 15.3833 10.4993 15.579 10.5 15.817V19.183C10.5 19.4217 10.422 19.6173 10.266 19.77C10.11 19.9233 9.91667 20 9.686 20H4.805Z" fill="black"/>
                </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="{{ route('admin.content') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18C8.45 18 7.97933 17.8043 7.588 17.413C7.19667 17.0217 7.00067 16.5507 7 16V4C7 3.45 7.196 2.97933 7.588 2.588C7.98 2.19667 8.45067 2.00067 9 2H18C18.55 2 19.021 2.196 19.413 2.588C19.805 2.98 20.0007 3.45067 20 4V16C20 16.55 19.8043 17.021 19.413 17.413C19.0217 17.805 18.5507 18.0007 18 18H9ZM5 22C4.45 22 3.97933 21.8043 3.588 21.413C3.19667 21.0217 3.00067 20.5507 3 20V6H5V20H16V22H5Z" fill="black"/>
                </svg>
                
            </div>
            <span class="nav-link-text ms-1">Content</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="{{ route('admin.subscription') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 1C0.896875 1 0 1.89688 0 3V4H18V3C18 1.89688 17.1031 1 16 1H2ZM18 7H0V13C0 14.1031 0.896875 15 2 15H16C17.1031 15 18 14.1031 18 13V7ZM3.5 11H5.5C5.775 11 6 11.225 6 11.5C6 11.775 5.775 12 5.5 12H3.5C3.225 12 3 11.775 3 11.5C3 11.225 3.225 11 3.5 11ZM7 11.5C7 11.225 7.225 11 7.5 11H11.5C11.775 11 12 11.225 12 11.5C12 11.775 11.775 12 11.5 12H7.5C7.225 12 7 11.775 7 11.5Z" fill="black"/>
                </svg>
            </div>
            <span class="nav-link-text ms-1">Subscription</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="{{ route('admin.user-admin') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_761_311)">
                <path d="M7 8C9.20938 8 11 6.20937 11 4C11 1.79063 9.20938 0 7 0C4.79063 0 3 1.79063 3 4C3 6.20937 4.79063 8 7 8ZM9.8 9H9.27812C8.58437 9.31875 7.8125 9.5 7 9.5C6.1875 9.5 5.41875 9.31875 4.72188 9H4.2C1.88125 9 0 10.8813 0 13.2V14.5C0 15.3281 0.671875 16 1.5 16H12.5C13.3281 16 14 15.3281 14 14.5V13.2C14 10.8813 12.1187 9 9.8 9Z" fill="black"/>
                </g>
                <defs>
                <clipPath id="clip0_761_311">
                <rect width="14" height="16" fill="white"/>
                </clipPath>
                </defs>
                </svg>
                
            </div>
            <span class="nav-link-text ms-1">User</span>
          </a>
        </li>

      </ul>
    </div>
    <div class="sidenav-footer mx-3 " style="margin-top: 60%;">
      <a class="btn btn-dark mt-3 w-100"  href="https://www.creative-tim.com/product/soft-ui-dashboard-pro?ref=sidebarfree">Logout</a>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end"> 
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <h5>Hello, William Maulana</h5>
      <p>Here's your dashboard</p>
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="card">
                <span class="mask bg-white opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class="icon icon-shape bg-black shadow text-center border-radius-2xl">
                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="mt-1">
                          <g clip-path="url(#clip0_761_311)">
                          <path d="M7 8C9.20938 8 11 6.20937 11 4C11 1.79063 9.20938 0 7 0C4.79063 0 3 1.79063 3 4C3 6.20937 4.79063 8 7 8ZM9.8 9H9.27812C8.58437 9.31875 7.8125 9.5 7 9.5C6.1875 9.5 5.41875 9.31875 4.72188 9H4.2C1.88125 9 0 10.8813 0 13.2V14.5C0 15.3281 0.671875 16 1.5 16H12.5C13.3281 16 14 15.3281 14 14.5V13.2C14 10.8813 12.1187 9 9.8 9Z" fill="white"/>
                          </g>
                          <defs>
                          <clipPath id="clip0_761_311">
                          <rect width="14" height="16" fill="white"/>
                          </clipPath>
                          </defs>
                          </svg>
                      </div>
                      <h6 class="text-black font-weight-bolder mb-0 mt-3">
                        230
                      </h6>
                      <span class="text-black text-sm">Total Users</span>
                    </div>
                    <div class="col-4 text-center">
                     
                      <h6 class="text-black text-end font-weight-bolder mt-auto mb-0">+55%</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
              <div class="card">
                <span class="mask bg-white opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class="icon icon-shape bg-black shadow text-center border-radius-2xl" >
                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="mt-1
                        ">
                          <path d="M2 1C0.896875 1 0 1.89688 0 3V4H18V3C18 1.89688 17.1031 1 16 1H2ZM18 7H0V13C0 14.1031 0.896875 15 2 15H16C17.1031 15 18 14.1031 18 13V7ZM3.5 11H5.5C5.775 11 6 11.225 6 11.5C6 11.775 5.775 12 5.5 12H3.5C3.225 12 3 11.775 3 11.5C3 11.225 3.225 11 3.5 11ZM7 11.5C7 11.225 7.225 11 7.5 11H11.5C11.775 11 12 11.225 12 11.5C12 11.775 11.775 12 11.5 12H7.5C7.225 12 7 11.775 7 11.5Z" fill="white"/>
                          </svg>                          
                      </div>
                      <h6 class="text-black font-weight-bolder mb-0 mt-3">
                        1.200
                      </h6>
                      <span class="text-black text-sm">Paid Subs</span>
                    </div>
                    <div class="col-4">
                     
                      <h6 class="text-black text-sm text-end font-weight-bolder mt-auto mb-0">+124%</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="card">
                <span class="mask bg-white opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class="icon icon-shape bg-black shadow text-center border-radius-2xl">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mt-1">
                          <path d="M9 18C8.45 18 7.97933 17.8043 7.588 17.413C7.19667 17.0217 7.00067 16.5507 7 16V4C7 3.45 7.196 2.97933 7.588 2.588C7.98 2.19667 8.45067 2.00067 9 2H18C18.55 2 19.021 2.196 19.413 2.588C19.805 2.98 20.0007 3.45067 20 4V16C20 16.55 19.8043 17.021 19.413 17.413C19.0217 17.805 18.5507 18.0007 18 18H9ZM5 22C4.45 22 3.97933 21.8043 3.588 21.413C3.19667 21.0217 3.00067 20.5507 3 20V6H5V20H16V22H5Z" fill="white"/>
                          </svg>
                          
                      </div>
                      <h6 class="text-black font-weight-bolder mb-0 mt-3">
                        930
                      </h6>
                      <span class="text-black text-sm">Total Content</span>
                    </div>
                    <div class="col-4">
                    
                      <h6 class="text-black text-sm text-end font-weight-bolder mt-auto mb-0">+26%</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
              <div class="card">
                <span class="mask bg-white opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class="icon icon-shape bg-black shadow text-center border-radius-2xl">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M19.4956 19.2985L2.50429 19.2995C2.34338 19.2995 2.18531 19.2571 2.04596 19.1766C1.90662 19.0962 1.7909 18.9805 1.71045 18.8411C1.63 18.7018 1.58765 18.5437 1.58765 18.3828C1.58765 18.2219 1.63 18.0638 1.71046 17.9245L10.2043 3.20829C10.2847 3.06895 10.4005 2.95325 10.5398 2.8728C10.6792 2.79235 10.8372 2.75 10.9981 2.75C11.159 2.75 11.3171 2.79235 11.4564 2.8728C11.5958 2.95325 11.7115 3.06895 11.792 3.20829L20.2895 17.9235C20.3699 18.0629 20.4123 18.221 20.4123 18.3819C20.4123 18.5428 20.3699 18.7008 20.2895 18.8402C20.209 18.9795 20.0933 19.0953 19.9539 19.1757C19.8146 19.2562 19.6565 19.2985 19.4956 19.2985ZM10.3106 8.74954L10.417 13.9434H11.583L11.6902 8.74954H10.3106ZM10.9981 16.6072C11.4381 16.6072 11.7819 16.269 11.7819 15.8445C11.7819 15.4201 11.4381 15.0874 10.9972 15.0874C10.8961 15.0849 10.7955 15.1027 10.7013 15.1396C10.6071 15.1765 10.5212 15.2318 10.4486 15.3024C10.3761 15.3729 10.3183 15.4571 10.2787 15.5502C10.2391 15.6433 10.2185 15.7434 10.218 15.8445C10.218 16.269 10.5618 16.6072 10.9972 16.6072H10.9981Z" fill="white"/>
                          </svg>
                          
                      </div>
                      <h6 class="text-black font-weight-bolder mb-0 mt-3">
                        23
                      </h6>
                      <span class="text-black text-sm">Total Report</span>
                    </div>
                    <div class="col-4">
                    
                      <h6 class="text-black text-sm text-end font-weight-bolder mt-auto mb-0">+6%</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <!-- Weekly Revenue -->
            <div class="col-lg-12 col-md-12">
              <div class="card-container">
                <p style="color: #7F7F7F; margin-bottom: 0;">Statistics</p>
                <div class="card-title">Weekly Revenue</div>
                <div class="chart-wrapper">
                  <canvas id="revenueChart"></canvas>
                </div>
              </div>
            </div>
          </div>
          
        </div>
         <!-- Report Content Card -->
         <div class="col-lg-4 col-12 mt-4 mt-lg-0">
          <div class="report-card">
            <p class="mt-2" style="color: #7F7F7F; margin-bottom: 0;">Statistics</p>
            <div class="report-title">Report Content</div>
            <div class="chart-container mt-5 mb-4">
                <canvas id="reportChart"></canvas>
                <div class="report-average">1.05</div>
            </div>
            <div class="report-legend">
              <div class="report-legend-item">
                  <div class="report-label">
                      <span class="report-legend-color report-approved"></span> Approved
                  </div>
                  <div class="report-value">410</div>
              </div>
              <div class="report-legend-item">
                  <div class="report-label">
                      <span class="report-legend-color report-pending"></span> Pending
                  </div>
                  <div class="report-value">142</div>
              </div>
              <div class="report-legend-item">
                  <div class="report-label">
                      <span class="report-legend-color report-review"></span> Under Review
                  </div>
                  <div class="report-value">340</div>
              </div>
              <div class="report-legend-item">
                  <div class="report-label">
                      <span class="report-legend-color report-rejected"></span> Rejected
                  </div>
                  <div class="report-value">590</div>
              </div>
          </div>
          
        </div>
        </div>
        </div>

        <div class="row mt-4">
          <div class="col-12 col-md-12">
            <div class="chart-joined">
               <p style="color: #7F7F7F; margin-bottom: 0;">Activity</p>
                    <div class="card-title">Newly Joined Users</div>
              <canvas id="newUsersChart"></canvas>
            </div>  
            </div>

        </div>
        </div>       
    </div>
  </main>
  
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#fff",
          data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Inter",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false
            },
            ticks: {
              display: false
            },
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

          },
          {
            label: "Websites",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Inter",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Inter",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
      const canvas = document.getElementById('reportChart');
      if (canvas) {
          const ctx = canvas.getContext('2d');
          new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: ['Approved', 'Pending', 'Under Review', 'Rejected'],
                  datasets: [{
                      data: [410, 142, 340, 590],
                      backgroundColor: ['#b0ff27', '#ccc', '#666', 'black'],
                      borderWidth: 0
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  cutout: '70%',
                  plugins: {
                      legend: { display: false }
                  }
              }
          });
      } else {
          console.error("Canvas 'reportChart' not found!");
      }
  });
  </script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
    <script>
     document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById("revenueChart").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri"],
            datasets: [{
                label: "Revenue",
                data: [20000, 33567, 29000, 18000, 10000],
                backgroundColor: "#b0ff27",
                borderRadius: 10,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) { return value / 1000 + "k"; }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return "$" + tooltipItem.raw.toLocaleString();
                        }
                    }
                }
            }
        }
    });
});

  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('newUsersChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
            datasets: [{
                label: "New Users",
                data: [500, 2000, 1800, 400, 1700, 2200, 1200, 600, 1900, 500, 2100, 2300],
                backgroundColor: '#b0ff27',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 6000,
                    ticks: { stepSize: 1000 }
                }
            }
        }
    });
});

  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>