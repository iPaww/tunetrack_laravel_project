<div class="container my-4">
    <div class="d-flex justify-content-center align-items-center mb-3"> <!-- Change from justify-content-between to justify-content-center -->
        <h1 class="mb-0"><b>Booking</b></h1>
    </div>
    <div class="alert alert-warning d-flex align-items-center" role="alert" style="background-color: #fff3cd; border-left: 5px solid #ffc107; border-radius: 8px;">
        <i class="me-2" style="color: #856404; font-size: 1.2rem;" data-feather="alert-circle"></i>
        <span class="text-dark"><strong>Note:</strong> Please select instruments to avoid rejection.</span>
    </div>
    <div class="row mb-4">
        @forelse ($appointments as $appointment)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow position-relative border-0" style="border-radius: 15px; overflow: hidden;">
                    <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST" class="position-absolute top-0 end-0 p-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this appointment?')" style="font-size: 16px; padding: 0 5px; border-radius: 50%; height: 30px; width: 30px;">
                            &times;
                        </button>
                    </form>

                    <div class="card-body p-4" style="background: linear-gradient(to right, #f8f9fa, #e9ecef);">
                        <h5 class="mb-3 text-primary">
                            <i data-feather="calendar" class="me-2"></i> {{ \Carbon\Carbon::parse($appointment->selected_date)->format('F j, Y') }}
                        </h5>
                        <p><strong>Status:</strong>
                            @if ($appointment->status == 're-book')
                                <span class="badge bg-secondary">Re-book</span>
                                <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-outline-primary btn-sm mt-2">
                                    <i data-feather="edit" class="me-1"></i> Re-schedule Appointment
                                </a>
                            @elseif ($appointment->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif ($appointment->status == 'accepted')
                                <span class="badge bg-success">Accepted</span>
                            @else
                                <span class="badge bg-danger">Declined</span>
                            @endif
                        </p>

                        @if ($appointment->product)
                            <p class="mt-3">
                                <strong>Product:</strong> {{ $appointment->product->name ?? 'Not available' }}
                            </p>
                            <p>
                                <strong>Type:</strong> {{ $appointment->product->productType->name ?? 'Not available' }}
                            </p>
                        @else
                            <p class="mt-3"><strong>Product:</strong> Not linked to an order item</p>
                        @endif

                        <p class="mt-3">
                            <strong>Assigned Tutor:</strong>
                            <span class="text-muted">{{ $appointment->assignedUser?->fullname ?? 'Not assigned' }}</span>
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <p>No appointments found.</p>
        @endforelse
    </div>
    {{ $appointments->links() }}
</div>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>
