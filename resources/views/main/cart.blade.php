@extends('main.main')

@section('content')
@if(session('success'))
    <script>
        toastr.success('{{ session('success') }}');
    </script>
@endif
<div class="d-flex justify-content-between align-items-center col">
    <div>
        <h5 class="card-header mb-0">Your Cart</h5>
    </div>
    <div class="px-3 py-2">
        <form method="GET" action="{{ route('history') }}">
            <button type="submit" class="btn btn-dark">History</button>
        </form>

    </div>
</div>

<div style="min-height: calc(100vh - 100px);">

@if ($carts->isEmpty())


    <div class="card d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 100px);">
        <div class="card-body row align-items-center">
            <h2>Cart is empty</h2>
        </div>
    </div>
@else
    @foreach ($carts as $cart)


        <div class="card">
            <div class="card-body row align-items-stretch d-flex">

                <!-- <div class="col d-flex align-items-center justify-content-center" style="flex: 0 0 10%;">
                    <input type="checkbox" name="checked_items[]" value="{{ $cart->id }}" class="form-check-input">
                </div> -->
                <div class="col" style="flex: 0 0 35%; text-align: center;">
                    <img src="
                                                {{$cart->items->image}}
                                                " alt="{{$cart->items->name}}"
                        style="max-width: 100%; max-height: 10rem; height: auto; object-fit: contain;">
                </div>
                <div class="col d-flex flex-column" style="flex: 1;">
                    <h5 class="card-title">{{$cart->items->name}}</h5>
                    <p class="card-text">
                        <span>
                            Rp {{ number_format($cart->items->price, 2, ',', '.') }}
                        </span>
                    </p>


                    <div class="container d-flex flex-column mt-auto ms-auto">
                        <form method="POST" action="{{ route('updateCartQuantity') }}" class="d-flex justify-content-end">
                            @csrf
                            <div class="input-group" style="width: 120px;">
                                <!-- Decrement Button -->
                                <button type="submit" name="action" value="decrement"
                                    class="btn btn-outline-secondary btn-sm">-</button>

                                <!-- Quantity Input -->
                                <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                <input type="text" name="quantity" value="{{ $cart->quantity }}"
                                    class="form-control text-center" style="max-width: 50px;" readonly>

                                <!-- Increment Button -->
                                <button type="submit" name="action" value="increment"
                                    class="btn btn-outline-secondary btn-sm">+</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-end">
                            <span>
                                Total:
                                <b>
                                    Rp {{ number_format($cart->items->price * $cart->quantity, 2, ',', '.') }}

                                </b>
                            </span>
                        </div>

                    </div>
                </div>
                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->


            </div>



        </div>
    @endforeach
    <div class="d-flex justify-content-end px-5">

        <span>
            Total Price:
            <b>
                Rp {{ number_format($totalPrice, 2, ',', '.') }}

            </b>
        </span>






    </div>

    <div class="d-flex justify-content-end mx-5 px-5 my-3">
        <form action="{{ route('order') }}" method="POST" class=" w-100 my-2 mx-3">
            @csrf
        <button type="submit" class="btn btn-success w-100">Order</button>
        </form>
    </div>

@endif
</div>
@endsection