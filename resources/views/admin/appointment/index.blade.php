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

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Appointment Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Product(Tutoring)</th>
                    <th>Appointment Date</th>
                    <th>Appointment Status</th>
                    <th>Assigned User</th>
                    <th>Assign User (Role 2)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = ($appointments->currentPage() - 1) * $appointments->perPage() + 1; // Adjust counter for pagination
                @endphp
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $appointment->user->fullname }}</td>
                        <td>
                            @if($appointment->product)
                            <h6><strong>Product:</strong> {{ $appointment->product->name ?? 'Not available' }}</h6>
                            @endif
                        </td>
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
                        <td>{{ $appointment->assignedUser->fullname ?? 'Not Assigned' }}</td>
                        <!-- Combined Form for Assign User and Update Status -->
                        <td colspan="2">
                            <form action="{{ route('admin.appointment.update', $appointment->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <select name="selected_teacher" class="form-select">
                                        <option value="">Select Teacher</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" @selected($appointment->user_id == $teacher->id)>
                                                {{ $teacher->fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <select name="status" class="form-select">
                                        <option value="pending" @selected($appointment->status == 'pending')>Pending</option>
                                        <option value="accepted" @selected($appointment->status == 'accepted')>Accept</option>
                                        <option value="declined" @selected($appointment->status == 'declined')>Reject</option>
                                        <option value="re-book" @selected($appointment->status == 're-book')>Re-book</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Submit</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination Links -->
        {{ $appointments->links() }}
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
