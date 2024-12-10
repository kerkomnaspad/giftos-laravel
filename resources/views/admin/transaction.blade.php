@extends('main.main')

@if(!Auth::check() || Auth::user()->role !== 'admin')
    <?php    return redirect()->route('homePage'); ?>
@endif
@section('content')
@if(session('success'))
    <script>
        toastr.success('{{ session('success') }}');
    </script>
@endif



<div class="d-flex justify-content-between align-items-center col">
    <div class="px-3 py-2">
        <h5 class="card-header mb-0">Transactions list</h5>
    </div>

</div>



<div style="min-height: calc(100vh - 100px);">

    @if ($orders->isEmpty())


        <div class="card d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 100px);">
            <div class="card-body row align-items-center">
                <h2>No Transaction Found</h2>
            </div>
        </div>
    @else
    <div class="d-flex justify-content-between align-items-center">

    <div class="text-left px-6">
        Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} results
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination px-6">

            @if ($orders->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">&laquo;</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $orders->previousPageUrl() }}" tabindex="-1">&laquo;</a>
                </li>
            @endif


            @foreach ($orders->links()->elements[0] as $page => $url)
                @if ($page == $orders->currentPage())
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">{{ $page }}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach


            @if ($orders->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $orders->nextPageUrl() }}">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-disabled="true">&raquo;</a>
                </li>
            @endif
        </ul>
    </nav>
</div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="sortable-header">
                        <a href="{{ route('atransactions', ['sortBy' => 'id', 'order' => ($sortBy === 'id' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>TransactionID</span>
                            <span class="sort-arrow">{!! $sortBy === 'id' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>
                    <th scope="col" class="sortable-header">
                        <a href="{{ route('atransactions', ['sortBy' => 'user_id', 'order' => ($sortBy === 'user_id' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>UserID</span>
                            <span class="sort-arrow">{!! $sortBy === 'user_id' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>
                    <th scope="col" class="sortable-header">
                        <a href="{{ route('atransactions', ['sortBy' => 'total_amount', 'order' => ($sortBy === 'total_amount' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>Amount</span>
                            <span class="sort-arrow">{!! $sortBy === 'total_amount' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>
                    <th scope="col" class="sortable-header">
                        <a href="{{ route('atransactions', ['sortBy' => 'created_at', 'order' => ($sortBy === 'created_at' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>Date</span>
                            <span class="sort-arrow">{!! $sortBy === 'created_at' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>
                    <th scope="col" class="sortable-header">
                        <a href="{{ route('atransactions', ['sortBy' => 'status', 'order' => ($sortBy === 'status' && $order === 'asc') ? 'desc' : 'asc'] + request()->except('page')) }}"
                            class="sortable-link">
                            <span>Status</span>
                            <span class="sort-arrow">{!! $sortBy === 'status' ? ($order === 'asc' ? '↑' : '↓') : '' !!}</span>
                        </a>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            @if(session('showAddItemForm'))
            <tr class="collapsible-row">
                <td>
                    <input type="file" name="image" class="form-control" required>
                </td>
                <td>
                    <input type="text" name="name" class="form-control" placeholder="Item Name" required>
                </td>
                <td>
                    <input type="text" name="price" class="form-control" placeholder="Rp 0,00" required>
                </td>
                <td>
                    <form action="{{ route('storeItem') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </td>
            </tr>
            
        @endif

                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user_id }}</td>
                        <td>Rp {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d F Y H:i:s') }}</td>
                        <td>
                            @if ($order->status == 0)
                                <span class="text-warning">PENDING</span>
                            @elseif ($order->status == 1)
                                <span class="text-success">PROCESSED</span>
                            @elseif ($order->status == 2)
                                <span class="text-danger">CANCELLED</span>
                            @else
                                Unknown Status
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-column col gap-1">
                                @if ($order->status == 0)
                                    <form action="{{ route('processOrder') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="btn btn-outline-success btn-sm">Process</button>
                                    </form>

                                    <form action="{{ route('cancelOrder') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Cancel</button>
                                    </form>
                                @endif
                                <form onsubmit="return false;">
                                    <button class="btn btn-outline-info btn-sm" data-toggle="collapse"
                                        data-target="#details-{{ $order->id }}">
                                        View Details
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr class="collapse" id="details-{{ $order->id }}">
                        <td colspan="2">
                            @include('admin.tDetail', ['order' => $order])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    @endif
</div>
@endsection