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
                        <a class="link-fx" href="{{route('vps_manager.vpss.index')}}">VPS</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content js-appear-enabled animated fadeIn">

    <div class="block block-rounded">
        <div class="block block-rounded">
            <div class="block-header ">
                <h3 class="block-title">All vpss</h3>
                <div class="block-options">
                    <div class="dropdown">
                        <button type="button" class="btn-block-option" id="dropdown-ecom-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Add New <i class="fa fa-angle-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters">
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{route('vps_manager.locations.create')}}">
                                Location
                                <span class="badge bg-black-50 rounded-pill">+</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{route('vps_manager.vpss.create')}}">
                                VPS
                                <span class="badge bg-black-50 rounded-pill">+</span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content">
                {{--
                <!-- Search Form -->
                <form action="be_pages_ecom_orders.html" method="POST" onsubmit="return false;">
                    <div class="mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search"
                                name="one-ecom-orders-search" placeholder="Search all orders..">
                            <span class="input-group-text bg-body border-0">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form> --}}
                <!-- END Search Form -->

                <!-- All Orders Table -->
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="" style="width: 250px;">Hostname</th>
                                <th class="d-none d-sm-table-cell ">IP Address</th>
                                <th>Username</th>
                                <th class="d-none d-xl-table-cell">Password</th>
                                <th class="d-none d-xl-table-cell ">Location</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vpss as $vps)
                            <tr>
                                <td class=" fs-sm">
                                    <a class="fw-semibold" href="{{route('vps_manager.vpss.edit', $vps)}}">
                                        <strong>{{$vps->hostname}}</strong>
                                    </a>
                                </td>
                                <td class="d-none d-sm-table-cell  fs-sm">{{$vps->ip_address}}</td>
                                <td>
                                    <code>{{$vps->username}}</code>
                                </td>
                                <td class="d-none d-sm-table-cell  fs-sm"><code>{{$vps->password}}</code></td>
                                <td class="d-none d-xl-table-cell  fs-sm">
                                    <a class="fw-semibold"
                                        href="{{ $vps->location != null ? route('vps_manager.locations.show', $vps->location) : route('vps_manager.vpss.index')}}">{{$vps->location
                                        !=
                                        null ?
                                        $vps->location->name : 'Uncategorized'}}</a>
                                </td>

                                <td class="">
                                    <a class="btn btn-sm btn-alt-secondary"
                                        href="{{route('vps_manager.vpss.edit', $vps->id)}}" data-bs-toggle="tooltip"
                                        title="View">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                            @if($vpss->count() == 0)
                            <tr>
                                <td colspan="6" class="text-center ">
                                    <p class="m-0">No vpss added yet</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- END All Orders Table -->

                <!-- Pagination -->
                {{-- <nav aria-label="Photos Search Navigation">
                    <ul class="pagination pagination-sm justify-content-end mt-2">
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-label="Previous">
                                Prev
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0)">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" aria-label="Next">
                                Next
                            </a>
                        </li>
                    </ul>
                </nav> --}}

                {{ $vpss->links() }}
                <!-- END Pagination -->
            </div>
        </div>


    </div>
</div>
<!-- END Page Content -->
@endsection
