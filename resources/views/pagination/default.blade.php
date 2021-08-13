@if ($paginator->lastPage() > 1)
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div class="dataTables_info" id="default-ordering_info" role="status" aria-live="polite">Showing page
                {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
            </div>
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers" id="default-ordering_paginate">
                <ul class="pagination pagination-style-13 pagination-bordered mb-5">
                    <li class="paginate_button page-item previous {{ $paginator->currentPage() == 1 ? ' disabled' : '' }}"
                        id="default-ordering_previous">
                        <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" aria-controls="default-ordering" data-dt-idx="0" tabindex="0"
                            class="page-link">
                            <i class="flaticon-arrow-left-1"></i>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                        @if ($i == $paginator->currentPage() - 1 && $i - 1 > 1)
                            <li class="paginate_button page-item previous disabled">
                                <a href="#" aria-controls="default-ordering" data-dt-idx="0" tabindex="0"
                                    class="page-link">
                                    ...
                                </a>
                            </li>
                        @endif
                    
                        @if (
                            $i >= $paginator->currentPage() - 1 
                            && $i <= $paginator->currentPage() + 1
                            || $i == 1
                            || $i == $paginator->lastPage()
                        )
                            <li class="paginate_button page-item {{ $paginator->currentPage() == $i ? ' active' : '' }}">
                                <a href="{{ $paginator->url($i) }}" aria-controls="default-ordering" data-dt-idx="{{ $i }}"
                                    tabindex="0" class="page-link">
                                    {{ $i }}
                                </a>
                            </li>
                        @endif
                        
                        @if ($i == $paginator->currentPage() + 1 && $i + 1 < $paginator->lastPage())
                            <li class="paginate_button page-item previous disabled">
                                <a href="#" aria-controls="default-ordering" data-dt-idx="0" tabindex="0"
                                    class="page-link">
                                    ...
                                </a>
                            </li>
                        @endif
                    @endfor
                    <li id="default-ordering_next"
                        class="paginate_button page-item next {{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }}">
                        <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" aria-controls="default-ordering"
                            data-dt-idx="4" tabindex="0" class="page-link">
                            <i class="flaticon-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif
