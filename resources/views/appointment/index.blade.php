<div class="container mt-5">
    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <a href="{{ url('profile/appointment') }}">View Appointments</a>
        </div>
    @endif

    <!-- Booking form directly on the page -->
    <div class="booking-form-container">
        <h3 class="mb-3">Book a New Tutorial</h3>
        <form action="{{ route('appointment.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="order_id" class="form-label">Select Order:</label>
                <select id="order_id" name="order_id" class="form-select">
                    <option value="">Select Order</option>
                    @foreach ($orders as $order)
                        <optgroup label="Order ID: {{ $order->id }}">
                            @foreach ($order->orderItems as $orderItem)
                                @if ($orderItem->product)
                                    <option value="{{ $orderItem->product->id }}">
                                        {{ $orderItem->product->name }}
                                    </option>
                                @endif
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Select Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    {{ $appointments->links() }}
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        transition: 0.3s;
    }

    .position-absolute {
        position: absolute;
    }

    .top-0 {
        top: 0;
    }

    .end-0 {
        right: 0;
    }

    .p-2 {
        padding: 5px;
    }

    .booking-form-container {
        background-color: #f9f9f9;
        border: 2px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
    }

    .btn-primary:hover {
        background-color: #45a049;
    }
</style>
