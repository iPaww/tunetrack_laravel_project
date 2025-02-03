<style>
    .price-text {
        color: #FF5A00;
        font-weight: bold;
    }

    .select-payment {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .select-payment:hover {
        background-color: #e0e0e0;
        transform: translateY(-2px);
    }

    .select-payment:active {
        background-color: #ccc;
        transform: translateY(0);
    }

    .btn-checkout {
        background-color: #FF5A00;
        border-color: #FF5A00;
        width: 100%;
        padding: 15px;
        font-size: 1.1rem;
        text-transform: uppercase;
    }

    .btn-checkout:hover {
        background-color: #e34a00;
        border-color: #e34a00;
    }

    .btn-checkout:active {
        background-color: #b73800 !important;
        border-color: #b73800 !important;
    }

    .policy-section {
        padding: 25px;
        background-color: #f3f3f3;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .policy-title {
        font-size: 1.6rem;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .policy-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }

    .policy-content .text-danger {
        font-weight: bold;
        color: #d9534f;
    }

    .alert-custom {
        padding: 18px;
        border-radius: 10px;
        margin-top: 20px;
    }

    .alert-warning-custom {
        background-color: #f39c12;
        color: white;
    }

    .alert-success-custom {
        background-color: #2ecc71;
        color: white;
    }

    .alert-danger-custom {
        background-color: #e74c3c;
        color: white;
    }

    .quantity-inp {
        max-width: 70px;
        text-align: center;
    }

    .btn-update {
        display: none;
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        padding: 5px 10px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-update:disabled {
        background-color: #ccc;
        border-color: #ccc;
        cursor: not-allowed;
    }

    .btn-update:hover {
        background-color: #218838;
    }

    .btn-update:active {
        background-color: #1e7e34;
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: bold;
    }

    .product-title {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .product-description {
        font-size: 1rem;
        color: #777;
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: bold;
        color: #FF5A00;
    }
    /* Enhanced Policy Section */
.policy-section {
    padding: 30px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 25px;
    border: 1px solid #f1f1f1;
}

.policy-title {
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 15px;
    color: #333;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.policy-content {
    font-size: 1.1rem;
    color: #555;
    line-height: 1.6;
}

.policy-section .icon-container {
    display: inline-flex;
    align-items: center;
    margin-right: 10px;
}

.policy-section .icon-container i {
    font-size: 1.3rem;
    margin-right: 5px;
    color: #FF5A00;
}

.text-danger {
    font-weight: bold;
    color: #e74c3c;
}

/* Styling for the policy card */
.card-policy {
    border: 1px solid #eee;
    border-radius: 10px;
    margin-bottom: 15px;
    padding: 15px;
    transition: all 0.3s ease;
}

.card-policy:hover {
    border-color: #FF5A00;
    transform: translateY(-5px);
}

.card-policy .policy-card-title {
    font-size: 1.4rem;
    font-weight: 500;
    color: #333;
}

.card-policy .policy-card-description {
    font-size: 1rem;
    color: #777;
}

</style>

<div class="container align-items-center min-vh-100 py-5">
    <div class="mb-3">
        <a href="/shop" class="btn btn-outline-dark border border-0 fw-bold">&laquo; Back to shop</a>
    </div>
    <div class="row mb-4">
        <!-- Shipping Policy -->
        <div class="col-md-6">
            <div class="policy-section">
                <div class="icon-container">
                    <i class="fas fa-shipping-fast"></i> 
                    <h2 class="policy-title">Shipping Policy</h2>
                </div>
                <p class="policy-content">The estimated processing time for the item is 3-7 days. Please wait for the shop confirmation before proceeding with the order.</p>
            </div>
        </div>
        <!-- Return and Refund Policy -->
        <div class="col-md-6">
            <div class="policy-section">
                <div class="icon-container">
                    <i class="fas fa-sync-alt"></i> 
                    <h2 class="policy-title">Return and Refund Policy</h2>
                </div>
                <p class="policy-content text-danger">The item is non-refundable, but we allow color exchanges within 1 week from the date of purchase.</p>
            </div>
        </div>
    </div>
    <h1 class="display-4 mb-4">Your Shopping Cart</h1>
    <div>
        @if ($errors->any())
            <ul class="list-group my-2">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if (session()->get('data'))
            <ul class="list-group my-2">
                @foreach (session()->get('data') as $data)
                    <li class="list-group-item list-group-item-success">{{ $data }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="row">
        <div class="col-md-8">
            @if (count($items) == 0)
                <div class="alert alert-warning" role="alert">
                    Your cart is empty.
                </div>
            @else
                <div class="row">
                    @php
                        $subtotal = 0;
                        $totalDiscount = 0;
                    @endphp
                    @foreach ($items as $item)
                    @php
                            $originalPrice = $item->price * $item->quantity;
                            $discountAmount = ($item->discount / 100) * $originalPrice;
                            $finalPrice = $originalPrice - $discountAmount;

                            $subtotal += $finalPrice;
                            $totalDiscount += $discountAmount;
                        @endphp
                        <div class="col-12 row mb-1 py-3">
                            <div class="col-3">
                                <a href="/shop/product/{{ $item->product_id }}/view" class="text-decoration-none w-100">
                                    @if (file_exists(public_path($item->image)))
                                        <img src="{{ asset($item->image) }}" class="img-fluid border rounded" alt="{{ htmlspecialchars($item->name) }}" />
                                    @else
                                        <img src="{{ asset('/assets/images/products/default_product.png') }}" class="img-fluid border rounded" alt="{{ htmlspecialchars($item->name) }}" />
                                    @endif
                                </a>
                            </div>

                            <div class="col-9 row">
                                <div class="col-5 row">
                                    <div class="col-12">
                                        <a href="/shop/product/{{ $item->product_id }}/view" class="fw-bold fs-5 text-decoration-none">{{ $item->name }}</a>
                                    </div>
                                    <div class="col-12">Color: {{ $item->color_name }}</div>
                                    <div class="col-12 text-muted">Discount: {{ $item->discount }}%</div>
                                </div>
                                <div class="col-7 pt-4 position-relative">
                                    <form action="/shop/cart/edit/{{ $item->id }}" method="POST">
                                        @csrf
                                        <div class="d-flex">
                                            <span class="my-auto me-1">Qty:</span>
                                            <div class="input-group flex-nowrap">
                                                <button type="button" class="quantity-minus-btn btn btn-sm btn-outline-secondary">-</button>
                                                <input type="number" class="quantity-inp form-control" name="quantity" min="1" max="999" value="{{ $item->quantity }}" data-original-value="{{ $item->quantity }}" style="min-width: 2em;" />
                                                <button type="button" class="quantity-plus-btn btn btn-sm btn-outline-secondary">+</button>
                                                <button type="submit" class="btn btn-sm btn-primary update-btn" disabled>Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="my-auto me-1 price-text text-end w-100 mt-2">
                                        @if ($discountAmount > 0)
                                            <s class="text-muted">₱{{ number_format($originalPrice, 2) }}</s>
                                        @endif
                                        <strong>₱{{ number_format($finalPrice, 2) }}</strong>
                                    </div>
                                    <form action="/shop/cart/remove/{{ $item->cart_id }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger border-0 rounded-circle position-absolute top-0 end-0 me-2" style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .3rem;">X</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">{{ $items->links() }}</div>
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-12">
                    <h1 class="fw-bold">Select Payment Method</h1>
                </div>
                <div class="col-12 mb-1">
                    <div class="card select-payment">
                        <div class="card-body position-relative">
                            <div class="card-title">Cash</div>
                            <small class="text-muted">Pay when you receive</small>
                            <input type="radio" name="payment_method_slc" class="form-check-input position-absolute end-0 top-50 translate-middle" checked>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-2">
                    <div class="card bg-dark-subtle">
                        <div class="card-body position-relative">
                            <div class="card-title">GCash (not available)</div>
                            <small class="text-muted">Pay now and get the item in shop</small>
                            <input type="radio" name="payment_method_slc" class="form-check-input position-absolute end-0 top-50 translate-middle" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center mt-3">
                    <input type="checkbox" id="termsCheckbox"> 
                    <label for="termsCheckbox">I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Terms and Conditions</a></label>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Terms and Conditions:</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                1. Consent: The users agree to partake in providing their feedback and insights regarding the functionality and effectiveness of the web-based e-learning platform for JCS Music Store by participating in this study.
                                <br><br>2. Confidentiality: Any personal information collected during the course of the study shall be kept confidential and used exclusively for research purposes. No participant shall be identified in the reports or publication that derive from the study.
            
                                <br><br>3. Data Use: All collected information for the study will be used for research purposes only and will not be transferred to any third party without permission from the respondents.
            
                                <br><br>4. System Feedback: The participants are asked to give honest and constructive feedback regarding the e-learning platform and ordering system. This will help in improving the platform further as well as the experience of the users.
            
                                <br><br>5. Compliance: Participants are expected to follow guidelines and instructions given by researchers for the study. Misuse of the platform and any term condition violation may lead to disqualification from the study.
            
                                <br><br>6. Ownership: The entire developed system comprising all its parts and functionalities is owned by JCS Music Store. The participants agree that they are only offering feedback and insights that would help develop the platform to become a better one.
            
                                <br><br>7. Liability: Neither the researchers nor the JCS Music Store will be held responsible or liable for any problem or damages caused due to participation in the study. Participants take their risk by participating voluntarily.
            
                                <br><br>8. Contact Information: Participants may contact the researchers in case any kind of query or issues emerge regarding this study. The researches would make best efforts to answer the queries as early as possible and further assistance shall be provided when needed.
            
                                <br><br>By accepting to participate in this study, participants affirm that they have read, understood, and agreed to the conditions listed above.
                                </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got it!</button>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h1 class="fw-bold">Order Summary</h1>
                    <div class="row">
                        <div class="col-6">Sub total</div>
                        <div class="col-6 text-end">₱ {{ number_format($total_price, 2) }}</div>
                        
                        @if (isset($totalDiscount) && $totalDiscount > 0)
                            <div class="col-6">Total Discount</div>
                            <div class="col-6 text-end text-danger">-₱{{ number_format($totalDiscount, 2) }}</div>
                        @endif
                        <div class="col-6">
                            <h4 class="fw-bold">Total</h4>
                        </div>
                        <div class="col-6 text-end fw-bold">₱{{ number_format(isset($subtotal) && $subtotal > 0 , 2) }}</div>
                        <div class="col-12 text-center mt-4">
                            <form action="/shop/cart/check_out" method="POST">
                                @csrf
                                <input type="hidden" name="payment_method" value="1" />
                                <button id="checkoutButton" class="btn btn-xl btn-primary btn-checkout w-75" disabled>PLACE ORDER NOW</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById('termsCheckbox').addEventListener('change', function() {
            document.getElementById('checkoutButton').disabled = !this.checked;
        });

    $(document).ready(function() {
        let max_quantity = 999;
        $('.quantity-inp').on('input', function() {
            const input = $(this);
            const update_btn = input.parent().find('.update-btn');
            const value = parseInt(input.val());
            const original_value = parseInt(input.data('original-value'));
            if (value > max_quantity)
                input.val(max_quantity);
            else if (value < 1)
                input.val(1);
            if (original_value != value) {
                input.addClass('bg-warning-subtle');
                update_btn.prop('disabled', false);
            } else {
                input.removeClass('bg-warning-subtle');
                update_btn.prop('disabled', true);
            }
        });
        $('.quantity-minus-btn').click((e) => {
            const current_btn = $(e.target);
            const input_target = current_btn.parent().find('.quantity-inp');
            const current_value = parseInt(input_target.val()) || 0;
            input_target.val(current_value - 1).trigger('input');
        });
        $('.quantity-plus-btn').click((e) => {
            const current_btn = $(e.target);
            const input_target = current_btn.parent().find('.quantity-inp');
            const current_value = parseInt(input_target.val()) || 0;
            input_target.val(current_value + 1).trigger('input');
        });
    });
</script>
