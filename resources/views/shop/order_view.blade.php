<style>
/* General Cart Styles */
.cart-container {
    max-width: 1100px;
    margin: 30px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
}

.cart-table th,
.cart-table td {
    padding: 15px;
    text-align: left;
    vertical-align: middle;
    font-family: 'Arial', sans-serif;
}

.cart-table th {
    background-color: #f1f1f1;
    font-weight: 600;
    color: #555;
}

.cart-table td {
    border-bottom: 1px solid #f1f1f1;
}

.product-info {
    display: flex;
    align-items: center;
}

.cart-image {
    margin-right: 10px;
    border-radius: 10px;
    width: 70px;
    height: 70px;
    object-fit: cover;
}

.price-column,
.total-column,
.actions-column {
    text-align: center;
    font-size: 1.1rem;
}

.quantity-column {
    text-align: center;
}

.update-btn {
    padding: 6px 12px;
    font-size: 1rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.update-btn:hover {
    background-color: #0056b3;
}

.remove-btn {
    background-color: #dc3545;
    color: white;
    padding: 6px 12px;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.remove-btn:hover {
    background-color: #c82333;
}

/* Cart Footer */
.cart-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #ddd;
}

.total-price {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

.checkout-btn {
    padding: 12px 25px;
    font-size: 1.2rem;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.checkout-btn:hover {
    background-color: #218838;
}

.back-to-shop {
    margin-top: 20px;
    text-align: center;
}

.btn-secondary {
    font-size: 1rem;
    padding: 10px 20px;
    background-color: #6c757d;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Update Form */
.update-form {
    display: inline-block;
    width: 100%;
}

.quantity-input {
    width: 60px;
    padding: 5px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Alert Styling */
.alert-warning {
    margin-top: 20px;
    text-align: center;
    font-size: 1.2rem;
    color: #856404;
    background-color: #fff3cd;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #ffeeba;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cart-table th, .cart-table td {
        padding: 10px;
    }

    .cart-footer {
        flex-direction: column;
        align-items: flex-start;
    }

    .checkout-btn {
        width: 100%;
        margin-top: 15px;
    }

    .back-to-shop a {
        width: 100%;
        display: inline-block;
        margin-top: 15px;
    }
}
</style>

<div class="container align-items-center min-vh-100 py-5">
    <h1 class="display-4">Order <b class="fw-bold">#{{ str_pad($order->id, 10, "0", STR_PAD_LEFT) }}</b></h1>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <label class="fw-bold">Status:</label> <span
                @class([
                    'badge' => true,
                    'text-bg-dark' => $order->status == 1,
                    'text-bg-warning' => $order->status == 2,
                    'text-bg-success' => $order->status == 3,
                    'text-bg-danger' => $order->status == 4,
                ])
            >{{ $statuses[$order->status] }}</span>
        </div>
        <div class="col-md-4 col-sm-12">
            <label class="fw-bold">Payment Method:</label> {{ $order->payment_method }}
        </div>
        <div class="col-md-4 col-sm-12">
            <label class="fw-bold">Order Date:</label> {{ date("F j, Y, g:i a", strtotime($order->created_at)) }}
        </div>
    </div>
    @if (count($items) == 0)
    <div class="alert alert-warning" role="alert">
        Error occured not item(s) found.
    </div>
    @else
        <div class="cart-container">
            <table class="table cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Variant</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                @foreach( $items as $item )
                    <tr>
                        <td class="product-info">
                            <a href="/shop/product/{{ $item->product_id }}/view" class="text-decoration-none">
                                <img src="{{ asset('/assets/images/inventory/uploads/' . $item->image ) }}" alt="{{ $item['product_name'] }}" width="60" class="img-thumbnail cart-image">
                                <span>{{ $item['name'] }}</span>
                            </a>
                        </td>
                        <td>{{ $item['color_name'] }}</td>
                        <td class="price-column">
                            ${{ number_format($item['price'], 2) }}
                        </td>
                        <td class="quantity-column">
                            {{ $item->quantity }}
                        </td>
                        <td class="total-column">
                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
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
            <div class="cart-footer">
                <h3 class="total-price">Total Price: ${{ number_format($order->total, 2) }}</h3>
            </div>

            <div class="back-to-shop">
                <a href="/shop/orders" class="btn btn-secondary">Back to orders</a>
            </div>
        </div>
    @endif
</div>