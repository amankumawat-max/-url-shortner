<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
    <head>
        <meta charset="utf-8" />
        <title>{{env('APP_NAME')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="@if(isset($site_settings->favicon) && $site_settings->favicon!=''){{config('app.setting_image')}}/{{$site_settings->favicon}}@else{{config('app.no_image')}}@endif" />

        <!-- Layout config Js -->
        <script src="{{asset('backend_assets/assets/js/layout.js')}}"></script>
        <!-- Bootstrap Css -->
        <link href="{{asset('backend_assets/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('backend_assets/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('backend_assets/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- custom Css-->
        <link href="{{asset('backend_assets/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{asset('backend_assets/assets/js/jquery.min.js')}}"></script>
    </head>

    <body>
        <div class="auth-page-wrapper pt-5">
            <!-- auth page bg -->
            <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
                <div class="bg-overlay"></div>

                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                    </svg>
                </div>
            </div>

            <!-- auth page content -->
            <div class="auth-page-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card mt-4">
                                <div class="card-body p-4">
                                    <div class="text-center mb-4">
                                        <div>
                                            <a href="{{url('/')}}" class="d-inline-block auth-logo">
                                                <img src="@if(isset($site_settings->logo) && $site_settings->logo!=''){{config('app.setting_image')}}{{$site_settings->logo}}@else{{config('app.no_image')}}@endif" alt="" height="55">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p class="text-muted">Sign in to continue to {{env('APP_NAME')}}.</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        @include('website.elements.message')
                                        <form action="{{route('loginprocess')}}" method="post" id="loginformSubmit">
                                        @csrf
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username<span class="text-danger">*</span></label>
                                                <input type="email" class="form-control required" name="admin_email" placeholder="Username" style="height:50px">
                                                @error('admin_email')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="password-input">Password<span class="text-danger">*</span></label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" name="admin_password" class="form-control required pe-5 password-input" style="height:50px" placeholder="Password" id="password-input" />
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" style="line-height:31px" type="button" id="password-addon">
                                                        <i class="ri-eye-fill align-middle"></i>
                                                    </button>
                                                    @error('admin_password')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message}}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-primary btn-lg w-100" style="height:50px" onclick="return submitLoginForm();" id="submitBtn" type="button"><span id="login">Log In</span><img src="{{env('APP_URL')}}/img/buttonLoder.gif" style="width: 80px; height: 15px;display:none;" id="loader" /></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end auth page content -->

            <!-- footer -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <p class="mb-0 text-muted">
                                    &copy;
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    {{env('APP_NAME')}} - All Right Reserved.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>
        <!-- end auth-page-wrapper -->
        <script type="text/javascript">
            $('#loader').hide();
            function submitLoginForm(obj){
                var counter = 0;
                var myElements = document.getElementsByClassName("required");
                for(var i = 0; i < myElements.length; i++){
                    if(myElements[i].value==''){
                        myElements[i].style.border = '1px solid red';
                    counter++;
                    }else{
                        myElements[i].style.border = '';
                    }
                }
                    if(counter==0){
                    document.getElementById('submitBtn').disabled = true;
                    $('#login').hide();
                    $('#loader').show();
                    setTimeout(function () {
                        $('#loginformSubmit').submit();
                    }, 1000);                    
                }
            }
        </script>
        <!-- JAVASCRIPT -->
        <script src="{{asset('backend_assets/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('backend_assets/assets/js/plugins.js')}}"></script>

        <!-- particles js -->
        <script src="{{asset('backend_assets/assets/libs/particles.js')}}/particles.js')}}"></script>
        <!-- particles app js -->
        <script src="{{asset('backend_assets/assets/js/pages/particles.app.js')}}"></script>
        <!-- password-addon init -->
        <script src="{{asset('backend_assets/assets/js/pages/password-addon.init.js')}}"></script>
    </body>
</html>
