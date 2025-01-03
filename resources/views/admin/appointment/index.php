<div class="container mt-5">
    <h1 class="mb-4">User Appointments and Sessions</h1>

    <!-- Filter Dropdown for Appointments -->
    <form action="{{ route('admin.appointment.index') }}" method="GET" class="mb-3">
        <div class="form-group">
            <label for="status_filter">Filter by Appointment Status</label>
            <select name="status_filter" id="status_filter" class="form-select">
                <option value="">All Appointments</option>
                @foreach(['Pending', 'Accepted', 'Rejected', 'Reappoint'] as $status)
                    <option value="{{ $status }}" @selected(request('status_filter') == $status)>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-secondary mt-2">Filter</button>
    </form>

    <!-- Appointment Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Appointment Date</th>
                <th>Appointment Status</th>
                <th>Session Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ $appointment->user->name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>
                        <span class="badge 
                            @switch($appointment->status)
                                @case('Accepted') badge-success @break
                                @case('Rejected') badge-danger @break
                                @case('Pending') badge-warning @break
                                @default badge-secondary @break
                            @endswitch">
                            {{ $appointment->status }}
                        </span>
                    </td>
                    <td>
                        @if($appointment->status == 'Accepted')
                            @if($appointment->session)
                                <span class="badge 
                                    @switch($appointment->session->status)
                                        @case('Ongoing') badge-success @break
                                        @case('Completed') badge-primary @break
                                        @case('Cancelled') badge-danger @break
                                        @default badge-secondary @break
                                    @endswitch">
                                    {{ $appointment->session->status }}
                                </span>
                            @else
                                <span class="badge badge-secondary">No Session</span>
                            @endif
                        @else
                            <span class="badge badge-secondary">No Session</span>
                        @endif
                    </td>
                    <td>
                        <!-- Appointment Status Change Form -->
                        <form action="{{ route('admin.appointment.update', $appointment->id) }}" method="POST" class="mb-2">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <select name="status" class="form-select">
                                    @foreach(['Pending', 'Accepted', 'Rejected', 'Reappoint'] as $status)
                                        <option value="{{ $status }}" @selected($appointment->status == $status)>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update Status</button>
                        </form>

                        <!-- Start a Session if Accepted and No Session Exists -->
                        @if($appointment->status == 'Accepted' && !$appointment->session)
                            <form action="{{ route('admin.session.start', $appointment->user->id) }}" method="POST" class="mb-2">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">Start Session</button>
                            </form>
                        @endif

                        <!-- End or Cancel Session if Ongoing -->
                        @if($appointment->session && $appointment->session->status == 'Ongoing')
                            <form action="{{ route('admin.session.end', $appointment->session->id) }}" method="POST" class="mb-2">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary w-100">End Session</button>
                            </form>
                            <form action="{{ route('admin.session.cancel', $appointment->session->id) }}" method="POST" class="mb-2">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger w-100">Cancel Session</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
