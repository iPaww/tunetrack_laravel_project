
<div class="container mt-5">
    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <a href="{{ url('profile/appointment') }}">View Booked Appointments</a>
        </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <!-- Booking form directly on the page -->
    <div class="booking-form-container">
        <h3 class="mb-3">Book a New Tutorial</h3>
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
                                    <option value="{{ $order->id }}:::{{ $orderItem->product->id }}" >
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
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        transition: 0.3s;
    }

    .position-absolute {
        position: absolute;
    }

    .top-0 {
        top: 0;
    }

    .end-0 {
        right: 0;
    }

    .p-2 {
        padding: 5px;
    }

    .booking-form-container {
        background-color: #f9f9f9;
        border: 2px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
    }

    .btn-primary:hover {
        background-color: #45a049;
    }
</style>

<script type="text/javascript">
$(document).ready(function(){
    // Ensure acceptedProductIds is defined or fallback to an empty array if not
    const acceptedProductIds = @json($acceptedProductIds ?? []);
    
    // Loop through all options and hide the ones that are already booked
    $("#product_id option").each(function() {
        const optionProductId = $(this).val().split(":::")[1]; // Extract the product ID from the option value
        if (acceptedProductIds.includes(parseInt(optionProductId))) {
            $(this).hide();  // Hide the option for the already booked product
        }
    });

    // Handle change event for product selection
    $("#product_id").change(function(e){
        const target = $(e.target);
        const order_id_inp = $("input[name='order_id']");
        const product_id_inp = $("input[name='product_id']");
        const target_value = target.val();
        const [order_id, product_id] = target_value.split(":::"); // Split the value to get order_id and product_id

        // Check if the selected product has already been booked
        if (acceptedProductIds.includes(parseInt(product_id))) {
            // Show error under the select box
            $(".product-error").text("This product has already been booked. Please choose a different product.");
            target.val("");  // Reset the selection if the product is already booked
            return;  // Exit to prevent further action
        }

        // Clear error message
        $(".product-error").text("");

        // Set the order ID and product ID inputs if no issues
        order_id_inp.val(order_id);  // Set the order ID input
        product_id_inp.val(product_id);  // Set the product ID input
    });

    // Client-side form validation before submitting
    $("form").submit(function(e) {
        const dateInput = $("#date").val();
        const productIdInput = $("input[name='product_id']").val();
        
        // Validate if the product is selected
        if (!productIdInput) {
            $(".product-error").text("Please select a product.");
            e.preventDefault();  // Prevent form submission
            return;
        } else {
            $(".product-error").text("");  // Clear the error message if product is selected
        }

        // Validate if the date is selected
        if (!dateInput) {
            $(".date-error").text("Please select a date.");
            e.preventDefault();  // Prevent form submission
            return;
        } else {
            $(".date-error").text("");  // Clear the error message if date is selected
        }

        // Optionally, you can also check if the selected date is a valid date (though HTML5 input handles this too)
        const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
        if (!dateRegex.test(dateInput)) {
            $(".date-error").text("Please select a valid date.");
            e.preventDefault();  // Prevent form submission
            return;
        }
    });
});
</script>
