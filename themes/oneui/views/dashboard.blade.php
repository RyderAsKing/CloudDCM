@extends('layouts.backend')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-1">
                    Dashboard
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Welcome {{auth()->user()->name}}, everything looks great.
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
        @hasrole('user')
        <div class="col-sm-6 col-xxl-2">
            <div class="block block-rounded d-flex flex-column h-100 mb-0  js-appear-enabled animated fadeIn">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$users}}</dt>
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
        @endhasrole

        @if(auth()->user()->can('view', App\Models\Rack::class) || auth()->user()->can('view',
        App\Models\Vps::class))
        <div class="col-sm-6 col-xxl-2">
            <div
                class="block block-rounded d-flex flex-column h-100 mb-0 js-appear-enabled animated fadeIn js-appear-enabled animated fadeIn">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$colocation_manager['locations']->count() +
                            $vps_manager['locations']->count()}}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Locations</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa-solid fa-building fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <span
                        class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between text-primary">
                        <span>{{$colocation_manager['racks']}} racks and {{$vps_manager['vps']}}
                            VPS</span>
                    </span>
                </div>
            </div>
        </div>
        @endif

        @can('view', App\Models\Rack::class)
        <div class="col-sm-6 col-xxl-2">
            <!-- New Customers -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0 js-appear-enabled animated fadeIn">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$colocation_manager['racks']}}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Racks</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa-solid fa-server fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <span
                        class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between text-primary">
                        <span>{{$colocation_manager['rackSpaces']}} rack spaces</span>
                    </span>
                </div>
            </div>
            <!-- END New Customers -->
        </div>
        @endcan

        @can('view', App\Models\Customer::class)
        <div class="col-sm-6 col-xxl-2">
            <!-- Conversion Rate -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0 js-appear-enabled animated fadeIn">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$customer_relationship_manager['customers']}}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Customers</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa fa-chart-bar fs-3 text-primary"></i>
                    </div>
                </div>
            </div>
            <!-- END Conversion Rate-->
        </div>
        @endcan

        @can('view', App\Models\Subnet::class)
        <div class="col-sm-6 col-xxl-2">
            <!-- Conversion Rate -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0 js-appear-enabled animated fadeIn">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$ip_manager['subnets']}}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Subnets</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa fa-chart-bar fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <span
                        class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between text-primary">
                        <span>{{$ip_manager['sub_subnets']}} sub subnets</span>
                    </span>
                </div>
            </div>
            <!-- END Conversion Rate-->
        </div>
        @endcan

        @can('view', App\Models\Server::class)
        <div class="col-sm-6 col-xxl-2">
            <!-- Conversion Rate -->
            <div class="block block-rounded d-flex flex-column h-100 mb-0 js-appear-enabled animated fadeIn">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{$dedicated_server_manager['servers']}}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Servers</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa fa-chart-bar fs-3 text-primary"></i>
                    </div>
                </div>
            </div>
            <!-- END Conversion Rate-->
        </div>
        @endcan
    </div>

    <div class="row items-push">
        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0 js-appear-enabled animated fadeIn">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Welcome</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>
                        Here you can manage modules assigned to your account. You can also view the statistics of the
                        modules.
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

        @can('view', App\Models\Rack::class)
        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0 js-appear-enabled animated fadeIn">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ $colocation_manager['chart']->options['chart_title'] }}</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>{!! $colocation_manager['chart']->renderHtml() !!}
                    </p>
                </div>
            </div>
        </div>
        @endcan


        @can('view', App\Models\Customer::class)
        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0 js-appear-enabled animated fadeIn">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ $customer_relationship_manager['chart']->options['chart_title'] }}</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>{!! $customer_relationship_manager['chart']->renderHtml() !!}
                    </p>
                </div>
            </div>
        </div>
        @endcan
        @can('view', App\Models\Vps::class)
        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0 js-appear-enabled animated fadeIn">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ $vps_manager['chart']->options['chart_title'] }}</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>{!! $vps_manager['chart']->renderHtml() !!}
                    </p>
                </div>
            </div>

        </div>
        @endcan
        @can('view', App\Models\Subnet::class)
        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0 js-appear-enabled animated fadeIn">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ $ip_manager['chart']->options['chart_title'] }}</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>{!! $ip_manager['chart']->renderHtml() !!}
                    </p>
                </div>
            </div>
        </div>
        @endcan
        @can('view', App\Models\Server::class)
        <div class="col-md-6 col-xl-4">
            <div class="block block-rounded h-100 mb-0 js-appear-enabled animated fadeIn">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ $dedicated_server_manager['chart']->options['chart_title'] }}</h3>
                </div>
                <div class="block-content fs-sm text-muted">
                    <p>{!! $dedicated_server_manager['chart']->renderHtml() !!}
                    </p>
                </div>
            </div>
        </div>
        @endcan

    </div>
</div>
<!-- END Page Content -->
@endsection

@section('javascript')
{!! $colocation_manager['chart']->renderChartJsLibrary() !!}

@can('view', App\Models\Rack::class)
{!! $colocation_manager['chart']->renderJs() !!}
@endcan

@can('view', App\Models\Customer::class)
{!! $customer_relationship_manager['chart']->renderJs() !!}
@endcan

@can('view', App\Models\Vps::class)
{!! $vps_manager['chart']->renderJs() !!}
@endcan

@can('view', App\Models\Subnet::class)
{!! $ip_manager['chart']->renderJs() !!}
@endcan

@can('view', App\Models\Server::class)
{!! $dedicated_server_manager['chart']->renderJs() !!}
@endcan


@endsection
