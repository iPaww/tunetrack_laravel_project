<div class="container mt-5">
    <h2>My Appointments:</h2>
    @foreach($appointments as $appointment)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->selected_date)->format('F j, Y') }}</p>
                <p><strong>Status:</strong> 
                    @if ($appointment->status == 're-book')
                        <span class="badge bg-secondary">Re-book</span>
                    @elseif ($appointment->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif ($appointment->status == 'accepted')
                        <span class="badge bg-success">Accepted</span>
                    @elseif ($appointment->status == 'declined')
                        <span class="badge bg-danger">Declined</span>
                    @elseif ($appointment->status == 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </p>

                <!-- Display order items if they exist -->
                @foreach($appointment->orderItems as $orderItem)
                    @if($orderItem->product)
                        <p><strong>Product:</strong> {{ $orderItem->product->name }} (Quantity: {{ $orderItem->quantity }})</p>
                    @endif
                @endforeach

                <!-- Re-booking button if status is 're-book' -->
                @if ($appointment->status == 're-book')
                    <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-warning">Re-book</a>
                @endif
            </div>
        </div>
    @endforeach

    <a href="{{ route('appointment.book') }}" class="btn btn-primary">Book new appointment</a>
</div>

<style>
    .btn-primary:hover {
        background-color: #45a049;
    }
</style>
