@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-1">
                    Welcome to Colocation Manager
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Here you can manage locations and their racks
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{route('dashboard')}}">App</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('colocation_manager.locations.index')}}">Colocation Manager</a>
                    </li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content ">
    <div class="row items-push py-4">

        @foreach($locations as $location)
        <!-- Course -->
        <div class="col-md-6 col-lg-4 col-xl-3">
            <a class="block block-rounded block-link-pop h-100 mb-0"
                href="{{route('colocation_manager.locations.show', $location)}}">

                <div class="block-content block-content-full">
                    <h4 class="h5 mb-1">
                        @if(isset($location->name))
                        {{$location->name}}
                        @else
                        Uncategorized
                        @endif
                    </h4>
                    <div class="fs-sm text">{{isset($location->racks) ? $location->racks->count() : $location }}
                        Racks added
                    </div>
                    <div class="fs-sm text-muted">{{isset($location->description) ? $location->description :
                        '' }}

                    </div>
                </div>

            </a>
        </div>

        @endforeach
        <!-- END Course -->

        {{ $locations->links() }}

        <div style="flex gap-2">
            <x-primary-link href="{{route('colocation_manager.locations.create')}}">Add Location +</x-primary-link>
            <x-primary-link href="{{route('colocation_manager.racks.create')}}">Add Rack +</x-primary-link>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection
