@extends('layouts.simple')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="bg-image" style="background-image: url('{{asset('media/photos/photo28@2x.jpg')}}');">
        <div class="row g-0 bg-primary-dark-op">
            <!-- Meta Info Section -->
            <div class="hero-static col-lg-4 d-none d-lg-flex flex-column justify-content-center">
                <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                    <div class="w-100">
                        <a class="link-fx fw-semibold fs-2 text-white" href="index.html">
                            {{config('app.name', 'CloudDCM')}}
                        </a>
                        <p class="text-white-75 me-xl-8 mt-2">
                            The ultimate all-in-one Data Center Management / Service Management solution. Built by
                            hosting companies for hosting
                            companies.
                        </p>
                    </div>
                </div>
                <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                    <p class="fw-medium text-white-50 mb-0">
                        <strong>{{config('app.name', 'CloudDCM')}}</strong> &copy; <span data-toggle="year-copy"></span>
                    </p>

                </div>
            </div>
            <!-- END Meta Info Section -->

            <!-- Main Section -->
            <div class="hero-static col-lg-8 d-flex flex-column align-items-center bg-body-extra-light">
                <div class="p-3 w-100 d-lg-none text-center">
                    <a class="link-fx fw-semibold fs-3 text-dark" href="index.html">
                        OneUI
                    </a>
                </div>
                <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
                    <div class="w-100">
                        <!-- Header -->
                        <div class="text-center mb-5">
                            <p class="mb-3">
                                @if(file_exists(public_path('image/' . env('APP_LOGO'))) &&
                                env('APP_LOGO') !=null)
                                <img src="{{ asset('image/' . env('APP_LOGO')) }}" alt="" width="250">
                                @else
                                <i class="fa fa-2x fa-circle-notch text-primary-light"></i>
                                @endif
                            </p>
                            <h1 class="fw-bold mb-2">
                                Sign In
                            </h1>
                            <p class="fw-medium text-muted">
                                Welcome, please login to your account.
                            </p>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <div class="row g-0 justify-content-center">
                            <div class="col-sm-8 col-xl-4">
                                <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-lg form-control-alt py-3"
                                            id="email" name="email" placeholder="Email">

                                        @error('email')
                                        <x-error-message :message="$message" />
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <input type="password"
                                            class="form-control form-control-lg form-control-alt py-3" id="password"
                                            name="password" placeholder="Password">

                                        @error('password')
                                        <x-error-message :message="$message" />
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <a class="text-muted fs-sm fw-medium d-block d-lg-inline-block mb-1"
                                                href="{{route('password.store')}}">
                                                Forgot Password?
                                            </a>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-lg btn-alt-primary">
                                                <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Sign In
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END Sign In Form -->
                    </div>
                </div>
                <div
                    class="px-4 py-3 w-100 d-lg-none d-flex flex-column flex-sm-row justify-content-between fs-sm text-center text-sm-start">
                    <p class="fw-medium text-black-50 py-2 mb-0 w-100 text-center">
                        <strong>{{config('app.name', 'CloudDCM')}}</strong> &copy; <span data-toggle="year-copy"></span>
                    </p>

                </div>
            </div>
            <!-- END Main Section -->
        </div>
    </div>
    <!-- END Page Content -->
</main>
@endsection
