<div class="container">
    <h1 class="mb-4 text-center">USER APPOINTMENT AND SESSION</h1>

    <!-- Filter Dropdown for Appointments -->
    <div class="mb-4 d-flex justify-content-center">
        <form action="{{ route('admin.appointment.index') }}" method="GET" class="d-flex w-50">
            <div class="form-group w-75 me-2">
                <label for="status_filter" class="form-label">Filter by Appointment Status</label>
                <select name="status_filter" id="status_filter" class="form-select">
                    <option value="">All Appointments</option>
                    @foreach (['Pending', 'Accepted', 'Rejected', 'Reappoint'] as $status)
                        <option value="{{ $status }}" @selected(request('status_filter') == $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-25">Filter</button>
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
                                    @case('Accepted') badge-success text-dark font-weight-normal @break
                                    @case('Rejected') badge-danger text-dark font-weight-normal @break
                                    @case('Pending') badge-warning text-dark font-weight-normal @break
                                    @default badge-secondary text-dark font-weight-normal @break
                                @endswitch">
                                {{ $appointment->status }}
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
                                        <option value="rejected" @selected($appointment->status == 'rejected')>Reject</option>
                                        <option value="reappoint" @selected($appointment->status == 'reappoint')>Reappoint</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Success message after status update -->

</div>
