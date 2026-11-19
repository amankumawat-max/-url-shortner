@extends('website.layouts.auth_master') @section('content')
<div class="page-content">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-6 col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Set Your Password</h4>
                    </div>
                    <div class="card-body">
                        @include('website.elements.message')
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('website.clients.accept.store', $token) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">New Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('login') }}" class="btn btn-secondary">Back to Login</a>
                                <button class="btn btn-primary float-end" type="submit">Set Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
