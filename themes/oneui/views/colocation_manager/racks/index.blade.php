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
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{route('colocation_manager.locations.index')}}">Colocation Manager</a>
                    </li>
                    <li class=" breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('colocation_manager.racks.index')}}">Racks</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content ">
    <div class="row">
        <div class="col-6 ">
            <a class="block block-rounded block-link-shadow text-center" href="be_pages_ecom_orders.html">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-primary">{{$racks->count()}}</div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="fw-medium fs-sm text-muted mb-0">
                        Racks
                    </p>
                </div>
            </a>
        </div>
        <div class="col-6 ">
            <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-dark">{{$rackSpaces}}</div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="fw-medium fs-sm text-muted mb-0">
                        Rack Spaces
                    </p>
                </div>
            </a>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block block-rounded">
            <div class="block-header ">
                <h3 class="block-title">All racks</h3>
                <div class="block-options">
                    <div class="dropdown">
                        <button type="button" class="btn-block-option" id="dropdown-ecom-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Add New <i class="fa fa-angle-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters">
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{route('colocation_manager.locations.create')}}">
                                Location
                                <span class="badge bg-black-50 rounded-pill">+</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{route('colocation_manager.racks.create')}}">
                                Rack
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
                                <th class="" style="width: 250px;">Name</th>
                                <th class="d-none d-sm-table-cell ">Description</th>
                                <th>Usage</th>
                                <th class="d-none d-xl-table-cell">Size</th>
                                <th class="d-none d-xl-table-cell ">Location</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($racks as $rack)
                            <tr>
                                <td class=" fs-sm">
                                    <a class="fw-semibold" href="be_pages_ecom_order.html">
                                        <strong>{{$rack->name}}</strong>
                                    </a>
                                </td>
                                <td class="d-none d-sm-table-cell  fs-sm">{{$rack->description}}</td>
                                <td>
                                    <span class="badge bg-info">{{ round(count($rack->rackSpaces) /
                                        $rack->rack_spaces_count *
                                        100) }}%
                                        Used</span>
                                </td>
                                <td class="d-none d-sm-table-cell  fs-sm">{{$rack->rack_spaces_count}}</td>
                                <td class="d-none d-xl-table-cell  fs-sm">
                                    <a class="fw-semibold" href="be_pages_ecom_order.html">{{$rack->location != null ?
                                        $rack->location->name : 'Uncategorized'}}</a>
                                </td>

                                <td class="">
                                    <a class="btn btn-sm btn-alt-secondary"
                                        href="{{route('colocation_manager.racks.show', $rack->id)}}"
                                        data-bs-toggle="tooltip" title="View">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                            @if($racks->count() == 0)
                            <tr>
                                <td colspan="6" class="text-center ">
                                    <p class="m-0">No racks added yet</p>
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

                {{ $racks->links() }}
                <!-- END Pagination -->
            </div>
        </div>


    </div>
</div>
<!-- END Page Content -->
@endsection
