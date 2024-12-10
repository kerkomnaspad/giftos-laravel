@extends('main.main')

@section('content')
<div class="d-flex justify-content-between align-items-center col">
    <div>
        <h5 class="card-header mb-0">Your Transaction History</h5>
    </div>
    <div class="px-3 py-2">
        <form method="GET" action="{{ route('cart') }}">
            <button type="submit" class="btn btn-dark">Cart</button>
        </form>

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
    <div class="card">
        <div class="card-body row align-items-center py-2">
            <div class="col">
                <h6 class="card-title mb-0">ID</h6>
            </div>
            <div class="col">
                <h6 class="card-title mb-0">Date</h6>
            </div>
            <div class="col">
                <h6 class="card-title mb-0">Price</h6>
            </div>
            <div class="col">
                <h6 class="card-title mb-0">Status</h6>
            </div>
        </div>
    </div>
    @foreach ($orders as $order)

        <div class="card">
            <div class="card-body row align-items-center">

                <div class="col">
                    <h6 class="card-title">{{$order->id}}</h6>

                </div>
                <!-- <div class="col" style="flex: 0 0 10%; text-align: center;">
                                            <input type="checkbox" id="checkbox" class="form-check-input">
                                        </div> -->
                <div class="col">
                    <h6 class="card-title">{{$order->created_at}}</h6>

                </div>
                <div class="col">

                    <h6 class="card-title">
                        Rp {{ number_format($order->total_amount, 2, ',', '.') }}
                    </h6>

                </div>

                <div class="col">

                    <h6 class="card-title">
                        @if ($order->status == 0)
                        <span class="text-warning">PENDING</span>
                        @elseif ($order->status == 1)
                        <span class="text-success">PROCESSED</span>
                        @elseif ($order->status == 2)
                        <span class="text-danger">CANCELLED</span>
                        @else
                            Unknown Status
                        @endif
                    </h>

                </div>
            </div>

        </div>
    @endforeach
@endif
</div>

@endsection