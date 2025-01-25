<div class="container mt-5">
    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert" style="background-color: #d4edda; border-left: 5px solid #28a745; border-radius: 8px;">
            <i class="me-2" style="color: #155724;" data-feather="check-circle"></i>
            <span class="text-success">{{ session('success') }}</span>
            <a href="{{ url('profile/appointment') }}" class="ms-3 text-success text-decoration-none">View Booked Appointments</a>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center" role="alert" style="background-color: #f8d7da; border-left: 5px solid #dc3545; border-radius: 8px;">
            <i class="me-2" style="color: #721c24;" data-feather="alert-triangle"></i>
            <span class="text-danger">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Booking form directly on the page -->
    <div class="booking-form-container">
        <h3 class="mb-3 text-center">Book a New Tutorial</h3>
        <form action="{{ route('appointment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id">
            <input type="hidden" name="product_id">
            <div class="mb-3">
                <label for="product_id" class="form-label">Select Order:</label>
                <select id="product_id" class="form-select">
                    <option value="">Select Order</option>
                    @foreach ($orders as $order)
                        <optgroup label="Order ID: {{ $order->id }}">
                            @foreach ($order->orderItems as $orderItem)
                                @if ($orderItem->product)
                                    <option value="{{ $order->id }}:::{{ $orderItem->product->id }}">
                                        {{ $orderItem->product->name }}
                                    </option>
                                @endif
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Select Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
            <div class="product-error text-danger mt-2"></div>
            <div class="date-error text-danger mt-2"></div>
        </form>
    </div>
</div>

<style>
    .alert {
        border-radius: 8px;
        padding: 15px;
        font-size: 1rem;
    }

    .booking-form-container {
        background-color: #f9f9f9;
        border: 2px solid #ddd;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .booking-form-container h3 {
        font-size: 1.8rem;
        font-weight: 600;
        color: #333;
    }

    .form-label {
        font-weight: 500;
        color: #555;
    }

    .form-select, .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        transition: border 0.3s ease;
    }

    .form-select:focus, .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px;
        border-radius: 8px;
        font-size: 1.1rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .product-error, .date-error {
        font-size: 0.875rem;
    }
</style>

<script type="text/javascript">
$(document).ready(function(){
    const acceptedProductIds = @json($acceptedProductIds ?? []);

    // Loop through all options and hide the ones that are already booked
    $("#product_id option").each(function() {
        const optionProductId = $(this).val().split(":::")[1];
        if (acceptedProductIds.includes(parseInt(optionProductId))) {
            $(this).hide();  // Hide the option for the already booked product
        }
    });

    $("#product_id").change(function(e){
        const target = $(e.target);
        const order_id_inp = $("input[name='order_id']");
        const product_id_inp = $("input[name='product_id']");
        const target_value = target.val();
        const [order_id, product_id] = target_value.split(":::");

        // Check if the selected product has already been booked
        if (acceptedProductIds.includes(parseInt(product_id))) {
            $(".product-error").text("This product has already been booked. Please choose a different product.");
            target.val("");
            return;
        }

        $(".product-error").text("");
        order_id_inp.val(order_id);
        product_id_inp.val(product_id);
    });

    $("form").submit(function(e) {
        const dateInput = $("#date").val();
        const productIdInput = $("input[name='product_id']").val();

        if (!productIdInput) {
            $(".product-error").text("Please select a product.");
            e.preventDefault();
            return;
        } else {
            $(".product-error").text("");
        }

        if (!dateInput) {
            $(".date-error").text("Please select a date.");
            e.preventDefault();
            return;
        } else {
            $(".date-error").text("");
        }

        const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
        if (!dateRegex.test(dateInput)) {
            $(".date-error").text("Please select a valid date.");
            e.preventDefault();
            return;
        }
    });
});
</script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>

