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
                    Here you can manage subnets and sub alsubnets
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{route('dashboard')}}">App</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <span>Subnet Manager</span>
                    </li>

                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content ">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        @foreach($subnets as $subnet)
        <!-- Course -->
        @if(isset($subnet->name))


        <div class="block block-rounded row g-0">
            <ul class="nav nav-tabs nav-tabs-block flex-md-column col-md-4" role="tablist">
                <li class="nav-item d-md-flex flex-md-column" role="presentation">

                    <button class="nav-link text-md-start active" id="{{pureify($subnet->name) . $subnet->id .'_tab'}}"
                        data-bs-toggle="tab" data-bs-target="#{{pureify($subnet->name) . $subnet->id }}" role="tab"
                        aria-controls="{{pureify($subnet->name) . $subnet->id }}" aria-selected="true">
                        <i class="fa fa-fw fa-network-wired opacity-50 me-1 d-none d-sm-inline-block"></i> Subnet
                    </button>
                </li>

                @if($subnet->parent == null)
                <li class="nav-item d-md-flex flex-md-column" role="presentation">
                    <button class="nav-link text-md-start" id="{{pureify($subnet->name) . $subnet->id  . '_sub_tab'}}"
                        data-bs-toggle="tab" data-bs-target="#{{pureify($subnet->name) . $subnet->id  . '_sub'}}"
                        role="tab" aria-controls="{{pureify($subnet->name) . $subnet->id  . '_sub'}}"
                        aria-selected="false" tabindex="-1">
                        <i class="fa fa-fw fa-table-list opacity-50 me-1 d-none d-sm-inline-block"></i> Sub Subnets
                    </button>
                </li>
                @endif
            </ul>
            <div class="tab-content col-md-8">
                <div class="block-content tab-pane active show" id="{{pureify($subnet->name) . $subnet->id   }}"
                    role="tabpanel" aria-labelledby="{{pureify($subnet->name) . $subnet->id }}" tabindex="0">
                    <h4 class="fw-semibold">{{$subnet->name}}</h4>
                    <div class="list-group push">
                        <a class="list-group-item list-group-item-action"
                            href="{{route('ip_manager.subnets.show', $subnet)}}">
                            <h5 class="fs-base mb-1">
                                {{$subnet->name}}
                            </h5>
                            @if($subnet->subnet != null) <small> {{$subnet->subnet}}</small><br> @endif
                            @if($subnet->vlan != null)<small>{{$subnet->vlan}}</small><br>@endif
                            @if($subnet->leased_company != null)<small>{{$subnet->leased_company}}</small><br>@endif
                        </a>
                    </div>
                </div>
                <div class="block-content tab-pane" id="{{pureify($subnet->name) . $subnet->id  . '_sub'}}"
                    role="tabpanel" aria-labelledby="{{pureify($subnet->name) . $subnet->id  . '_sub'}}" tabindex="0">
                    <h4 class="fw-semibold">{{$subnet->name}}</h4>
                    <div class="list-group push">
                        @if($subnet->children->count() < 1) <a class="list-group list-group-item list-group-item-action"
                            href="javascript:void(0)">
                            <h5 class="fs-base mb-1">
                                No Subnets
                            </h5>
                            </a>
                            @endif

                            @foreach($subnet->children as $child)
                            <a class="list-group-item list-group-item-action"
                                href="{{route('ip_manager.subnets.show', $child)}}">
                                <h5 class="fs-base mb-1">
                                    {{$child->name}}
                                </h5>
                                @if($child->subnet != null)<small> {{$child->subnet}}</small><br>@endif
                                @if($child->vlan != null)<small>{{$child->vlan}}</small><br>@endif
                                @if($child->leased_company !=
                                null)<small>{{$child->leased_company}}</small><br>@endif
                            </a>
                            @endforeach
                    </div>
                </div>

            </div>

            @endif
        </div>


        @endforeach
        <!-- END Course -->

        {{ $subnets->links() }}

        <div style="grid-column: 1 / -1; margin-bottom: 2rem;">
            <x-primary-link class="js-appear-enabled animated fadeIn" href="{{route('ip_manager.subnets.create')}}">Add
                Subnet +</x-primary-link>

        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection
