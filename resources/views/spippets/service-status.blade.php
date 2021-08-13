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
        {{ $service->start_time->longAbsoluteDiffForHumans() }}
    </p>
@endif