<div class="d-flex justify-content-between align-items-center">
	@if(count($pagination)>0)
    <div class="fs-7">Showing {{$pagination->firstItem()}} to {{$pagination->lastItem()}} of {{$pagination->total()}} entries</div>
    <ul class="pagination pagination-sm pagination-separated mb-0 justify-content-end">
        @if ($pagination->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true"><i class="ri-arrow-left-s-line"></i></span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $pagination->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="ri-arrow-left-s-line"></i></a>
            </li>
        @endif
        @for ($i = 1; $i <= $pagination->lastPage(); $i++)
            @if ($i == $pagination->currentPage())
                <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $pagination->url($i) }}">{{ $i }}</a></li>
            @endif
        @endfor
        @if ($pagination->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $pagination->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="ri-arrow-right-s-line"></i></a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true"><i class="ri-arrow-right-s-line"></i></span>
            </li>
        @endif
    </ul>
    @else
    <div class="fs-7">Showing 0 to 0 of 0 entries</div>
    @endif

</div>
