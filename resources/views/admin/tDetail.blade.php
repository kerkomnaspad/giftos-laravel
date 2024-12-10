@if(!Auth::check() || Auth::user()->role !== 'admin')
    <?php return redirect()->route('homePage'); ?>
@endif
<div class="panel panel-info">
    <div class="panel-heading"><h4><u>Order Details</u></h4></div>
    <div class="panel-body">
        <p>Username: <b>{{$order->user->name}}</b></p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ItemID</th>
                    <th scope="col">ItemName</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($order->transaction_items as $ti)
                    @if($ti->items) <!-- Check if the related item exists -->
                        <tr>
                            <td>{{ $ti->items->id }}</td>
                            <td>{{ $ti->items->name }}</td>
                            <td>{{ $ti->quantity }}</td>
                            <td>Rp {{ number_format($ti->items->price, 2, ',', '.') }}</td>
                            <td>Rp {{ number_format($ti->items->price*$ti->quantity, 2, ',', '.') }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="5">Item not found</td>
                        </tr>
                    @endif


                @endforeach
            </tbody>
        </table>
    </div>
</div>
