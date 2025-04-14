@extends('templates.admin')

@section('styles')
    <style>
        .report-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: auto;
        }

        /* Tambahkan media query untuk layar kecil */
        @media (max-width: 600px) {
            .report-card {
                padding: 15px;
            }
        }

        .report-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 22px;
            border-bottom: 2px solid #eee;
            /* Garis bawah */
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
            justify-content: space-between;
            /* Meletakkan teks di kiri dan angka di kanan */
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
            gap: 10px;
            /* Beri jarak antara warna dan teks */
        }

        .report-value {
            font-weight: 300;
            /* Bisa diatur lebih tegas */
            color: #7F7F7F;
        }

        .report-approved {
            background: #b0ff27;
        }

        .report-pending {
            background: #ccc;
        }

        .report-review {
            background: #666;
        }

        .report-rejected {
            background: black;
        }

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
            border-bottom: 2px solid #eee;
            /* Garis bawah */
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

        .chart-title,
        .chart-subtitle {
            margin: 5px 0;
            color: #333;
        }
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item text-sm text-dark fw-bold" aria-current="page">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="mt-3 mb-5 rounded-3 p-4" style="background: linear-gradient(45deg,#141727,#3a416f);">
            <h5 class="text-white fs-3 mb-0">Hello, {{ ucfirst(Auth::user()->name) }}!</h5>
            <p class="text-white text-md mb-0">Here's your dashboard🚀</p>
        </div>
        <div class="row">

            <div class="col-xxl-8 col-lg-6 col-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <span class="mask bg-white opacity-10 border-radius-lg"></span>
                            <div class="card-body p-3 position-relative">
                                <div class="row">
                                    <div class="col-8 text-start">
                                        <div class="icon icon-shape bg-black shadow border-radius-2xl d-flex justify-content-center align-items-center">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_761_311)">
                                                    <path
                                                        d="M7 8C9.20938 8 11 6.20937 11 4C11 1.79063 9.20938 0 7 0C4.79063 0 3 1.79063 3 4C3 6.20937 4.79063 8 7 8ZM9.8 9H9.27812C8.58437 9.31875 7.8125 9.5 7 9.5C6.1875 9.5 5.41875 9.31875 4.72188 9H4.2C1.88125 9 0 10.8813 0 13.2V14.5C0 15.3281 0.671875 16 1.5 16H12.5C13.3281 16 14 15.3281 14 14.5V13.2C14 10.8813 12.1187 9 9.8 9Z"
                                                        fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_761_311">
                                                        <rect width="14" height="16" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <h6 class="text-black font-weight-bolder mb-0 mt-3">
                                            {{ $users }}
                                        </h6>
                                        <span class="text-black text-sm">Total Users</span>
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
                                        <div class="icon icon-shape bg-black shadow border-radius-2xl d-flex justify-content-center align-items-center">
                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2 1C0.896875 1 0 1.89688 0 3V4H18V3C18 1.89688 17.1031 1 16 1H2ZM18 7H0V13C0 14.1031 0.896875 15 2 15H16C17.1031 15 18 14.1031 18 13V7ZM3.5 11H5.5C5.775 11 6 11.225 6 11.5C6 11.775 5.775 12 5.5 12H3.5C3.225 12 3 11.775 3 11.5C3 11.225 3.225 11 3.5 11ZM7 11.5C7 11.225 7.225 11 7.5 11H11.5C11.775 11 12 11.225 12 11.5C12 11.775 11.775 12 11.5 12H7.5C7.225 12 7 11.775 7 11.5Z"
                                                    fill="white" />
                                            </svg>
                                        </div>
                                        <h6 class="text-black font-weight-bolder mb-0 mt-3">
                                            {{ $subscription }}
                                        </h6>
                                        <span class="text-black text-sm">Paid Subs</span>
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
                                        <div class="icon icon-shape bg-black shadow border-radius-2xl d-flex justify-content-center align-items-center">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9 18C8.45 18 7.97933 17.8043 7.588 17.413C7.19667 17.0217 7.00067 16.5507 7 16V4C7 3.45 7.196 2.97933 7.588 2.588C7.98 2.19667 8.45067 2.00067 9 2H18C18.55 2 19.021 2.196 19.413 2.588C19.805 2.98 20.0007 3.45067 20 4V16C20 16.55 19.8043 17.021 19.413 17.413C19.0217 17.805 18.5507 18.0007 18 18H9ZM5 22C4.45 22 3.97933 21.8043 3.588 21.413C3.19667 21.0217 3.00067 20.5507 3 20V6H5V20H16V22H5Z"
                                                    fill="white" />
                                            </svg>

                                        </div>
                                        <h6 class="text-black font-weight-bolder mb-0 mt-3">
                                            {{ $content }}
                                        </h6>
                                        <span class="text-black text-sm">Total Content</span>
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
                                        <div class="icon icon-shape bg-black shadow border-radius-2xl d-flex justify-content-center align-items-center">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M19.4956 19.2985L2.50429 19.2995C2.34338 19.2995 2.18531 19.2571 2.04596 19.1766C1.90662 19.0962 1.7909 18.9805 1.71045 18.8411C1.63 18.7018 1.58765 18.5437 1.58765 18.3828C1.58765 18.2219 1.63 18.0638 1.71046 17.9245L10.2043 3.20829C10.2847 3.06895 10.4005 2.95325 10.5398 2.8728C10.6792 2.79235 10.8372 2.75 10.9981 2.75C11.159 2.75 11.3171 2.79235 11.4564 2.8728C11.5958 2.95325 11.7115 3.06895 11.792 3.20829L20.2895 17.9235C20.3699 18.0629 20.4123 18.221 20.4123 18.3819C20.4123 18.5428 20.3699 18.7008 20.2895 18.8402C20.209 18.9795 20.0933 19.0953 19.9539 19.1757C19.8146 19.2562 19.6565 19.2985 19.4956 19.2985ZM10.3106 8.74954L10.417 13.9434H11.583L11.6902 8.74954H10.3106ZM10.9981 16.6072C11.4381 16.6072 11.7819 16.269 11.7819 15.8445C11.7819 15.4201 11.4381 15.0874 10.9972 15.0874C10.8961 15.0849 10.7955 15.1027 10.7013 15.1396C10.6071 15.1765 10.5212 15.2318 10.4486 15.3024C10.3761 15.3729 10.3183 15.4571 10.2787 15.5502C10.2391 15.6433 10.2185 15.7434 10.218 15.8445C10.218 16.269 10.5618 16.6072 10.9972 16.6072H10.9981Z"
                                                    fill="white" />
                                            </svg>

                                        </div>
                                        <h6 class="text-black font-weight-bolder mb-0 mt-3">
                                            {{ $report }}
                                        </h6>
                                        <span class="text-black text-sm">Total Report</span>
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
            <div class="col-xxl-4 col-lg-6 col-12 mt-4 mt-lg-0">
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
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const reportChart = document.getElementById('reportChart');

            if (reportChart) {
                const ctx = reportChart.getContext('2d');
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
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            } else {
                console.error("Canvas 'reportChart' not found!");
            }

            const revenueChart = document.getElementById("revenueChart").getContext("2d");

            new Chart(revenueChart, {
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
                                callback: function(value) {
                                    return value / 1000 + "k";
                                }
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

            const newUsersChart = document.getElementById('newUsersChart').getContext('2d');

            new Chart(newUsersChart, {
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
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1000
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
