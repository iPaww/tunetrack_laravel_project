<form action="{{ route('appointment.update', $appointment->id) }}" method="POST">
    @csrf
    @method('POST') <!-- Use POST or PUT depending on your method for updating -->
    <div class="form-group">
        <label for="date">New Appointment Date:</label>
        <input type="date" name="date" class="form-control" value="{{ $appointment->selected_date }}">
    </div>
    <button type="submit" class="btn btn-primary">Update Appointment</button>
</form>
