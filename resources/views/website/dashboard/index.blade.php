@extends('website.layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid mt-3">
        <div class="row g-3">
            <div class="col-xl-12">
                <div class="d-flex flex-column h-100">
                    <div class="row g-3">
                        {{-- <div class="col-xl-3 col-md-6">
                            <div class="card card-animate overflow-hidden mb-2">
                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                                    </svg>
                                </div>
                                <div class="card-body" style="z-index:1 ;">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total URLs</p>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-0">{{ $totalUrls }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div id="total_urls" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!--end col-->
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-animate overflow-hidden mb-2">
                                <div class="position-absolute start-0" style="z-index: 0;">
                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                        <style>
                                            .s0 {
                                                opacity: .05;
                                                fill: var(--vz-success)
                                            }
                                        </style>
                                        <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                                    </svg>
                                </div>
                                <div class="card-body" style="z-index:1 ;">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Users</p>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-0">{{ $totalUsers }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div id="total_users" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col --> --}}
                    </div><!--end row-->
                </div>
            </div><!--end col-->
            
        </div><!--end row-->
    </div>
    
</div>
@endsection
