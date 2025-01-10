<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Reschedule Tutorial</h2>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <form action="{{ route('appointment.update', ['id' => $appointment->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="order_id" class="form-label"><strong>Current Product:</strong></label>
                            <input type="text" class="form-control" value="{{ $appointment->orderItems->first()->product->name ?? 'Not available' }}" disabled>
                            <input type="hidden" name="order_id" value="{{ $appointment->order_id }}">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label"><strong>Select New Date:</strong></label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>
                        <button type="submit" 
                            class="btn btn-primary"
                            style="background-color: #4CAF50; 
                                   border: none;
                                   padding: 8px 16px;
                                   border-radius: 4px;
                                   color: white;
                                   text-decoration: none;
                                   transition: background-color 0.3s ease;">
                            Update Appointment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #4CAF50 !important;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        color: white;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #45a049 !important;
    }

    .form-select, .form-control {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 8px;
        transition: all 0.3s ease;
    }

    .form-select:focus, .form-control:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        outline: none;
    }

    .form-label {
        color: #333;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .shadow {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
    }

    .badge {
        padding: 0.5em 1em;
        font-weight: 500;
    }
</style>
