@extends('layouts.app')

@section('content')
    @parent

    <div id="content" class="main-content">
        <div class="container">
            <div class="page-header">
                <div class="page-title">
                    <h3>Server Service Status Quickview</h3>
                </div>
            </div>

            <div class="row layout-spacing ">
                @foreach ($servicesHealth as $service)
                    <div class="col-xl-3 mb-xl-0 col-lg-6 mb-4 col-md-6 col-sm-6">
                        <div class="widget-content-area  data-widgets br-4">
                            <div class="widget
                                    @switch($service->name)
                                        @case('scandaemon')
                                        t-sales-widget
                                            @break
                                        @case('sgdaemon')
                                        t-order-widget
                                            @break
                                        @case(config('sshServices.mysql_type'))
                                        t-customer-widget
                                            @break
                                        @case('httpd')
                                        t-income-widget
                                            @break
                                    @endswitch
                                ">
                                <div class="media">
                                    <div class="icon ml-2 full">
                                        <i class="{{ $service->flaticon_name }}"></i>
                                    </div>
                                    <div class="media-body full">
                                        <p class="widget-text mb-0">{{ $service->public_name }}
                                            <br />{{ $service->description }}</p>
                                    </div>
                                </div>

                                @if (empty($service->start_time))
                                    <p class="widget-total-stats mt-2">
                                        <i class="fa fa-arrow-down service-down"></i>
                                        Is down
                                        {{ $service->fail_time->diffForHumans() }}
                                    </p>
                                @else
                                    <p class="widget-total-stats mt-2">
                                        <i class="fa fa-arrow-up service-up"></i>
                                        Running for
                                        @if($service->start_time)
                                            @php
                                                $startTime = $date = Carbon\Carbon::parse($service->start_time);
                                            @endphp
                                            {{ $startTime->longAbsoluteDiffForHumans() }}
                                        @endif
                                    </p>
                                @endif

                                <p class="mybtn">
                                    <a href="{{ route('vulnerability-health') }}#{{ $service->name }}"
                                        class="btn {{ $service->css_class }} btn-rounded  mr-2">
                                        View More...
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="page-header">
                <div class="page-title">
                    <h3>Reporting Quick Links </h3>
                </div>
            </div>

            <div class="row layout-spacing ">

                <div class="col-xl-3 mb-xl-0 col-lg-6 mb-4 col-md-6 col-sm-6">
                    <div class="widget-content-area  data-widgets br-4">
                        <div class="widget  t-sales-widget">
                            <div class="media">
                                <div class="media-body ">
                                    <p class="widget-text mb-0 ">VIN<br />in the last<br />5 weeks</p>
                                </div>
                            </div>

                            <p class="widget-total-stats mt-2 b1 widget-stats-title">Products (Installations)</p>

                            @if(!empty($VIN))
                                <p class="widget-total-stats mt-2 b1">{{ $VIN->count() }} ({{ $VIN->sum('installationCount') }})</p>
                            @else
                                <p class="widget-total-stats mt-2 b1">1</p>
                            @endif

                            <p class="mybtn">
                                @if(!empty($VIN))
                                    @if ($VIN->count() == 0)
                                        <a href="#" class="btn btn-outline-danger btn-rounded  mr-2">View More...</a>
                                    @else
                                        <a href="{{ route('detailedVulnerabilitiesForFiveWeeks', ['type' => 'VIN']) }}"
                                            class="btn btn-outline-danger btn-rounded  mr-2">View More...</a>
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 mb-xl-0 col-lg-6 mb-4 col-md-6 col-sm-6">
                    <div class="widget-content-area  data-widgets br-4">
                        <div class="widget  t-order-widget">
                            <div class="media">
                                <div class="media-body ">
                                    <p class="widget-text mb-0 ">VOUT<br />in the last<br />5 weeks</p>
                                </div>
                            </div>

                            <p class="widget-total-stats mt-2 b2 widget-stats-title">Products</p>

                            @if(!empty($VOUT))
                                <p class="widget-total-stats mt-2 b2">{{ $VOUT->count() }}</p>
                            @else
                                <p class="widget-total-stats mt-2 b2">1</p>
                            @endif
                            <p class="mybtn">
                                @if(!empty($VOUT))
                                    @if ($VOUT->count() == 0)
                                        <a href="#" class="btn btn-outline-secondary btn-rounded  mr-2">View More...</a>
                                    @else
                                        <a href="{{ route('detailedVulnerabilitiesForFiveWeeks', ['type' => 'VOUT']) }}"
                                            class="btn btn-outline-secondary btn-rounded  mr-2">View More...</a>
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-sm-0 mb-4">
                    <div class="widget-content-area  data-widgets br-4">
                        <div class="widget  t-customer-widget">
                            <div class="media">
                                <div class="media-body ">
                                    <p class="widget-text mb-0 ">Currently Active
                                        <br /> Vulnerabilities<br />-Non Microsoft
                                    </p>
                                </div>
                            </div>

                            <p class="widget-total-stats mt-2 b3 widget-stats-title">Products (Installations)</p>

                            @if(!empty($NetNonMicrosoft))
                                <p class="widget-total-stats mt-2 b3">{{ $NetNonMicrosoft->count() }} ({{ $NetNonMicrosoft->sum('installationCount') }})</p>
                            @else
                                <p class="widget-total-stats mt-2 b3">0</p>
                            @endif
                            <p class="mybtn">
                                @if(!empty($NetNonMicrosoft))
                                    @if ($NetNonMicrosoft->count() == 0)
                                        <a href="#" class="btn btn-outline-success btn-rounded  mr-2">View More...</a>
                                    @else
                                        <a href="{{ route('detailedVulnerabilitiesForFiveWeeks', ['type' => 'NetNonMicrosoft']) }}"
                                            class="btn btn-outline-success btn-rounded  mr-2">View More...</a>
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="widget-content-area  data-widgets br-4">
                        <div class="widget  t-income-widget">
                            <div class="media">
                                <div class="media-body ">
                                    <p class="widget-text mb-0 ">Currently Active<br />
                                        Vulnerabilities<br />-Microsoft</p>
                                </div>
                            </div>

                            <p class="widget-total-stats mt-2 b4 widget-stats-title">Products (Installations)</p>
                            @if(!empty($NetMicrosoft))
                                <p class="widget-total-stats mt-2 b4">{{ $NetMicrosoft->count() }} ({{ $NetMicrosoft->sum('installationCount') }})</p>
                            @else
                                <p class="widget-total-stats mt-2 b4">0</p>
                            @endif

                            <p class="mybtn">
                                @if(!empty($NetMicrosoft))
                                    @if ($NetMicrosoft->count() == 0)
                                        <a href="#" class="btn btn-outline-warning btn-rounded  mr-2">View More...</a>
                                    @else
                                        <a href="{{ route('detailedVulnerabilitiesForFiveWeeks', ['type' => 'NetMicrosoft']) }}"
                                            class="btn btn-outline-warning btn-rounded  mr-2">View More...</a>
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-header">
                <div class="page-title1">
                    <h3>Vulnerability Quickview </h3>
                </div>
            </div>

            <div class="row layout-spacing ">
                <div class="col-xl-3 mb-xl-0 col-lg-6 mb-4 col-md-6 col-sm-6">
                    <div class="widget-content-area1  data-widgets br-4">
                        <div class="widget  t-sales-widget1">
                            <div class="media">
                                <div class="icon1 ml-2 full">
                                    <i class="flaticon-line-chart"></i>
                                </div>
                                <div class="media-body full">
                                    <p class="widget-text mb-0">Vulnerability Timeline</p>
                                </div>
                            </div>

                            <p class="mybtn">
                                <a href="{{ route('vulnerability-timeline') }}"
                                    class="btn btn-outline-danger btn-rounded  mr-2 mybtn1">
                                    View More...
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 mb-xl-0 col-lg-6 mb-4 col-md-6 col-sm-6">
                    <div class="widget-content-area1  data-widgets br-4">
                        <div class="widget  t-order-widget1">
                            <div class="media">
                                <div class="icon1 ml-2 full">
                                    <i class="flaticon-list2"></i>
                                </div>

                                <div class="media-body full ">
                                    <p class="widget-text mb-0">Vulnerability List</p>
                                </div>
                            </div>

                            <p class="mybtn">
                                <a href="{{ route('vulnerability-list') }}"
                                    class="btn btn-outline-secondary btn-rounded mr-2 mybtn1">
                                    View More...
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-sm-0 mb-4">
                    <div class="widget-content-area1  data-widgets br-4">
                        <div class="widget  t-customer-widget1">
                            <div class="media">
                                <div class="icon1 ml-2 full">
                                    <i class="flaticon-3d-cube"></i>
                                </div>

                                <div class="media-body full ">
                                    <p class="widget-text mb-0">Server Health</p>
                                </div>
                            </div>

                            <p class="mybtn">
                                <a href="{{ route('vulnerability-health') }}"
                                    class="btn btn-outline-success btn-rounded mr-2 mybtn1">
                                    View More...
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="widget-content-area1  data-widgets br-4">
                        <div class="widget  t-income-widget1">
                            <div class="media">
                                <div class="icon1 ml-2 full">
                                    <i class="flaticon-copy-line"></i>
                                </div>

                                <div class="media-body full">
                                    <p class="widget-text mb-0">Error Logging</p>
                                </div>
                            </div>

                            <p class="mybtn">
                                <a href="{{ route('error-logging') }}"
                                    class="btn btn-outline-warning btn-rounded mr-2 mybtn1">
                                    View More...
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
