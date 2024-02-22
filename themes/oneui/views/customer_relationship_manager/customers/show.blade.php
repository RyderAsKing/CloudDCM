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
                    You are currently viewing a customer
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{route('dashboard')}}">App</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{route('customer_relationship_manager.customers.index')}}">CRM</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <span>Customer</span>
                    </li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<div class="content">
    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <a class="block block-rounded block-link-shadow text-center"
                href="{{route('customer_relationship_manager.customers.edit', $customer)}}">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-dark">
                        <i class="fa fa-pencil-alt"></i>
                    </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="fw-medium fs-sm text-muted mb-0">
                        Edit Customer
                    </p>
                </div>
            </a>
        </div>

    </div>
    <!-- END Quick Actions -->

    <!-- User Info -->
    <div class="block block-rounded">
        <div class="block-content text-center">
            <div class="py-4">
                <div class="mb-3">
                    <img class="img-avatar" src="{{asset('media/avatars/avatar13.jpg')}}" alt="">
                </div>
                <h1 class="fs-lg mb-0">
                    <span>{{$customer->company_name}}</span>
                </h1>
                <p class="fs-sm fw-medium text-muted">{{$customer->contact_name}}</p>
            </div>
        </div>
        <div class="block-content bg-body-light text-center">
            <div class="row items-push text-uppercase">
                <div class="col-lg-4 col-md-12">
                    <div class="fw-semibold text-dark mb-1">Website</div>
                    <a class="link-fx fs-5 text-primary" href="{{$customer->url != null ?
                        $customer->url : 'javascript:void(0)'}}">{{$customer->url != null ?
                        $customer->url : 'Not set'}}</a>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="fw-semibold text-dark mb-1">Email</div>
                    <a class="link-fx fs-5 text-primary"
                        href="{{$customer->email != null ? $customer->email : 'javascript:void(0)'}}">{{$customer->email
                        != null ? $customer->email : 'Not set'}}</a>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="fw-semibold text-dark mb-1">Phone</div>
                    <a class="link-fx fs-5 text-primary"
                        href="{{$customer->phone != null ? $customer->phone : 'javascript:void(0)'}}">{{$customer->phone
                        != null ? $customer->phone : 'Not set'}}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END User Info -->

    <!-- Addresses -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Addresses </h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Billing Address -->
                    <div class="block block-rounded block-bordered">
                        <div class="block-header border-bottom">
                            <h3 class="block-title">Business Address</h3>
                        </div>
                        <div class="block-content">
                            <div class="fs-3 mb-1">{{$customer->company_name}}</div>
                            <div class="fs-sm mb-1">{{$customer->contact_name}}</div>
                            <address class="fs-sm">
                                @if(isset($customer->address)){{$customer->address}} <br>@endif

                                @if(isset($customer->city)){{$customer->city}} <br>@endif
                                @if(isset($customer->phone))<i class="fa fa-phone"> </i> {{$customer->phone}}<br> @endif

                            </address>
                        </div>
                    </div>
                    <!-- END Billing Address -->
                </div>

            </div>
        </div>
    </div>
    <!-- END Addresses -->

    <!-- Private Notes -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title"> Notes</h3>
        </div>
        <div class="block-content">
            <p class="alert alert-dark fs-sm">
                <i class="fa fa-fw fa-info me-1"></i> {{$customer->notes != null ? $customer->notes : 'No notes
                available'}}
            </p>

        </div>
    </div>
    <!-- END Private Notes -->



    <!-- Referred Members -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">MSP Area</h3>
        </div>


        <div class="block-content">
            <div class="row items-push">
                @if(isset($customer->num_desktops))
                <div class="col-md-4">
                    <!-- Referred User -->
                    <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0"
                        href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-semibold mb-1">Number of desktops
                                </div>
                                <div class="fs-sm text-muted">
                                    {{$customer->num_desktops}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @if(isset($customer->num_notebooks))
                <div class="col-md-4">
                    <!-- Referred User -->
                    <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0"
                        href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-semibold mb-1">Number of notebooks
                                </div>
                                <div class="fs-sm text-muted">
                                    {{$customer->num_notebooks}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @if(isset($customer->num_printers))
                <div class="col-md-4">
                    <!-- Referred User -->
                    <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0"
                        href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-semibold mb-1">Number of printers
                                </div>
                                <div class="fs-sm text
                                -muted">
                                    {{$customer->num_printers}}
                                </div>

                            </div>

                        </div>
                    </a>
                </div>
                @endif


                @if(isset($customer->num_servers))
                <div class="col-md-4">
                    <!-- Referred User -->
                    <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0"
                        href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-semibold mb-1">Number of servers
                                </div>
                                <div class="fs-sm text muted">
                                    {{$customer->num_servers}}
                                </div>

                            </div>
                        </div>
                    </a>

                </div>
                @endif

                @if(isset($customer->num_firewalls))
                <div class="col-md-4">
                    <!-- Referred User -->
                    <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0"
                        href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-semibold mb-1">Number of firewall
                                </div>
                                <div class="fs-sm text muted">
                                    {{$customer->num_firewalls}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @if(isset($customer->num_switches))
                <div class="col-md-4">
                    <!-- Referred User -->
                    <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0"
                        href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-semibold mb-1">Number of switches
                                </div>
                                <div class="fs-sm text muted">
                                    {{$customer->num_switches}}
                                </div>

                            </div>
                        </div>
                    </a>

                </div>
                @endif

                @if(isset($customer->num_wifi_access_points))
                <div class="col-md-4">
                    <!-- Referred User -->
                    <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0"
                        href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-semibold mb-1">Number of
                                    wifi access points
                                </div>
                                <div class="fs-sm text muted">
                                    {{$customer->num_wifi_access_points}}
                                </div>

                            </div>
                        </div>
                    </a>

                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- END Referred Members -->

</div>
<!-- END Page Content -->
@endsection
