@extends('website.layouts.master') @section('content')
<div class="page-content">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-xl-6 col-lg-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Generate Short URL</h4>
                    </div>
                    <div class="card-body">
                        @include('website.elements.message')
                        <form action="{{route('website.urls.generate.store')}}" method="post" accept-charset="utf-8">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Long URL<span class="text-danger">*</span></label>
                                <input type="url" class="form-control" name="long_url" value="{{old('long_url')}}" placeholder="https://example.com/page" required>
                            </div>
                            <div class="mt-4">
                                <a href="{{route('website.urls.index')}}" class="btn btn-secondary">Back to URLs</a>
                                <button class="btn btn-primary float-end" type="submit">Generate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
