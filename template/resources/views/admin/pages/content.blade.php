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

        .controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}



        .show-entries {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #666;
}

#entries {
    padding: 6px 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: white;
}

.pagination {
    display: flex;
    align-items: center;
    gap: 8px;
}

.page-numbers {
    display: flex;
    gap: 4px;
}

.page-btn {
    padding: 8px 16px;
    border: none;
    
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.2s;
}

.page-btn:hover {
    background-color: #e0e0e0;
}

.page-btn:disabled {
    background-color: #f0f0f0;;
    cursor: not-allowed;
    opacity: 0.5;
}

.page-number {
    padding: 8px 16px;
    border: none;
    background-color: #ffff;
    cursor: pointer;
    border-radius: 8px;
    transition: all 0.2s;
}

.page-number:hover {
    background-color: #e0e0e0;
}

.page-number.active {
    background-color: #000;
    color: white;
}

.dots {
    padding: 8px 16px;
    user-select: none;
    transition: color 0.2s;
    border-radius: 8px;
    background-color: white;
}

.dots:hover {
    background-color: #e0e0e0;
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
          <a class="nav-link " href="{{ route('admin') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.305 9C14.075 9 13.8833 8.92333 13.73 8.77C13.5767 8.61667 13.5 8.421 13.5 8.183V4.817C13.5 4.579 13.578 4.38333 13.734 4.23C13.89 4.07667 14.0833 4 14.314 4H19.194C19.4253 4 19.6173 4.07667 19.77 4.23C19.9227 4.38333 19.9993 4.579 20 4.817V8.183C20 8.42167 19.922 8.61733 19.766 8.77C19.61 8.92333 19.4167 9 19.186 9H14.305ZM4.805 12C4.575 12 4.38333 11.9233 4.23 11.77C4.07667 11.6167 4 11.4267 4 11.2V4.8C4 4.57333 4.078 4.38333 4.234 4.23C4.39 4.07667 4.58333 4 4.814 4H9.694C9.92533 4 10.1173 4.07667 10.27 4.23C10.4227 4.38333 10.4993 4.57333 10.5 4.8V11.2C10.5 11.4267 10.422 11.6167 10.266 11.77C10.11 11.9233 9.91667 12 9.686 12H4.805ZM14.305 20C14.075 20 13.8833 19.9233 13.73 19.77C13.5767 19.6167 13.5 19.4267 13.5 19.2V12.8C13.5 12.5733 13.578 12.3833 13.734 12.23C13.89 12.0767 14.0833 12 14.314 12H19.194C19.4253 12 19.6173 12.0767 19.77 12.23C19.9227 12.3833 19.9993 12.5733 20 12.8V19.2C20 19.4267 19.922 19.6167 19.766 19.77C19.61 19.9233 19.4167 20 19.186 20H14.305ZM4.805 20C4.575 20 4.38333 19.9233 4.23 19.77C4.07667 19.6167 4 19.421 4 19.183V15.817C4 15.579 4.078 15.3833 4.234 15.23C4.39 15.0767 4.58333 15 4.814 15H9.694C9.92533 15 10.1173 15.0767 10.27 15.23C10.4227 15.3833 10.4993 15.579 10.5 15.817V19.183C10.5 19.4217 10.422 19.6173 10.266 19.77C10.11 19.9233 9.91667 20 9.686 20H4.805Z" fill="black"/>
                </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('admin.content') }}">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Content</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Content</h6>
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
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="controls">
                <div class="input-group">
                  <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" placeholder="Search..">
                </div>
                <div class="show-entries">
                <span>Show</span>
                <select id="entries">
                    <option value="1">1</option>
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
                <span>of <span id="total-entries">10</span></span>
            </div>
              </div>
            </div>
            <div class="card-body px-1 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Id</th>
                      <th class="text-uppercase text-dark text-xs font-weight-bolder ">Author</th>
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Photo</th>
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Title</th>
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Description</th>
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Tags</th>
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Views</th>
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Downloads</th>
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder ">Likes</th>
                      <th class="text-center text-uppercase text-dark text-xs font-weight-bolder "> Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs font-weight-bold">1</span>
                      </td>
                      <td class="px-4">
                        <div class="d-flex py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">John Michael</h6>
                            <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <div class="w-100">
                          <img src="../assets/img/Bromo.jpg" class="avatar-lg" alt="Bromo">
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <p class="text-sm font-weight-bold mb-0">Bromo Mountain</p>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">I take picture of Mountain...</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">Natures</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="px-4 text-center">
                        <div class="text-center flex justify-center space-x-4">
                          <img src="../assets/img/weui_eyes-on-filled.svg" alt="read"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                          <img src="../assets/img/material-symbols_delete.svg" alt="delete"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs font-weight-bold">2</span>
                      </td>
                      <td class="px-4">
                        <div class="d-flex py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Alexa Liras</h6>
                            <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <div class="w-100">
                          <img src="../assets/img/Bromo.jpg" class="avatar-lg" alt="Bromo">
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <p class="text-sm font-weight-bold mb-0">Bromo Mountain</p>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">I take picture of Mountain...</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">Natures</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="px-4 text-center">
                        <div class="text-center flex justify-center space-x-4">
                          <img src="../assets/img/weui_eyes-on-filled.svg" alt="read"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                          <img src="../assets/img/material-symbols_delete.svg" alt="delete"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs font-weight-bold">3</span>
                      </td>
                      <td class="px-4">
                        <div class="d-flex py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">John Michael</h6>
                            <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <div class="w-100">
                          <img src="../assets/img/Bromo.jpg" class="avatar-lg" alt="Bromo">
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <p class="text-sm font-weight-bold mb-0">Bromo Mountain</p>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">I take picture of Mountain...</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">Natures</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="px-4 text-center">
                        <div class="text-center flex justify-center space-x-4">
                          <img src="../assets/img/weui_eyes-on-filled.svg" alt="read"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                          <img src="../assets/img/material-symbols_delete.svg" alt="delete"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs font-weight-bold">4</span>
                      </td>
                      <td class="px-4">
                        <div class="d-flex py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Alexa Liras</h6>
                            <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <div class="w-100">
                          <img src="../assets/img/Bromo.jpg" class="avatar-lg" alt="Bromo">
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <p class="text-sm font-weight-bold mb-0">Bromo Mountain</p>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">I take picture of Mountain...</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">Natures</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="px-4 text-center">
                        <div class="text-center flex justify-center space-x-4">
                          <img src="../assets/img/weui_eyes-on-filled.svg" alt="read"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                          <img src="../assets/img/material-symbols_delete.svg" alt="delete"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs font-weight-bold">5</span>
                      </td>
                      <td class="px-4">
                        <div class="d-flex py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">John Michael</h6>
                            <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <div class="w-100">
                          <img src="../assets/img/Bromo.jpg" class="avatar-lg" alt="Bromo">
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <p class="text-sm font-weight-bold mb-0">Bromo Mountain</p>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">I take picture of Mountain...</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">Natures</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="px-4 text-center">
                        <div class="text-center flex justify-center space-x-4">
                          <img src="../assets/img/weui_eyes-on-filled.svg" alt="read"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                          <img src="../assets/img/material-symbols_delete.svg" alt="delete"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs font-weight-bold">6</span>
                      </td>
                      <td class="px-4">
                        <div class="d-flex py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Alexa Liras</h6>
                            <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <div class="w-100">
                          <img src="../assets/img/Bromo.jpg" class="avatar-lg" alt="Bromo">
                        </div>
                      </td>
                      <td class="px-4 text-center">
                        <p class="text-sm font-weight-bold mb-0">Bromo Mountain</p>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">I take picture of Mountain...</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">Natures</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="align-middle text-center px-4">
                        <span class="text-secondary text-xs">130</span>
                      </td>
                      <td class="px-4 text-center">
                        <div class="text-center flex justify-center space-x-4">
                          <img src="../assets/img/weui_eyes-on-filled.svg" alt="read"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                          <img src="../assets/img/material-symbols_delete.svg" alt="delete"
                               class="w-24 h-24 cursor-pointer hover:opacity-75 active:scale-90 transition">
                        </div>
                      </td>
                    </tr>               
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center my-1">
          <!-- Showing Entries -->
          <div class="text-secondary text-sm">
            Showing <span id="start">1</span> to <span id="end">6</span> of <span id="total">50</span> entries
          </div>
        
          <!-- Pagination -->
          <div class="pagination">
            <button id="prev" class="page-btn">Prev</button>
            <div id="page-numbers" class="page-numbers"></div>
            <button id="next" class="page-btn">Next</button>
        </div>
        </div>
        
      </div>
     
      <footer class="footer pt-3  ">
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
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn btn-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn btn-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
      
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <!-- js pagination -->
  <script>
const pageNumbers = document.getElementById('page-numbers');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');
const searchInput = document.getElementById('search');
const entriesSelect = document.getElementById('entries');
const totalEntriesSpan = document.getElementById('total-entries');

let currentPage = 1;
let totalPages = 10;
let entriesPerPage = parseInt(entriesSelect.value);

function createPagination() {
    const pages = [];
    
    // Always show first page + ellipsis + last page
    if (currentPage <= 3) {
        // Show 1, 2, 3, ..., totalPages
        for (let i = 1; i <= Math.min(3, totalPages); i++) {
            pages.push(i);
        }
        if (totalPages > 3) {
            pages.push('...');
            pages.push(totalPages);
        }
    } else if (currentPage >= totalPages - 2) {
        // Show 1, ..., totalPages-2, totalPages-1, totalPages
        pages.push(1);
        pages.push('...');
        for (let i = Math.max(totalPages - 2, 2); i <= totalPages; i++) {
            pages.push(i);
        }
    } else {
        // Show 1, ..., currentPage-1, currentPage, currentPage+1, ..., totalPages
        pages.push(1);
        pages.push('...');
        pages.push(currentPage - 1);
        pages.push(currentPage);
        pages.push(currentPage + 1);
        pages.push('...');
        pages.push(totalPages);
    }

    // Clear existing page numbers
    pageNumbers.innerHTML = '';

    // Create page number elements
    pages.forEach((page, index) => {
        if (page === '...') {
            const dots = document.createElement('span');
            dots.className = 'dots';
            dots.textContent = '...';
            
            // Determine if it's the first or second set of dots
            const isFirstDots = pages[index - 1] < currentPage;
            
            dots.addEventListener('click', () => {
                if (isFirstDots) {
                    // Jump backward by 3 pages, but not before page 1
                    currentPage = Math.max(1, currentPage - 3);
                } else {
                    // Jump forward by 3 pages, but not after last page
                    currentPage = Math.min(totalPages, currentPage + 3);
                }
                updatePagination();
            });
            
            pageNumbers.appendChild(dots);
        } else {
            const button = document.createElement('button');
            button.className = `page-number ${currentPage === page ? 'active' : ''}`;
            button.textContent = page;
            button.addEventListener('click', () => {
                if (page !== currentPage) {
                    currentPage = page;
                    updatePagination();
                }
            });
            pageNumbers.appendChild(button);
        }
    });

    // Update prev/next button states
    prevButton.disabled = currentPage === 1;
    nextButton.disabled = currentPage === totalPages;
}

function updatePagination() {
    createPagination();
    // Here you would typically fetch data for the new page
    console.log(`Current page: ${currentPage}, Showing ${entriesPerPage} entries`);
}

// Add event listeners for prev/next buttons
prevButton.addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        updatePagination();
    }
});

nextButton.addEventListener('click', () => {
    if (currentPage < totalPages) {
        currentPage++;
        updatePagination();
    }
});

// Add event listener for entries select
entriesSelect.addEventListener('change', (e) => {
    entriesPerPage = parseInt(e.target.value);
    totalPages = Math.ceil(parseInt(totalEntriesSpan.textContent) / entriesPerPage);
    currentPage = 1; // Reset to first page when changing entries per page
    updatePagination();
});

// Add event listener for search input
searchInput.addEventListener('input', (e) => {
    // Here you would typically implement search functionality
    console.log('Search query:', e.target.value);
});

// Initial pagination setup
createPagination();
</script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>