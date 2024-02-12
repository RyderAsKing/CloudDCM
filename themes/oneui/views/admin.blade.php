@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-1">
                    Admin Dashboard
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Welcome Admin, everything looks great.
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="javascript:void(0)">App</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        Dashboard
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div class="row items-push">
        <div class="col-sm-6 col-xxl-2">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$admin_statistics['users']}}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Users</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa-solid fa-user fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                        href="{{route('users.index')}}">
                        <span>Manage users</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>

        </div>
        <div class="col-sm-6 col-xxl-2">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$admin_statistics['locations']}}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Locations</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa-solid fa-building fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <span
                        class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between text-primary">
                        <span>{{$admin_statistics['racks']}} racks and {{$admin_statistics['vpss']}} VPS</span>
                    </span>
                </div>
            </div>

        </div>
        <div class="col-sm-6 col-xxl-2">
            <!-- New Customers -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$admin_statistics['racks']}}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Racks</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa-solid fa-server fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <span
                        class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between text-primary">
                        <span>{{$admin_statistics['rackSpaces']}} rack spaces</span>
                    </span>
                </div>
            </div>
            <!-- END New Customers -->
        </div>

        <div class="col-sm-6 col-xxl-2">
            <!-- Conversion Rate -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$admin_statistics['customers']}}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Customers</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa fa-chart-bar fs-3 text-primary"></i>
                    </div>
                </div>
            </div>
            <!-- END Conversion Rate-->
        </div>


        <div class="col-sm-6 col-xxl-2">
            <!-- Conversion Rate -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$admin_statistics['subnets']}}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Subnets</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa fa-chart-bar fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <span
                        class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between text-primary">
                        <span>{{$admin_statistics['sub_subnets']}} sub subnets</span>
                    </span>
                </div>
            </div>
            <!-- END Conversion Rate-->
        </div>
        <div class="col-sm-6 col-xxl-2">
            <!-- Conversion Rate -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$admin_statistics['servers']}}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Servers</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa fa-chart-bar fs-3 text-primary"></i>
                    </div>
                </div>
            </div>
            <!-- END Conversion Rate-->
        </div>
    </div>

    <div class="row items-push">
        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Welcome</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>
                        Here you can manage users and their subusers and also manage the companies.
                    </p>
                    <p>
                        This dashboard also provides you with the ability to visualize the data in the form of charts.
                    </p>
                    <hr />
                    <p>
                        <script type="text/javascript" src="https://www.brainyquote.com/link/quotebr.js"></script>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ $charts['locations_chart']->options['chart_title'] }}</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>{!! $charts['locations_chart']->renderHtml() !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ $charts['racks_chart']->options['chart_title'] }}</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>{!! $charts['racks_chart']->renderHtml() !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ $charts['customers_chart']->options['chart_title'] }}</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>{!! $charts['customers_chart']->renderHtml() !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ $charts['vpss_chart']->options['chart_title'] }}</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>{!! $charts['vpss_chart']->renderHtml() !!}
                    </p>
                </div>
            </div>

        </div>

        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ $charts['subnets_chart']->options['chart_title'] }}</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>{!! $charts['subnets_chart']->renderHtml() !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ $charts['servers_chart']->options['chart_title'] }}</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>{!! $charts['servers_chart']->renderHtml() !!}
                    </p>
                </div>
            </div>
        </div>




    </div>
</div>
<!-- END Page Content -->
@endsection

@section('javascript')
{!! $charts['racks_chart']->renderChartJsLibrary() !!}

{!! $charts['racks_chart']->renderJs() !!}

{!! $charts['locations_chart']->renderJs() !!}

{!! $charts['customers_chart']->renderJs() !!}

{!! $charts['vpss_chart']->renderJs() !!}

{!! $charts['subnets_chart']->renderJs() !!}

{!! $charts['servers_chart']->renderJs() !!}

@endsection