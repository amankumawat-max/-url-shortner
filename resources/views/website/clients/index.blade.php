@extends('website.layouts.master') @section('content')
<div class="page-content">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Client List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align:left;width:30px;">S.No.</th>
                                        <th>Client Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th style="text-align: center;">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($userData)>0)
                                    @php $counter = $userData->firstItem(); @endphp
                                    @foreach($userData as $value)
                                    <tr>
                                        <td>{{$counter++}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->role}}</td>
                                        <td>{{$value->status}}</td>
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
                        @include('website.elements.pagination', ['pagination' => $userData])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
