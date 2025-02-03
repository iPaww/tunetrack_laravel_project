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

    /* Ensure the header is fixed to the top */
    #container {
        padding-top: 60px;
        /* Adjust padding to ensure header doesn't overlap with content */
    }

    /* Optional: If you want a fixed header */
    .header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        z-index: 9999;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    #search-container {
        flex-grow: 1;
        /* Adjust search container to grow if needed */
    }

    /* Enhanced Search Form Styling */
    .input-group .form-control {
        border-radius: 25px 0 0 25px;
        padding: 12px 20px;
        font-size: 1rem;
        border: 1px solid #ccc;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s ease-in-out;
    }

    .input-group .form-control:focus {
        border-color: #FC6A03;
        box-shadow: 0 0 5px rgba(252, 106, 3, 0.7);
    }

    .btn-primary {
        background-color: #FC6A03;
        border-color: #FC6A03;
        border-radius: 0 25px 25px 0;
        padding: 12px 30px;
        font-size: 1rem;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #bd4f02;
        border-color: #bd4f02;
    }

    /* Navbar Button Styling */
    .btn-outline-dark {
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: bold;
        font-size: 1rem;
        text-transform: uppercase;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-dark:hover {
        background-color: #FC6A03;
        color: white;
    }

    /* Ensure consistency in button sizes */
    .btn {
        min-width: 120px;
    }

    /* Card Enhancements */
    .card-body {
        padding: 20px;
        text-align: center;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
    }

    .color-orange {
        color: #FC6A03;
    }
    .discount-badge {
    background-color: #e63946; /* Red color */
    color: white;
    font-size: 0.9rem;
    font-weight: bold;
    border-radius: 10px;
    transform: translate(10px, -10px);
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
}
</style>

<div id="container" class="container d-flex flex-column align-items-center py-5">
    <div class="d-flex w-100 justify-content-evenly align-items-center">
        <div class="text-nowrap me-3">
            <span id="title-container">
                <a href="/" style="width: 5rem;">
                </a>
            </span>
        </div>
        <div id="search-container" class="input-group mb-3">
            <form action="{{ route('shop.search') }}" method="GET" class="d-flex w-100">
                <input type="text" name="query" class="form-control" placeholder="Search products..."
                    value="{{ request()->query('query') }}" aria-label="Search products">
                <button type="submit" class="btn btn-primary ms-2">Search</button>
            </form>
        </div>
    </div>

    <!-- Navbar -->
    <nav id="menu" class="mt-3 mb-5 text-center">
        <a href="/shop/orders" class="btn btn-outline-dark border border-0 fw-bold mx-3">Orders</a>
        <a href="/shop/cart" class="btn btn-outline-dark border border-0 fw-bold mx-3">Cart</a>
    </nav>

    <main class="container">
        @if (count($items) > 0)
            <div class="row justify-content-center">
                @foreach ($items as $product)
                <div class="col-md-4 col-sm-12 mb-1 mt-3">
                    <a href="/shop/product/{{ htmlspecialchars($product->id) }}/view" class="text-decoration-none text-dark">
                        <div class="card bg-light position-relative">
                            <!-- Discount Badge -->
                            @if ($product->discount > 0)
                                <span class="discount-badge position-absolute top-0 end-0 px-3 py-1">
                                    {{ number_format($product->discount, 0) }}% OFF
                                </span>
                            @endif
                
                            @if (file_exists(public_path($product->image)))
                                <img src="{{ asset($product->image) }}" class="card-img-top"
                                    alt="{{ htmlspecialchars($product->name) }}" />
                            @else
                                <img src="{{ asset('/assets/images/products/default_product.png') }}" class="card-img-top"
                                    alt="{{ htmlspecialchars($product->name) }}" />
                            @endif
                
                            <div class="card-body">
                                <h5 class="card-title text-center fw-bold">{{ htmlspecialchars($product->name) }}</h5>
                                <h5 class="card-title text-center fw-bold">{{ htmlspecialchars($product->brand->name) }}</h5>
                
                                <!-- Show original price with strikethrough if discount exists -->
                                @if ($product->discount > 0)
                                    <p class="text-center text-muted text-decoration-line-through">
                                        ₱{{ number_format($product->price, 2) }}
                                    </p>
                                @endif
                
                                <!-- Final Price -->
                                <p class="card-text text-center color-orange fw-bold">
                                    ₱{{ number_format($product->price - ($product->price * ($product->discount / 100)), 2) }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                <div class="col-12">
                    {{ $items->links() }}
                </div>
            </div>
        @else
            <p>No products found.</p>
        @endif
    </main>
    <!-- End of Shop Container -->
</div>
