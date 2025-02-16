<link rel="stylesheet" href="{{ asset('assets/css/order_view.css') }}">
<div class="container align-items-center min-vh-100 py-5">
    <h1 class="display-4">Order <b class="fw-bold">#{{ str_pad($order->id, 10, '0', STR_PAD_LEFT) }}</b></h1>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <label class="fw-bold">Status:</label> <span
                @class([
                    'badge' => true,
                    'text-bg-dark' => $order->status == 1,
                    'text-bg-warning' => $order->status == 2,
                    'text-bg-success' => $order->status == 3,
                    'text-bg-danger' => $order->status == 4,
                ])>{{ $statuses[$order->status] }}</span>
        </div>
        <div class="col-md-4 col-sm-12">
            <label class="fw-bold">Payment Method:</label> {{ $order->payment_method }}
        </div>
        <div class="col-md-4 col-sm-12">
            <label class="fw-bold">Order Date:</label> {{ date('F j, Y, g:i a', strtotime($order->created_at)) }}
        </div>
    </div>
    @if (count($items) == 0)
        <div class="alert alert-warning" role="alert">
            Error occured no item(s) found.
        </div>
    @else
        <div class="cart-container">
            <table class="table cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Variant</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Serial Numbers</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td class="text-center product-column">
                                <a href="/shop/product/{{ $item->product->id }}/view"
                                    class="text-decoration-none d-flex align-items-center">
                                    @if (file_exists(public_path($item->image)))
                                        <img src="{{ asset($item->image) }}" class="img-fluid border rounded"
                                            alt="{{ htmlspecialchars($item->name) }}" />
                                    @else
                                        <img src="{{ asset('storage/assets/image/product_image/default.png') }}"
                                            class="img-fluid border rounded"
                                            alt="{{ htmlspecialchars($item->name) }}" />
                                    @endif
                                    <span>{{ $item->product->name }}</span>
                                </a>
                            </td>

                            <td>{{ $item->InventoryProduct->color->name }}</td>
                            <td class="text-center price-column">
                                @if ($item->discount > 0)
                                    <s class="text-muted">₱{{ number_format($item->original_price, 2) }}</s>
                                @endif
                                <strong>₱{{ number_format($item->original_price * (1 - $item->discount / 100), 2) }}</strong>
                                
                                @if ($item->discount > 0)
                                    <span class="text-success">(-{{ $item->discount }}%)</span>
                                @endif
                            </td>
                            <td class="text-center quantity-column">
                                @if ($item->product->product_type_id == 1)
                                    {{ number_format($item->product_quantity) }}
                                @elseif ($item->product->product_type_id == 2)
                                    {{ number_format($item->quantity) }}
                                @endif
                            </td>
                            <td class="text-center quantity-column">
                                @if ($item->product->product_type_id == 1)
                                    @foreach (explode(',', $item->serial_numbers) as $serial_number)
                                        <div>{{ $serial_number }}</div>
                                    @endforeach
                                @elseif ($item->product->product_type_id == 2)
                                    N/A
                                @endif

                            </td>
                            <td class="text-end total-column">
                                @if ($item->product->product_type_id == 1)
                                    ₱{{ number_format($item->price * $item->product_quantity, 2) }}
                                @elseif ($item->product->product_type_id == 2)
                                    ₱{{ number_format($item->price * $item->quantity, 2) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                @if ($errors->any())
                    <ul class="list-group my-2">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (session()->get('data'))
                    <ul class="list-group my-2">
                        @foreach (session()->get('data') as $data)
                            <li class="list-group-item list-group-item-success">{{ $data }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="cart-footer d-flex justify-countent-around">
                <h3 class="total-price">Total Price:</h3>
                <h3>₱{{ number_format($order->total, 2) }}</h3>
            </div>

            <div class="back-to-shop">
                @if ($order->status == 3)
                    <a href="/shop/order/{{ $order->id }}/product-review" class="btn btn-lg btn-tunetrack">Add
                        review</a>
                @endif
                <a href="/shop/orders" class="btn btn-secondary">Back to orders</a>
            </div>
        </div>
    @endif
</div>
