<div class="container">
    <!-- Header with Filter -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
        <h2 class="mb-3 mb-md-0"><b>Appointments</b></h2>

        <!-- Filter Dropdown for Appointments -->
        <form action="{{ route('admin.appointment.index') }}" method="GET" class="d-flex flex-column flex-md-row">
            <div class="form-group me-2">
                <select name="status_filter" id="status_filter" class="form-select">
                    <option value="">All Appointments</option>
                    @foreach (['pending', 'accepted', 'rejected', 're-book'] as $status)
                        <option value="{{ $status }}" @selected(request('status_filter') == $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-2 mt-md-0">Filter</button>
        </form>
    </div>

    <!-- Notifications -->
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Appointment Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light text-center">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Contact #</th>
                    <th>Product (Tutoring)</th>
                    <th>Appointment Date</th>
                    <th>Appointment Status</th>
                    <th>Assigned User</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = ($appointments->currentPage() - 1) * $appointments->perPage() + 1;
                @endphp
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $appointment->user->fullname }}</td>
                        <td>{{ $appointment->user->email }}</td>
                        <td>{{ $appointment->user->phone_number }}</td>
                        <td>
                            @if ($appointment->product)
                                <strong>{{ $appointment->product->name ?? 'Not available' }}</strong>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($appointment->selected_date)->format('F j, Y') }}</td>
                        <td class="text-center">
                            <span
                                class="badge
                                @switch($appointment->status)
                                    @case('accepted') bg-success text-white @break
                                    @case('declined') bg-danger text-white @break
                                    @case('pending') bg-warning text-dark @break
                                    @case('re-book') bg-secondary text-white @break
                                    @default bg-light text-dark @break
                                @endswitch">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td>{{ $appointment->assignedUser->fullname ?? 'Not Assigned' }}</td>
                        <!-- Manage Actions -->
                        <td>
                            <form action="{{ route('admin.appointment.update', $appointment->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PUT')
                                <div class="mb-2">
                                    <select name="selected_teacher" class="form-select">
                                        <option value="">Select Teacher</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" @selected($appointment->user_id == $teacher->id)>
                                                {{ $teacher->fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <select name="status" class="form-select">
                                        <option value="pending" @selected($appointment->status == 'pending')>Pending</option>
                                        <option value="accepted" @selected($appointment->status == 'accepted')>Accept</option>
                                        <option value="declined" @selected($appointment->status == 'declined')>Reject</option>
                                        <option value="re-book" @selected($appointment->status == 're-book')>Re-book</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm w-100">Submit</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $appointments->links() }}
        </div>
    </div>
</div>

<script>
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (toggleSidebar) {
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('visible');
            content.classList.toggle('expanded');
        });
    }
</script>
