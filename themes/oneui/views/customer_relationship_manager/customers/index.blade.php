@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-1">
                    Welcome to Customer Relationship Manager (CRM)
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Here you can manage your customers
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{route('dashboard')}}">App</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <span>CRM</span>
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
                <h3 class="block-title">All customers</h3>
                <div class="block-options">
                    <div class="dropdown">
                        <button type="button" class="btn-block-option" id="dropdown-ecom-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Add New <i class="fa fa-angle-down ms-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters">
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{route('customer_relationship_manager.customers.create')}}">
                                Customer
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
                                <th class="" style="width: 250px;">Company Name</th>
                                <th class="d-none d-sm-table-cell ">Status</th>
                                <th>Phone</th>
                                <th class="d-none d-xl-table-cell">Email</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <td class=" fs-sm">
                                    <a class="fw-semibold"
                                        href="{{route('customer_relationship_manager.customers.edit', $customer)}}">
                                        <strong>{{$customer->company_name}}</strong>
                                    </a>
                                </td>
                                <td class="d-none d-sm-table-cell  fs-sm">@switch($customer->status)
                                    @case('potential')
                                    <span class="badge bg-gray">Potential</span>
                                    @break
                                    @case('active')
                                    <span class="badge bg-success">Active</span>
                                    @break
                                    @case('cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                    @break
                                    @case('not_interested')
                                    <span class="badge bg-danger">Not
                                        Interested</span>
                                    @break
                                    @case('contacted')
                                    <span class="badge bg-information">Contacted</span>
                                    @break
                                    @default
                                    <span class="badge bg-information">Unkown</span>
                                    @endswitch
                                </td>
                                <td>
                                    <code>{{$customer->phone}}</code>
                                </td>
                                <td class="d-none d-sm-table-cell  fs-sm"><code>{{$customer->email}}</code></td>

                                <td class="">
                                    <a class="btn btn-sm btn-alt-secondary"
                                        href="{{route('customer_relationship_manager.customers.show', $customer->id)}}"
                                        data-bs-toggle="tooltip" title="View">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                            @if($customers->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center ">
                                    <p class="m-0">No customers added yet</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>


                {{ $customers->links() }}
                <!-- END Pagination -->
            </div>
        </div>


    </div>
</div>
<!-- END Page Content -->
@endsection
