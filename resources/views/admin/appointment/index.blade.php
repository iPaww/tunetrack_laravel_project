<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><b>Appointment</b></h2>

        <!-- Filter Dropdown for Appointments -->
        <form action="{{ route('admin.appointment.index') }}" method="GET" class="d-flex">
            <!-- Dropdown for Appointment Status -->
            <div class="form-group me-2">
                <select name="status_filter" id="status_filter" class="form-select">
                    <option value="">All Appointments</option>
                    @foreach (['pending', 'accepted', 'rejected', 're-book'] as $status)
                        <option value="{{ $status }}" @selected(request('status_filter') == $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Filter Button -->
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>

    <!-- Appointment Table -->
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Appointment Date</th>
                    <th>Appointment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $appointment->user->fullname }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->selected_date)->format('F j, Y') }}</td>
                        <td>
                            <span
                                class="badge
                                @switch($appointment->status)
                                    @case('accepted') badge-success text-dark font-weight-normal @break
                                    @case('declined') badge-danger text-dark font-weight-normal @break
                                    @case('pending') badge-warning text-dark font-weight-normal @break
                                    @case('re-book') badge-secondary text-dark font-weight-normal @break
                                    @default badge-secondary text-dark font-weight-normal @break
                                @endswitch">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td>
                            <!-- Appointment Status Change Form (Inline) -->
                            <form action="{{ route('admin.appointment.update', $appointment->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <select name="status" class="form-select">
                                        <option value="pending" @selected($appointment->status == 'pending')>Pending</option>
                                        <option value="accepted" @selected($appointment->status == 'accepted')>Accept</option>
                                        <option value="declined" @selected($appointment->status == 'declined')>Reject</option>
                                        <option value="re-book" @selected($appointment->status == 're-book')>Re-book</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                            </form>
                            {{-- <!-- Re-book Button (Visible only if status is 're-book') -->
                            @if ($appointment->status == 're-book')
                                <form action="{{ route('appointments.rebook', $appointment->id) }}" method="POST" class="d-inline-block mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Re-book</button>
                                </form>
                            @endif --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
