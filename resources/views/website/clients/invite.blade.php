@extends('website.layouts.master') @section('content')
<div class="page-content">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-6 col-lg-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Invite Client</h4>
                    </div>
                    <div class="card-body">
                        @include('website.elements.message')
                        <form action="{{route('website.clients.invite.store')}}" method="post" accept-charset="utf-8">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Client Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="client_name" value="{{old('client_name')}}" placeholder="Enter client name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Client Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="client_email" value="{{old('client_email')}}" placeholder="Enter client email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role<span class="text-danger">*</span></label>
                                <select class="form-control" name="role">
                                    <option value="admin" {{ (old('role') == 'admin') ? 'selected' : '' }}>Admin</option>
                                    <option value="member" {{ (old('role') == 'member') ? 'selected' : '' }}>Member</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <a href="{{route('website.clients.index')}}" class="btn btn-secondary">Back to Clients</a>
                                <button class="btn btn-primary float-end" type="submit">Send Invitation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
