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