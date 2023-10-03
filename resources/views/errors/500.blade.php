@extends('errors.error')

@section('title')
    server error
@endsection

@section('content')
    <style>
        body {
            background-image: url("{{ asset('/') }}assets/media/auth/bg7.jpg");
        }

        [data-bs-theme="dark"] body {
            background-image: url("{{ asset('/') }}assets/media/auth/bg7-dark.jpg");
        }
    </style>

    <div class="d-flex flex-column flex-center flex-column-fluid">
        <div class="d-flex flex-column flex-center text-center px-10">
            <div class="card card-flush w-lg-650px py-5">
                <div class="card-body py-10 py-lg-15">
                    <h1 class="fw-bolder fs-2qx text-gray-900 mb-4">
                        System Error
                    </h1>
                    <div class="fw-semibold fs-6 text-gray-500 mb-7">
                        Something went wrong! Please try again later.
                    </div>
                    <div class="mb-10">
                        <img src="{{ asset('/') }}assets/media/auth/500-error.png" class="mw-100 mh-300px theme-light-show" alt=""/>
                        <img src="{{ asset('/') }}assets/media/auth/500-error-dark.png" class="mw-100 mh-300px theme-dark-show" alt=""/>
                    </div>
                    <div class="mb-0">
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Return Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
