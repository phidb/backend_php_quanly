@php
    $totalItems = $items->total();
    $totalPages = $items->lastPage();
    $totalItemsPerpage = $items->perPage();
@endphp

<div class="x_content">
    <div class="row">
        <div class="col-md-6">
            <p class="m-b-0">
                Tổng số phần tử trên 1 trang: <span class="label label-success label-pagination">{{ $totalItemsPerpage }}</span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tổng số phần tử: <span class="label label-success label-pagination">{{ $totalItems }}</span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tổng số trang: <span class="label label-success label-pagination">{{ $totalPages }}</span>
            </p>
        </div>
        <div class="col-md-6">
            {{ $items->links('pagination.pagination_backend') }}
        </div>
    </div>
</div>