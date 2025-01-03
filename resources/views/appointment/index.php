<div class="container mt-5" style="max-width: 600px; border: 2px solid #ddd; border-radius: 10px; padding: 30px; background-color: #f9f9f9;">
    <h1 class="text-center mb-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: black;">Appointment</h1>
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="bought_item" class="form-label" style="font-weight: bold; color: #555;">Select bought:</label>
            <select id="bought_item" name="bought_item" class="form-select" style="border-radius: 8px; border: 1px solid #ddd; padding: 10px;">
                <option value="item1">Item 1</option>
                <option value="item2">Item 2</option>
                <!-- Add more options here -->
            </select>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label" style="font-weight: bold; color: #555;">Select date:</label>
            <input type="date" id="date" name="date" class="form-control" required style="border-radius: 8px; padding: 10px;">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Add some hover effect for the button -->
<style>
    .btn-primary:hover {
        background-color: #45a049;
    }
</style>
