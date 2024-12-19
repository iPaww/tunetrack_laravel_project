<style>
    #logo {
        width: 50px;
        height: auto;
    }
    #title-container {
        display: flex;
        align-items: center;
    }
    #title-container h1 {
        margin-left: 10px;
        font-size: 24px;
    }
    img {
        width: 200px;
        height: auto;
    }
    .card {
        height: 350px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .card img {
        max-height: 200px;
        object-fit: cover;
    }
</style>

<div id="container" class="container d-flex flex-column align-items-center py-5">
    <div class="d-flex w-100 justify-content-evenly align-items-center">
        <span id="title-container">
            <a href="index.php">
                <img class="img-fluid" id="logo" src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
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
        <a href="/shop/orders" class="text-dark fw-bold text-decoration-none mx-3">Orders</a>
        <a href="/shop/cart" class="text-dark fw-bold text-decoration-none mx-3">Cart</a>
    </nav>

    <main class="container">
        @if ( count( $items ) > 0 )
            <div class="row justify-content-center">
                @foreach ($items as $product)
                    <div class="col-md-4 mb-4">
                        <a href="/shop/product/{{ htmlspecialchars($product['model_id']) }}/view" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{ asset( "assets/images/inventory/uploads/" . htmlspecialchars($product['image'])) }}" class="img-fluid mt-3" alt="{{ htmlspecialchars($product['name']) }}">
                                <div class="card-body">
                                    <p class="card-text text-center fw-bold fs-4">{{ htmlspecialchars($product['name']) }}</p>
                                    <p class="card-text text-center color-orange">$ {{number_format($product['price'], 2) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p>No products found.</p>
        @endif
        
    </main>
    <!--end of shop container-->

</div>