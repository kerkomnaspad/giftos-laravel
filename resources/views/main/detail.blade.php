@extends('main.main')

@section('content')


<section class="client_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Product Detail
            </h2>
        </div>
    </div>
    <div class="container px-0" id="productDetail">
        <div class="box d-flex border rounded mb-4" style="height: 100%;">
            <div class="img-box flex-shrink-0" style="flex: 1;">
                <img src="{{$item->image}}" alt="{{$item->name}}" class="img-fluid h-100 w-100"
                    style="object-fit: cover;">
            </div>
            <div class="detail-box d-flex flex-column justify-content-between p-3" style="flex: 1;">
                <h4 class="product-name">{{$item->name}}</h4>
                <h5 class="product-category text-muted">Category: {{$item->item_types->name}}</h5>
                <p class="product-description">{{$item->description}}</p>
                <h6 class="product-price">Price: <br>
                    <span>
                        Rp {{ number_format($item->price, 2, ',', '.') }}
                    </span>
                </h6>
                @if(session('success'))
                    <script>
                        toastr.success('{{ session('success') }}');
                    </script>
                @endif
                <form action="{{ route('add.to.cart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}"> <!-- Assuming $item is defined -->
                    <button type="submit" class="btn btn-primary btn-sm align-self-end add-to-cart-btn">Add to
                        Cart</button>
                </form>



            </div>
        </div>
    </div>
</section>

@endsection