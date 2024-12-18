<style>
/* General Cart Styles */
.cart-container {
    max-width: 1100px;
    margin: 30px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
}

.cart-table th,
.cart-table td {
    padding: 15px;
    text-align: left;
    vertical-align: middle;
    font-family: 'Arial', sans-serif;
}

.cart-table th {
    background-color: #f1f1f1;
    font-weight: 600;
    color: #555;
}

.cart-table td {
    border-bottom: 1px solid #f1f1f1;
}

.product-info {
    display: flex;
    align-items: center;
}

.cart-image {
    margin-right: 10px;
    border-radius: 10px;
    width: 70px;
    height: 70px;
    object-fit: cover;
}

.price-column,
.total-column,
.actions-column {
    text-align: center;
    font-size: 1.1rem;
}

.quantity-column {
    text-align: center;
}

.update-btn {
    padding: 6px 12px;
    font-size: 1rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.update-btn:hover {
    background-color: #0056b3;
}

.remove-btn {
    background-color: #dc3545;
    color: white;
    padding: 6px 12px;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.remove-btn:hover {
    background-color: #c82333;
}

/* Cart Footer */
.cart-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #ddd;
}

.total-price {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

.checkout-btn {
    padding: 12px 25px;
    font-size: 1.2rem;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.checkout-btn:hover {
    background-color: #218838;
}

.back-to-shop {
    margin-top: 20px;
    text-align: center;
}

.btn-secondary {
    font-size: 1rem;
    padding: 10px 20px;
    background-color: #6c757d;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Update Form */
.update-form {
    display: inline-block;
    width: 100%;
}

.quantity-input {
    width: 60px;
    padding: 5px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Alert Styling */
.alert-warning {
    margin-top: 20px;
    text-align: center;
    font-size: 1.2rem;
    color: #856404;
    background-color: #fff3cd;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #ffeeba;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cart-table th, .cart-table td {
        padding: 10px;
    }

    .cart-footer {
        flex-direction: column;
        align-items: flex-start;
    }

    .checkout-btn {
        width: 100%;
        margin-top: 15px;
    }

    .back-to-shop a {
        width: 100%;
        display: inline-block;
        margin-top: 15px;
    }
}
</style>

<div class="container align-items-center min-vh-100 py-5">
    <h1 class="display-4">Your Shopping Cart</h1>
    
    <?php if (count($items) == 0): ?>
    <div class="alert alert-warning" role="alert">
        Your cart is empty.
    </div>
    <?php else: ?>
        <div class="cart-container">
            <table class="table cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td class="product-info">
                            <?php if ($item['product_name']): ?>
                                <img src="../inventory/uploads/<?php echo $item['product_image']; ?>" alt="<?php echo $item['product_name']; ?>" width="60" class="img-thumbnail cart-image">
                                <span><?php echo $item['product_name']; ?></span>
                            <?php elseif ($item['supply_name']): ?>
                                <img src="../inventory/uploads/<?php echo $item['supply_image']; ?>" alt="<?php echo $item['supply_name']; ?>" width="60" class="img-thumbnail cart-image">
                                <span><?php echo $item['supply_name']; ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="price-column">
                            <?php 
                            if ($item['product_name']) {
                                echo '$' . number_format($item['product_price'], 2);
                            } elseif ($item['supply_name']) {
                                echo '$' . number_format($item['supply_price'], 2);
                            }
                            ?>
                        </td>
                        <td class="quantity-column">
                            <?php if ($item['supply_name']): ?>
                                <form action="update_cart.php" method="POST" class="update-form">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" required class="form-control quantity-input">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                    <button type="submit" class="btn btn-primary update-btn">Update</button>
                                </form>
                            <?php else: ?>
                                <span>Not Applicable <br>(Because of uniqie Id)</span>
                            <?php endif; ?>
                        </td>
                        <td class="total-column">
                            <?php 
                            if ($item['product_name']) {
                                echo '$' . number_format($item['product_price'] * $item['quantity'], 2);
                            } elseif ($item['supply_name']) {
                                echo '$' . number_format($item['supply_price'] * $item['quantity'], 2);
                            }
                            ?>
                        </td>
                        <td class="actions-column">
                            <form action="remove_from_cart.php" method="POST">
                                <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                <button type="submit" class="btn btn-danger remove-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-footer">
                <h3 class="total-price">Total Price: $<?php echo number_format($total_price, 2); ?></h3>
                <form action="checkout.php" method="POST">
                    <button type="submit" class="btn btn-success checkout-btn">Proceed to Checkout</button>
                </form>
            </div>

            <div class="back-to-shop">
                <a href="/shop" class="btn btn-secondary">Back to Shopping</a>
            </div>
        </div>
    <?php endif; ?>
</div>