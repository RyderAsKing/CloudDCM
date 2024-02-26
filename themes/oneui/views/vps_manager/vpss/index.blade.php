@extends('layouts.backend')

@section('content')

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-1">
                    Welcome to VPS Manager
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Here you can manage locations/groups and their VPS
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{route('dashboard')}}">App</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{route('vps_manager.locations.index')}}">VPS Manager</a>
                    </li>
                    <li class=" breadcrumb-item" aria-current="page">
                        <span>VPS</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content js-appear-enabled animated fadeIn">
    <div class="row items-push py-4">

        @foreach($vpss as $vps)
        <!-- Course -->
        <div class="col-md-6 col-lg-4 col-xl-3">
            @if(isset($vps->hostname))
            <a class="block block-rounded block-link-pop h-100 mb-0 js-appear-enabled animated fadeIn"
                href="{{route('vps_manager.vpss.edit', $vps)}}">

                <div class="block-content block-content-full">
                    <h4 class="h5 mb-1">

                        {{$vps->hostname}}

                    </h4>
                    <div class="fs-sm text">{{isset($vps->cpu) ? $vps->cpu . ' CPU' : ' CPU not specified'}}
                    </div>
                    <div class="fs-sm text">{{isset($vps->memory) ? $vps->memory . ' memory' : ' Memory not specified'}}
                    </div>
                    <div class="fs-sm text">{{isset($vps->storage) ? $vps->storage . ' storage' : ' Storage not
                        specified'}}
                    </div>
                </div>

            </a>
            @endif
        </div>

        @endforeach
        <!-- END Course -->

        {{ $vpss->links() }}

        <div style="flex gap-2 ">
            <x-primary-link class="js-appear-enabled animated fadeIn" href="{{route('vps_manager.locations.create')}}">
                Add Location +</x-primary-link>
            <x-primary-link class="js-appear-enabled animated fadeIn" href="{{route('vps_manager.vpss.create')}}">Add
                VPS +</x-primary-link>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection
