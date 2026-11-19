<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="dark">
    <head>
        <meta charset="utf-8" />
        <title>@if (isset($title) && $title !== '') {{ $title }} @else{{ env('APP_NAME') }} @endif - Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="@if(isset($site_settings->favicon) && $site_settings->favicon!=''){{config('app.setting_image')}}{{$site_settings->favicon}}@else{{config('app.no_image')}}@endif" />
        <link href="{{asset('backend_assets/assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{asset('backend_assets/assets/js/layout.js')}}"></script>
        <link href="{{asset('backend_assets/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend_assets/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend_assets/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend_assets/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{asset('backend_assets/assets/js/jquery.min.js')}}"></script>
        <script>
            var site_url = "{{env('APP_URL')}}";
            var _token = "{{ csrf_token() }}";
        </script>
    </head>
    <body>
        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="layout-width">
                    <div class="navbar-header">
                        <div class="d-flex">
                            <!-- LOGO -->
                            <div class="navbar-brand-box horizontal-logo">
                                <a href="{{url('/')}}" class="logo logo-dark">
                                    <span class="logo-sm">
                                        <img src="@if(isset($site_settings->logo) && $site_settings->logo!=''){{config('app.setting_image')}}{{$site_settings->logo}}@elseif(isset($site_settings->white_logo) && $site_settings->white_logo!=''){{config('app.setting_image')}}{{$site_settings->white_logo}}@else{{config('app.no_image')}}@endif" alt="" height="40" />
                                    </span>
                                    <span class="logo-lg">
                                        <img src="@if(isset($site_settings->logo) && $site_settings->logo!=''){{config('app.setting_image')}}{{$site_settings->logo}}@elseif(isset($site_settings->white_logo) && $site_settings->white_logo!=''){{config('app.setting_image')}}{{$site_settings->white_logo}}@else{{config('app.no_image')}}@endif" alt="" height="40" />
                                    </span>
                                </a>

                                <a href="{{url('/')}}" class="logo logo-light">
                                    <span class="logo-sm">
                                        <img src="@if(isset($site_settings->logo) && $site_settings->logo!=''){{config('app.setting_image')}}{{$site_settings->logo}}@elseif(isset($site_settings->white_logo) && $site_settings->white_logo!=''){{config('app.setting_image')}}{{$site_settings->white_logo}}@else{{config('app.no_image')}}@endif" alt="" height="40" />
                                    </span>
                                    <span class="logo-lg">
                                        <img src="@if(isset($site_settings->logo) && $site_settings->logo!=''){{config('app.setting_image')}}{{$site_settings->logo}}@elseif(isset($site_settings->white_logo) && $site_settings->white_logo!=''){{config('app.setting_image')}}{{$site_settings->white_logo}}@else{{config('app.no_image')}}@endif" alt="" height="40" />
                                    </span>
                                </a>
                            </div>

                            <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                                <span class="hamburger-icon">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </button>
                            <form class="app-search d-none d-md-block">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" value="" />
                                    <span class="mdi mdi-magnify search-widget-icon"></span>
                                    <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                                    <div data-simplebar style="max-height: 320px;">
                                        <!-- item-->
                                        <div class="dropdown-header">
                                            <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                                        </div>

                                        <div class="dropdown-item bg-transparent text-wrap">
                                            <a href="index.html" class="btn btn-soft-secondary btn-sm rounded-pill">how to setup <i class="mdi mdi-magnify ms-1"></i></a>
                                            <a href="index.html" class="btn btn-soft-secondary btn-sm rounded-pill">buttons <i class="mdi mdi-magnify ms-1"></i></a>
                                        </div>
                                        <!-- item-->
                                        <div class="dropdown-header mt-2">
                                            <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                                        </div>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                            <span>Analytics Dashboard</span>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                            <span>Help Center</span>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                            <span>My account settings</span>
                                        </a>

                                        <!-- item-->
                                        <div class="dropdown-header mt-2">
                                            <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                                        </div>

                                        <div class="notification-list">
                                            <!-- item -->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                                <div class="d-flex">
                                                    <img src="{{asset('backend_assets/assets/images/users/avatar-2.jpg')}}" class="me-3 rounded-circle avatar-xs" alt="user-pic" />
                                                    <div class="flex-grow-1">
                                                        <h6 class="m-0">Angela Bernier</h6>
                                                        <span class="fs-11 mb-0 text-muted">Manager</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- item -->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                                <div class="d-flex">
                                                    <img src="{{asset('backend_assets/assets/images/users/avatar-3.jpg')}}" class="me-3 rounded-circle avatar-xs" alt="user-pic" />
                                                    <div class="flex-grow-1">
                                                        <h6 class="m-0">David Grasso</h6>
                                                        <span class="fs-11 mb-0 text-muted">Web Designer</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- item -->
                                            <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                                <div class="d-flex">
                                                    <img src="{{asset('backend_assets/assets/images/users/avatar-5.jpg')}}" class="me-3 rounded-circle avatar-xs" alt="user-pic" />
                                                    <div class="flex-grow-1">
                                                        <h6 class="m-0">Mike Bunch</h6>
                                                        <span class="fs-11 mb-0 text-muted">React Developer</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="text-center pt-3 pb-1">
                                            <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i class="ri-arrow-right-line ms-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="dropdown d-md-none topbar-head-dropdown header-item">
                                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-search fs-22"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                                    <form class="p-3">
                                        <div class="form-group m-0">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username" />
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="ms-1 header-item d-none d-sm-flex">
                                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                                    <i class="bx bx-fullscreen fs-22"></i>
                                </button>
                            </div>

                            <div class="ms-1 header-item d-none d-sm-flex">
                                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                    <i class="bx bx-moon fs-22"></i>
                                </button>
                            </div>

                            @include('website.elements.notifications')

                            <div class="dropdown ms-sm-3 header-item topbar-user">
                                <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="d-flex align-items-center">
                                        <img
                                            class="rounded-circle header-profile-user"
                                            src="@if(isset($site_settings->favicon) && $site_settings->favicon!=''){{config('app.setting_image')}}{{$site_settings->favicon}}@else{{config('app.no_image')}}@endif"
                                            alt="Header Avatar"
                                        />
                                        <span class="text-start ms-xl-2">
                                            <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">@if(isset($name) && $name != ''){{ $name }}@endif</span>
                                            <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">@if(isset($user_type_label) && $user_type_label == 'super_admin'){{ 'Super Admin' }}@elseif(isset($user_type_label) && $user_type_label == 'admin'){{ 'Admin' }}@else{{'Member'}}@endif</span>
                                        </span>
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <h6 class="dropdown-header">Welcome @if(isset($name) && $name != ''){{ $name }}@endif!</h6>
                                    <a class="dropdown-item" href="{{route('website.logout')}}"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mt-2 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width: 100px; height: 100px;"></lord-icon>
                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                    <h4>Are you sure ?</h4>
                                    <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            @include('website.elements.main_menu')

            <!-- Left Sidebar End -->
            <!-- Vertical Overlay-->
            <div class="vertical-overlay"></div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- end main content-->
        </div>
        <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <script>
        $(document).ready(function() {
            $("#select-all").change(function() {
                $(".singlecheckbox").prop('checked', $(this).prop('checked'));
            });
        });
        function checkcondition(obj) {
            var isChecked = $(".singlecheckbox").is(":checked");
            var isCheckedall = $("#select-all").is(":checked");
            var getstatus = $('.getstatus').val();
            if (isChecked == false && isCheckedall == false) {
                alert('Please select atleast one row to proceed');
                return false;
            }
            if (getstatus == 0) {
                alert('Select atleast one bulk action');
                return false;
            }
            var result = confirm("Are you sure you want to proceed?");
            if (result) {
                return true;
            } else {
                return false;
            }
        }
        </script>
        <!-- JAVASCRIPT -->
        <script src="{{asset('backend_assets/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('backend_assets/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('backend_assets/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('backend_assets/assets/libs/feather-icons/feather.min.js')}}"></script>
        <script src="{{asset('backend_assets/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
        <script src="{{asset('backend_assets/assets/js/plugins.js')}}"></script>

        <!-- apexcharts -->
        <script src="{{asset('backend_assets/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- Vector map-->
        <script src="{{asset('backend_assets/assets/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
        <script src="{{asset('backend_assets/assets/libs/jsvectormap/maps/world-merc.js')}}"></script>

        <!-- Dashboard init -->
        <script src="{{asset('backend_assets/assets/js/pages/dashboard-analytics.init.js')}}"></script>
        <!-- prismjs plugin -->
        <script src="{{asset('backend_assets/assets/libs/prismjs/prism.js')}}"></script>
        <!-- App js -->
        <script src="{{asset('backend_assets/assets/js/app.js')}}"></script>
    </body>
</html>
