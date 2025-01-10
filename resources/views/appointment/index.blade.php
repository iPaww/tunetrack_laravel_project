<div class="container mt-5">
    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <a href="{{ url('profile/appointment') }}">View Booked Appointments</a>
        </div>
    @endif
    @if ($errors->any())
        <ul class="list-group my-2">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
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
                                    <option value="{{ $order->id }}:::{{ $orderItem->product->id  }}" >
                                        {{ $orderItem->product->name }}
                                    </option>
                                @endif
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
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
    $("#product_id").change(function(e){
        
        const target = $(e.target)
        const order_id_inp = $("input[name='order_id']")
        const product_id_inp = $("input[name='product_id']")

        const target_value = target.val()
        const [order_id,product_id] =target_value.split(":::")
        order_id_inp.val(order_id)
        product_id_inp.val(product_id)
    })
})
</script>