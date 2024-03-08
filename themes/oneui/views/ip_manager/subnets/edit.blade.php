@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-1">
                    Welcome to Subnet Manager (IP Manager)
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    You are currently editing a subnet {{$subnet->name}} <strong>{{$subnet->subnet}}</strong>
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{route('dashboard')}}">App</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('ip_manager.subnets.index')}}">Subnet Manager</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <span>Subnet</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content ">
    {{-- subnet editing --}}
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit subnet</h3>
        </div>
        <div class="block-content block-content-full">
            <form action="{{route('ip_manager.subnets.update', $subnet)}}" method="POST">
                @method('PATCH')
                @csrf
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            View/Update information about the subnet.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="mb-4">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{$subnet->name ?? ''}}" placeholder="Text Input">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="subnet">Subnet</label>
                            <input type="text" class="form-control" id="subnet" name="subnet"
                                value="{{$subnet->subnet}}" placeholder="Emai Input">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="vlan">VLAN</label>
                            <input type="text" class="form-control" id="vlan" value="{{$subnet->vlan}}" name="vlan"
                                placeholder="Password Input">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="leased_company">Leased Company</label>
                            <input type="text" class="form-control" id="leased_company"
                                value="{{$subnet->leased_company}}" name="leased_company" placeholder="Password Input">
                        </div>

                        <label class="form-label" for="parent_id">Parent subnet</label>
                        <div class="row items-push">
                            <div class="col-md-4 ">
                                <div class=" form-check form-block">
                                    <input type="radio" class="form-check-input" id="parent_id" name="parent_id"
                                        value=" ">
                                    <label class="form-check-label" for="parent_id"
                                        style="height: 150px; display: flex; align-items:center; justify-content: center;">
                                        <span class="d-block fw-normal text-center ">
                                            <span class="fs-4 fw-semibold">None</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            @foreach ($subnets as $parent_subnet)
                            <div class="col-md-4 ">
                                <div class="form-check form-block">
                                    <input type="radio" class="form-check-input" id="{{$parent_subnet->name}}"
                                        name="parent_id" value="{{$parent_subnet->id}}" @if($subnet->parent_id ==
                                    $parent_subnet->id)
                                    checked="checked" @endif>
                                    <label class="form-check-label" for="{{$parent_subnet->name}}"
                                        style="height: 150px; display: flex; align-items:center; justify-content: center;">
                                        <span class="d-block fw-normal text-center ">
                                            <span class="fs-7 fw-semibold">{{$parent_subnet->name}} |
                                                {{$parent_subnet->subnet}}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            @endforeach

                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    {{-- range creation --}}
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Range (IPs)</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-lg-4">
                    <p class="fs-sm text-muted">
                        Using an inline layout can come really handy for small forms
                    </p>
                </div>
                <div class="col-lg-8 space-y-2">
                    <!-- Form Inline - Default Style -->
                    <form class="row row-cols-lg-auto g-3 align-items-center"
                        action="{{route('ip_manager.subnets.range', $subnet)}}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label class="visually-hidden" for="start">Start</label>
                            <input type="text" class="form-control" id="start" name="start"
                                placeholder="Start eg. 10.0.0.1">
                        </div>
                        <div class="col-12">
                            <label class="visually-hidden" for="end">End</label>
                            <input type="text" class="form-control" id="end" name="end"
                                placeholder="End eg. 10.0.0.127">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Add </button>
                        </div>
                    </form>
                    <!-- END Form Inline - Default Style -->
                </div>
            </div>
        </div>
    </div>

    {{-- ips list --}}
    <div class="block block-rounded">
        <div class="block block-rounded">
            <div class="block-header ">
                <h3 class="block-title">All ips</h3>
                <div class="block-options">
                    <div class="dropdown">
                        <button type="button" class="btn-block-option" id="dropdown-ecom-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Add New <i class="fa fa-angle-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters">
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{route('ip_manager.ips.create')}}">
                                IPv4
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
                                <th>IP</th>
                                <th class="d-none d-sm-table-cell ">Status</th>
                                <th>Block</th>
                                <th style="width: 50px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ips as $ip)
                            <tr>
                                <td class=" fs-sm">
                                    <a class="fw-semibold" href="{{route('ip_manager.ips.edit', $ip)}}">
                                        <strong>{{$ip->ip}}</strong>
                                    </a>
                                </td>
                                <td class="d-sm-table-cell">
                                    <span class="badge bg-info">{{ $ip->status }}</span>
                                </td>
                                <td class="d-none d-sm-table-cell  fs-sm">{{ $subnet->name }}</td>
                                <td class="d-sm-table-cell">
                                    <a class="btn btn-sm btn-alt-secondary"
                                        href="{{route('ip_manager.ips.show', $ip->id)}}" data-bs-toggle="tooltip"
                                        title="View">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                            @if($ips->count() == 0)
                            <tr>
                                <td colspan="6" class="text-center ">
                                    <p class="m-0">No ips added yet</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- END All Orders Table -->


                {{ $ips->links() }}
                <!-- END Pagination -->
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection
