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
</style>

<div id="container" class="container d-flex flex-column align-items-center py-5">
    <div class="d-flex w-100 justify-content-evenly align-items-center">
        <div class="text-nowrap me-3">
            <span id="title-container">
                <a href="/" style="width: 5rem;">
                </a>
                <h1 class="ms-3">JCS SHOP</h1>
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

    <!-- navbar -->
    <nav id="menu" class="mt-3 mb-5 text-center">
        <a href="/shop/orders" class="btn btn-outline-dark border border-0 fw-bold mx-3">Orders</a>
        <a href="/shop/cart" class="btn btn-outline-dark border border-0 fw-bold mx-3">Cart</a>
    </nav>

    <main class="container">
        @if (count($items) > 0)
            <div class="row justify-content-center">
                @foreach ($items as $product)
                    <div class="col-md-4 col-sm-12 mb-1">
                        <a href="/shop/product/{{ htmlspecialchars($product->id) }}/view"
                            class="text-decoration-none text-dark">
                            <div class="card bg-light">
                                @if (file_exists(public_path($product->image)))
                                    <img src="{{ asset($product->image) }}" class="card-img-top"
                                        alt="{{ htmlspecialchars($product->name) }}" />
                                @else
                                    <img src="{{ asset('/assets/images/products/default_product.png') }}"
                                        class="card-img-top" alt="{{ htmlspecialchars($product->name) }}" />
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title text-center fw-bold">{{ htmlspecialchars($product->name) }}
                                    </h5>
                                    <p class="card-text text-center color-orange">₱
                                        {{ number_format($product->price, 2) }}</p>
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
    <!--end of shop container-->
</div>
