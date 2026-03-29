<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'SCC APP')</title>

    <link rel="icon" type="image/x-icon" href="/assets/src/assets/img/favicon.ico"/>
    <link href="/assets/layouts/modern-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="/assets/layouts/modern-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="/assets/layouts/modern-light-menu/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="/assets/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/layouts/modern-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/assets/layouts/modern-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="/assets/src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/assets/src/assets/css/light/components/list-group.css" rel="stylesheet" type="text/css">
    <link href="/assets/src/assets/css/light/dashboard/dash_2.css" rel="stylesheet" type="text/css" />

    <link href="/assets/src/assets/css/dark/components/list-group.css" rel="stylesheet" type="text/css">
    <link href="/assets/src/assets/css/dark/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        .wrap-text {
            white-space: normal;
            word-break: break-word;
        }
    </style>

    @yield('styles')
    @vite(['resources/js/app.js'])
</head>
<body class=" layout-boxed">

    <!-- PAGE CONTENT -->
    <div class="p-0">
        
    </div>

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">

            <a href="javascript:void(0);" class="sidebarCollapse">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </a>

            <ul class="navbar-item flex-row ms-lg-auto ms-0">

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-container">
                            <div class="avatar avatar-sm avatar-indicators avatar-online">
                                <img alt="avatar" src="/assets/src/assets/img/profile_male.png" class="rounded-circle">
                            </div>
                        </div>
                    </a>

                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <div class="emoji me-2">
                                    &#x1F44B;
                                </div>
                                <div class="media-body">
                                    <h5>{{ Str::limit(session('auth.user.name'), 20) }}</h5>
                                    <p>
                                        @if (session('auth.user.role') == 'super_admin') Super Admin
                                        @elseif (session('auth.user.role') == 'admin') Admin
                                        @else ...
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="dropdown-item">
                            <a href="#" id="logout-link" class="pages">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span>Log Out</span>
                            </a>

                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">

                <div class="navbar-nav theme-brand flex-row  text-center">
                    <div class="nav-logo">
                        <div class="nav-item theme-logo">
                            <a href="./index.html">
                                <img src="/assets/src/assets/img/logo.svg" class="navbar-logo" alt="logo">
                            </a>
                        </div>
                        <div class="nav-item theme-text">
                            <a href="./index.html" class="nav-link"> SCC APP </a>
                        </div>
                    </div>
                    <div class="nav-item sidebar-toggle">
                        <div class="btn-toggle sidebarCollapse">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
                        </div>
                    </div>
                </div>
                <div class="profile-info">
                    <div class="user-info">
                        <div class="profile-img">
                            <img src="/assets/src/assets/img/profile_male.png" alt="avatar">
                        </div>
                        <div class="profile-content">
                            <h6 class="">{{ Str::limit(session('auth.user.name'), 20) }}</h6>
                            <p class="">
                                @if (session('auth.user.role') == 'super_admin') Super Admin
                                @elseif (session('auth.user.role') == 'admin') Admin
                                @else ...
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                                
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.index') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                    class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>APPLICATIONS</span></div>
                    </li>

                    <li class="menu @if (request()->routeIs('admins.*')) active @endif"
                        @if (session('auth.user.role') !== 'super_admin') style="opacity: 0.5;" @endif>
                        <a href="#manage-admin" data-bs-toggle="collapse"
                            @if (request()->routeIs('admins.*')) aria-expanded="true" @endif class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                    stroke-linejoin="round" class="feather feather-shield">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                                <span>Kelola Admin</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled @if (request()->routeIs('admins.*')) show @endif" 
                            id="manage-admin" data-bs-parent="#accordionExample">
                            <li class="@if (request()->routeIs('admins.create')) active @endif">
                                <a href="{{ route('admins.create') }}"> Tambah Admin </a>
                            </li> 
                            <li class="@if (request()->routeIs('admins.index')) active @endif">
                                <a href="{{ route('admins.index') }}"> Daftar Admin </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu @if (request()->routeIs('users.*')) active @endif">
                        <a href="#users" data-bs-toggle="collapse"
                            @if (request()->routeIs('users.*')) aria-expanded="true" @endif class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span>Pengguna</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled @if (request()->routeIs('users.*')) show @endif" 
                            id="users" data-bs-parent="#accordionExample">
                            <li class="@if (request()->routeIs('users.create')) active @endif">
                                <a href="{{ route('users.create') }}"> Input Pengguna </a>
                            </li> 
                            <li class="@if (request()->routeIs('users.index')) active @endif">
                                <a href="{{ route('users.index') }}"> Daftar Pengguna </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu @if (request()->routeIs('tracer-study.*')) active @endif"
                        @if (session('auth.user.role') !== 'super_admin') style="opacity: 0.5;" @endif>
                        <a href="{{ route('tracer-study.index') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-activity">
                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                </svg>
                                <span>Tracer Study</span>
                            </div>
                        </a>
                    </li>
                    
                    <li class="menu @if (request()->routeIs('jobvacancy.*') || request()->routeIs('apprenticeship.*')) active @endif"
                        @if (session('auth.user.role') !== 'admin') style="opacity: 0.5;" @endif>
                        <a href="#career-info" data-bs-toggle="collapse"
                            @if (request()->routeIs('jobvacancy.*') || request()->routeIs('apprenticeship.*')) aria-expanded="true" @endif class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-briefcase">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"></path>
                                </svg>
                                <span>Info Karir</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled @if (request()->routeIs('jobvacancy.*') || request()->routeIs('apprenticeship.*')) show @endif" 
                            id="career-info" data-bs-parent="#accordionExample">
                            <li class="@if (request()->routeIs('jobvacancy.*')) active @endif">
                                <a href="{{ route('jobvacancy.index') }}"> Lowongan Kerja </a>
                            </li> 
                            <li class="@if (request()->routeIs('apprenticeship.*')) active @endif">
                                <a href="{{ route('apprenticeship.index') }}"> Magang </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu @if (request()->routeIs('campus-info.*')) active @endif">
                        <a href="#campus-info" data-bs-toggle="collapse"
                            @if (request()->routeIs('campus-info.*')) aria-expanded="true" @endif class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-book-open">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                                <span>Info Kampus</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled @if (request()->routeIs('campus-info.*')) show @endif" 
                            id="campus-info" data-bs-parent="#accordionExample">
                            <li class="@if (request()->routeIs('campus-info.create')) active @endif">
                                <a href="{{ route('campus-info.create') }}"> Tambah Info </a>
                            </li> 
                            <li class="@if (request()->routeIs('campus-info.index')) active @endif">
                                <a href="{{ route('campus-info.index') }}"> Daftar Info </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="menu @if (request()->routeIs('master.*')) active @endif"
                        @if (session('auth.user.role') !== 'super_admin') style="opacity: 0.5;" @endif>
                        <a href="#master" data-bs-toggle="collapse"
                            @if (request()->routeIs('master.*')) aria-expanded="true" @endif class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-book-open">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                </svg>
                                <span>Data Master</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled @if (request()->routeIs('master.*')) show @endif" 
                            id="master" data-bs-parent="#accordionExample">
                            <li class="@if (request()->routeIs('master.faculties.index')) active @endif">
                                <a href="{{ route('master.faculties.index') }}"> Fakultas </a>
                            </li> 
                            <li class="@if (request()->routeIs('master.study-programs.index')) active @endif">
                                <a href="{{ route('master.study-programs.index') }}"> Program Studi </a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
                
            </nav>

        </div>
        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    @yield('content')

                </div>

            </div>
            <!--  BEGIN FOOTER  -->
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <span class="dynamic-year">2022</span> <a target="_blank" href="https://designreset.com/cork-admin/">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
            <!--  END CONTENT AREA  -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/assets/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/src/plugins/src/mousetrap/mousetrap.min.js"></script>
    <script src="/assets/src/plugins/src/waves/waves.min.js"></script>
    <script src="/assets/layouts/modern-light-menu/app.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="/assets/src/plugins/src/apex/apexcharts.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    
    <script>
        // Link Logout 
        document.getElementById('logout-link').addEventListener('click', function(e) {
            e.preventDefault();
            
            const confirmLogout = confirm('Apakah kamu yakin ingin keluar dari akun ini?');
            if (confirmLogout) {
                document.getElementById('logout-form').submit();
            }
        });
    </script>

    @yield('scripts')
    @include('sweetalert::alert')
</body>
</html>
