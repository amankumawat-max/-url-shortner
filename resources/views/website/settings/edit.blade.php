@extends('website.layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Settings</h4>
                    </div>
                    <div class="card-body">
                        @include('website.elements.message')
                        <form action="{{route('website.settings.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Project Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="site_title" value="{{old('site_title', optional($siteSettings)->site_title ?? '')}}" placeholder="Enter project name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Admin Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="admin_email" value="{{old('admin_email', optional($siteSettings)->admin_email ?? '')}}" placeholder="Enter admin email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Admin Mobile<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="admin_mobile" value="{{old('admin_mobile', optional($siteSettings)->admin_mobile ?? '')}}" placeholder="Enter admin mobile" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Admin Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="admin_name" value="{{old('admin_name', optional($siteSettings)->admin_name ?? '')}}" placeholder="Enter admin name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Favicon</label>
                                <input type="file" class="form-control" name="favicon" accept="image/*">
                                @if(optional($siteSettings)->favicon)
                                    <img src="{{env('SETTING_IMAGE')}}/{{$siteSettings->favicon}}" alt="Favicon" height="40" class="mt-2">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Logo</label>
                                <input type="file" class="form-control" name="logo" accept="image/*">
                                @if(optional($siteSettings)->logo)
                                    <img src="{{env('SETTING_IMAGE')}}{{$siteSettings->logo}}" alt="Logo" height="55" class="mt-2">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">White Logo</label>
                                <input type="file" class="form-control" name="white_logo" accept="image/*">
                                @if(optional($siteSettings)->white_logo)
                                    <img src="{{env('SETTING_IMAGE')}}{{$siteSettings->white_logo}}" alt="White Logo" height="40" class="mt-2">
                                @endif
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary btn-lg w-100" style="height:50px" type="submit">Save Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
