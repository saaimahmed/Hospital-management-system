@extends('errors.error')

@section('title')
    token missing
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
        <div class="d-flex flex-column flex-center text-center p-10">
            <div class="card card-flush w-lg-650px py-5">
                <div class="card-body py-15 py-lg-20">
                    <h1 class="fw-bolder fs-2qx text-gray-900 mb-4">
                        419 Error
                    </h1>
                    <div class="fw-semibold fs-6 text-gray-500 mb-7">
                        CSRF token missing.
                    </div>
                    <div class="mb-0">
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Return Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
