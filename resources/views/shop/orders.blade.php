<div class="container mt-5 min-vh-100">
    <h2>Your Orders (Receipt)</h2>
    
    <div class="mt-4">
        @if ( count($items) > 0 )
            @foreach ($items as $row)
                <p>
                    <a href="/shop/order/{{ $row['id'] }}/view">Order #{{ $row['id'] }} - {{ date("F j, Y, g:i a", strtotime($row['order_date'])) }}</a>
                </p>
            @endforeach
        @else
            <p>You have no orders yet.</p>
        @endif
    </div>

    <div class="mt-3">
        <a href="/shop" class="btn btn-primary">Back to Homepage</a>
    </div>
</div>