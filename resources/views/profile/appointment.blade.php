<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">My Booked Tutorials:</h2>
</div>
<p class="text-danger">*note: please select Instruments to avoid rejection.</p>
<div class="row mb-4">
    @foreach ($appointments as $appointment)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow position-relative">
                <!-- Delete button as a small "X" in the top right corner -->
                <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST"
                    class="position-absolute top-0 end-0 p-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this appointment?')"
                        style="font-size: 16px; padding: 0 5px; border-radius: 50%; height: 30px; width: 30px;">
                        &times;
                    </button>
                </form>

                <div class="card-body">
                    <p><strong>Date:</strong>
                        {{ \Carbon\Carbon::parse($appointment->selected_date)->format('F j, Y') }}</p>
                    <p><strong>Status:</strong>
                        @if ($appointment->status == 're-book')
                            <span class="badge bg-secondary">Re-book</span>
                        @elseif ($appointment->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif ($appointment->status == 'accepted')
                            <span class="badge bg-success">Accepted</span>
                        @elseif ($appointment->status == 'declined' || $appointment->status == 'rejected')
                            <span class="badge bg-danger">Declined</span>
                        @endif
                    </p>

                    <!-- Display the product for the appointment -->
                    @if ($appointment->orderItems->isNotEmpty())
                        @php
                            $selectedProduct = $appointment->orderItems->first()->product;
                        @endphp
                        @if ($selectedProduct)
                            <h6><strong>Product:</strong> {{ $selectedProduct->name }}</h6>
                        @else
                            <h6><strong>Product:</strong> Not available</h6>
                        @endif
                    @else
                        <h6><strong>Product:</strong> Not linked to an order item</h6>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
