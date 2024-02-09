@extends('layouts.simple')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="bg-image " @if(file_exists(public_path('image/' . env('BACKGROUND_LOGIN'))) && env('BACKGROUND_LOGIN')
        !=null)
        style="background-image: url({{ asset('image/' . env('BACKGROUND_LOGIN')) }}); background-size: cover; background-position: center;"
        @endif>
        <div class="hero-static d-flex align-items-center bg-primary-dark-op">
            <div class="content">
                <div class="row justify-content-center push">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <!-- Unlock Block -->
                        <div class="block block-rounded shadow-none mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">SIGN IN</h3>
                                <div class="block-options">
                                    {{-- forget pass options --}}
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5 text-center">
                                    <img class="img-avatar img-avatar96" src={{asset('media/avatars/avatar10.jpg')}}
                                        alt="">
                                    <form class=" mt-4" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-4">
                                            <input type="email" class="form-control form-control-lg form-control-alt"
                                                id="email" name="email" value="{{old('email')}}" placeholder="Email..">
                                            @error('email')


                                            <x-error-message :message="$message" />
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <input type="password" class="form-control form-control-lg form-control-alt"
                                                id="password" name="password" placeholder="Password..">
                                            @error('password')
                                            <x-error-message :message="$message" />
                                            @enderror
                                        </div>
                                        <div class="row justify-content-center mb-4">
                                            <div class="col-md-6 col-xl-5">
                                                <button type="submit" class="btn w-100 btn-alt-success">
                                                    <i class="fa fa-fw fa-lock-open me-1 opacity-50"></i> Unlock
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END Unlock Form -->
                                </div>
                            </div>
                        </div>
                        <!-- END Unlock Block -->
                    </div>
                </div>
                <div class="fs-sm text-center text-white">
                    <span class="fw-medium">{{config('app.name', 'CloudDCM')}}</span> &copy; <span
                        data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>
@endsection