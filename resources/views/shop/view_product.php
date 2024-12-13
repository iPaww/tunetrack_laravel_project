<div id="container" class="container d-flex flex-column align-items-center">
    <div class="d-flex w-100 justify-content-evenly align-items-center">
        <span id="title-container">
            <a href="index.php">
                <img class="img-fluid" id="logo" src="logo.png" alt="logo">
            </a>
            <h1>JCS SHOP</h1>
        </span>
        
        <div id="search-container">
            <span id="search-icon">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" id="search-input" placeholder="Search instruments...">
        </div>

        
    </div>

    <!-- navbar -->
    <nav id="menu" class="mt-3 text-center">
        <a href="orders_page.php" class="text-dark fw-bold text-decoration-none mx-3">Orders</a>
        <a href="cart.php" class="text-dark fw-bold text-decoration-none mx-3">Cart</a>
    </nav>

    <?php

    // Query both tables
    $sql = "SELECT 'instrument' AS type, model_id AS id, name, 
                   MIN(price) AS price, image 
            FROM instrument_models 
            GROUP BY name
            UNION ALL
            SELECT 'supply' AS type, supply_id AS id, name, 
                   MIN(price) AS price, image 
            FROM supplies 
            GROUP BY name";
    
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        echo '<main class="container">
                <div class="row justify-content-center">';
    
        while ($product = $result->fetch_assoc()) {
            $imagePath = "../inventory/uploads/" . htmlspecialchars($product['image']);
            if (!file_exists($imagePath)) {
                $imagePath = "../inventory/uploads/default.jpg"; // Default image if file is missing
            }
    
            // Display each product
            echo '<div class="col-md-4 mb-4">
                    <a href="product_details.php?type=' . htmlspecialchars($product['type']) . '&id=' . htmlspecialchars($product['id']) . '" class="text-decoration-none text-dark">
                        <div class="card">
                            <img src="' . $imagePath . '" class="img-fluid mt-3" alt="' . htmlspecialchars($product['name']) . '">
                            <div class="card-body">
                                <p class="card-text text-center fw-bold fs-4">' . htmlspecialchars($product['name']) . '</p>
                                <p class="card-text text-center color-orange">$ ' . number_format($product['price'], 2) . '</p>
                            </div>
                        </div>
                    </a>
                </div>';
        }
    
        echo '</div></main>';
    } else {
        echo '<p>No products found.</p>';
    }
    ?>
    <!--end of shop container-->

</div>