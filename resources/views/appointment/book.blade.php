<div class="container mt-5" style="max-width: 600px; border: 2px solid #ddd; border-radius: 10px; padding: 30px; background-color: #f9f9f9;">
    <h1 class="text-center mb-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: black;">Appointment</h1>
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="order_id" class="form-label" style="font-weight: bold; color: #555;">Select Order:</label>
            <select id="order_id" name="order_id" class="form-select" style="border-radius: 8px; border: 1px solid #ddd; padding: 10px;">
                <option value="">Select Order</option>
                @foreach($orders as $order)
                    <optgroup label="Order ID: {{ $order->id }}">
                        @foreach($order->orderItems as $orderItem)
                            @if($orderItem->product) <!-- Ensure product exists -->
                                <option value="{{ $orderItem->product->id }}">
                                    {{ $orderItem->product->name }} (Quantity: {{ $orderItem->quantity }})
                                </option>
                            @else
                                <option value="" disabled>No Product</option>
                            @endif
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label" style="font-weight: bold; color: #555;">Select Date:</label>
            <input type="date" id="date" name="date" class="form-control" required style="border-radius: 8px; padding: 10px;">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<!-- Add some hover effect for the button -->
<style>
    .btn-primary:hover {
        background-color: #45a049;
    }
</style>
