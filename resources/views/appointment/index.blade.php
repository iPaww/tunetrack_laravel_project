<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">My Booked Tutorials:</h2>
        <a href="{{ route('appointment.book') }}" class="btn btn-primary">Book new Tutorial</a>
    </div>

    <div class="row">
        @foreach($appointments as $appointment)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow position-relative">
                    <!-- Delete button as a small "X" in the top right corner -->
                    <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" class="position-absolute top-0 end-0 p-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this appointment?')" style="font-size: 16px; padding: 0 5px; border-radius: 50%; height: 30px; width: 30px;">
                            &times;
                        </button>
                    </form>

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
                                <h6><strong>Product:</strong> {{ $orderItem->product->name }} <!--(Quantity: {{ $orderItem->quantity }})--></h6>
                            @endif
                        @endforeach

                        <!-- Re-booking button if status is 're-book' -->
                        @if ($appointment->status == 're-book')
                            <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-warning">Re-book</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</div>
{{ $appointments->links() }}

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .card:hover {
        transform: translateY(-5px);
        transition: 0.3s;
    }

    /* Additional custom styles for the delete button */
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
</style>
