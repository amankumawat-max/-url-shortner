<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="dark">
    <head>
        <meta charset="utf-8" />
        <title>@if (isset($title) && $title !== '') {{ $title }} @else{{ env('APP_NAME') }} @endif</title>
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
        <div id="layout-wrapper">
            <div class="main-content">
                @yield('content')
            </div>
        </div>
        <script src="{{asset('backend_assets/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    </body>
</html>
