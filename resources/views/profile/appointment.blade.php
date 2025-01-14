<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Appointments:</h1>
    </div>
    <p class="text-danger">*note: please select Instruments to avoid rejection.</p>
    <div class="row mb-4">
        @forelse ($appointments as $appointment)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow position-relative">
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
                                <a href="{{ route('appointment.edit', $appointment->id) }}"
                                    class="btn btn-primary btn-sm mt-2">
                                    Re-schedule Appointment
                                </a>
                            @elseif ($appointment->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif ($appointment->status == 'accepted')
                                <span class="badge bg-success">Accepted</span>
                            @else
                                <span class="badge bg-danger">Declined</span>
                            @endif
                        </p>

                        @if ($appointment->product)
                            <h6><strong>Product:</strong> {{ $appointment->product->name ?? 'Not available' }}</h6>
                            <h6><strong>Product Type:</strong>
                                {{ $appointment->product->productType->name ?? 'Not available' }}</h6>
                        @else
                            <h6><strong>Product:</strong> Not linked to an order item</h6>
                        @endif

                        <h6><strong>Assigned Tutor:</strong>
                            {{ $appointment->assignedUser?->fullname ?? 'Not assigned' }}</h6>
                    </div>
                </div>
            </div>
        @empty
            <p>No appointments found.</p>
        @endforelse
    </div>
    {{ $appointments->links() }}
</div>
