@extends('website.layouts.master') @section('content')
<div class="page-content">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                @include('website.elements.message')
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">URL List</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('website.urls.index')}}" method="post" accept-charset="utf-8">
                            @csrf
                            <div class="row align-items-center justify-content-end">
                                <div class="col-lg-3">
                                    <label class="form-label">Period</label>
                                    <select class="form-control" name="period">
                                        <option value="">Select</option>
                                        <option value="today" {{ (!empty($aryFilterSession) && $aryFilterSession['period'] == 'today') ? 'selected' : '' }}>Today</option>
                                        <option value="last_week" {{ (!empty($aryFilterSession) && $aryFilterSession['period'] == 'last_week') ? 'selected' : '' }}>Last Week</option>
                                        <option value="last_month" {{ (!empty($aryFilterSession) && $aryFilterSession['period'] == 'last_month') ? 'selected' : '' }}>Last Month</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 ps-0">
                                    <label class="form-label">&nbsp;</label>
                                    <button class="btn btn-primary w-100" type="submit">Filter</button>
                                </div>
                                @if(!empty($aryFilterSession))
                                <div class="col-lg-1 ps-0">
                                    <label class="form-label">&nbsp;</label>
                                    <a class="btn btn-danger w-100" href="{{route('website.urls.urllistfilterreset')}}">Reset</a>
                                </div>
                                @endif
                                <div class="col-lg-1 ps-0">
                                    <label class="form-label">&nbsp;</label>
                                    <a class="btn btn-info w-100" href="{{route('website.urls.urllistexport')}}">
                                        <i class="ri-file-excel-2-line"></i> Export
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align:left;width:30px;">S.No.</th>
                                        <th>Short URL</th>
                                        <th>Long URL</th>
                                        <th>User</th>
                                        <th style="text-align: center;">Total Hits</th>
                                        <th style="text-align: center;">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($urlData)>0)
                                    @php $counter = $urlData->firstItem(); @endphp
                                    @foreach($urlData as $value)
                                    <tr>
                                        <td>{{$counter++}}</td>
                                        <td><a href="{{route('website.urls.redirect', $value->short_code)}}" target="_blank">{{route('website.urls.redirect', $value->short_code)}}</a></td>
                                        <td>{{$value->long_url}}</td>
                                        <td>{{$value->user->name ?? '-'}}</td>
                                        <td style="text-align: center;">{{$value->url_hits_count}}</td>
                                        <td style="text-align: center;">{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                    </tr> 
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6" class="text-center">No Data Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        @include('website.elements.pagination', ['pagination' => $urlData])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
