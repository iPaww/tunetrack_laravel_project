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
        <div class="text-nowrap me-3">
            <span id="title-container">
                <a href="/" style="width: 5rem;">
                    <img class="img-fluid" src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                </a>
                <h1 class="ms-3">JCS SHOP</h1>
            </span>
        </div>
        <div id="search-container" class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
            <input class="form-control" type="text" id="search-input" placeholder="Search instruments...">
        </div>
    </div>

    <!-- navbar -->
    <nav id="menu" class="mt-3 mb-5 text-center">
        <a href="/shop/orders" class="btn btn-outline-dark border border-0 fw-bold mx-3">Orders</a>
        <a href="/shop/cart" class="btn btn-outline-dark border border-0 fw-bold mx-3">Cart</a>
    </nav>

    <main class="container">
        @if ( count( $items ) > 0 )
            <div class="row justify-content-center">
                @foreach ($items as $product)
                    <div class="col-md-4 col-sm-12 mb-1">
                        <a href="/shop/product/{{ htmlspecialchars($product->id) }}/view" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{ asset( "assets/images/inventory/uploads/" . htmlspecialchars($product->image)) }}"
                                    class="card-img-top"
                                    alt="{{ htmlspecialchars($product->name) }}"
                                />
                                <div class="card-body">
                                    <h5 class="card-title text-center fw-bold">{{ htmlspecialchars($product->name) }}</h5>
                                    <p class="card-text text-center color-orange">$ {{number_format($product->price, 2) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="position-relative" style="min-height: 10vh">
                <div class="position-absolute top-50 start-50 translate-middle">
                    {{ $items->links() }}
                <div>
            </div>
        @else
            <p>No products found.</p>
        @endif
    </main>
    <!--end of shop container-->
</div>