@extends('main.main')

@if(!Auth::check() || Auth::user()->role !== 'admin')
    <?php return redirect()->route('homePage'); ?>
@endif

@section('content')
@if(session('success'))
    <script>
        toastr.success('{{ session('success') }}');
    </script>
@endif
<div class="d-flex justify-content-between align-items-center col">
    <div class="px-3 py-2">
        <h5 class="card-header mb-0">Your Cart</h5>
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
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>


    @endif
</div>
@endsection