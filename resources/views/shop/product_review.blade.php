<style>
    .product-rating {
        span {
            cursor: pointer;
            transition: 0.2s;
            font-size: 2rem;
        }

        span:hover {
            filter: brightness(75%);
            transform: scale(1.2);
        }

        span:has(~ span:hover) {
            filter: brightness(75%);
        }
    }

    .product-rating span {
        transition: all 0.3s ease-in-out;
    }

    .btn-tunetrack {
        background-color: #6c757d;
        color: #fff;
        border-radius: 0.5rem;
        transition: background-color 0.3s ease-in-out;
    }

    .btn-tunetrack:hover {
        background-color: #495057;
    }

    .card-body {
        padding: 1.5rem;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card-body.row {
        align-items: center;
    }

    .product-rating span,
    .selected-product-rating span {
        transition: transform 0.3s ease-in-out;
    }

    .selected-product-rating {
        opacity: 0.8;
        margin-bottom: 10px;
    }

    .selected-product-rating span {
        color: #f39c12;
    }

    .form-control {
        border-radius: 0.5rem;
        padding: 1rem;
    }

    .alert-warning {
        border-radius: 10px;
    }

    .list-group-item-danger {
        background-color: #f8d7da;
    }

    .list-group-item-success {
        background-color: #d4edda;
    }

    .text-warning-emphasis {
        font-weight: bold;
        color: #f39c12;
    }

    h1 a {
        color: #333;
        text-decoration: none;
        font-weight: 600;
    }

    h1 a:hover {
        text-decoration: underline;
    }

    .col-md-4 {
        position: relative;
    }

    .card-body .img-fluid {
        border-radius: 0.75rem;
        transition: transform 0.3s ease-in-out;
    }

    .card-body .img-fluid:hover {
        transform: scale(1.05);
    }

    .alert-warning {
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
</style>

<div class="container align-items-center min-vh-100 py-5">
    <h1 class="text-center fs-1 mb-4"><b>Write Review</b></h1>
    @if (count($items) == 0)
        <div class="alert alert-warning" role="alert">
            Error occurred, no item(s) found.
        </div>
    @else
        <form class="d-inline" action="/shop/order/{{ $order->id }}/product-review" method="POST">
            @csrf
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
                <?php $counter = 0 + session()->get('start_with', 0) ?>
                @foreach( $items as $index => $item )
                    <?php $product_review = $item->product_review?->where('order_item_id', $item->id)?->where('user_id', session('id'))->first() ?>
                    <?php $hasProductReview = !!$product_review ?>
                    <div class="col-12 mb-5">
                        <div @class([
                            'card border-0' => true,
                            'bg-dark-subtle' => $hasProductReview,
                        ])>
                            <div class="card-body row">
                                <div class="col-12 col-md-4">
                                    @if ($item->image && file_exists(public_path($item->product->image)))
                                        <img src="{{ asset($item->product->image) }}" class="img-fluid border rounded" style="min-width: 100%" />
                                    @else
                                        <img src="{{ asset("storage/assets/image/product_image/default.png") }}" class="img-fluid border rounded" style="min-width: 100%" alt="{{ ($item->name) }}" />
                                    @endif
                                    @if( !$hasProductReview )
                                        <div>
                                            <div class="product-rating d-flex justify-content-around">
                                                <span class="text-warning fs-1 user-select-none" data-star="1">☆</span>
                                                <span class="text-warning fs-1 user-select-none" data-star="2">☆</span>
                                                <span class="text-warning fs-1 user-select-none" data-star="3">☆</span>
                                                <span class="text-warning fs-1 user-select-none" data-star="4">☆</span>
                                                <span class="text-warning fs-1 user-select-none" data-star="5">☆</span>
                                            </div>
                                            <h5 class="text-center fs-3 text-warning-emphasis">Rate this Product</h5>
                                        </div>
                                        <button class="btn btn-tunetrack w-100">Submit</button>
                                    @else
                                        <div>
                                            <div class="selected-product-rating d-flex justify-content-around" data-star="{{ $product_review->rating }}">
                                                <span class="text-warning fs-1 user-select-none">☆</span>
                                                <span class="text-warning fs-1 user-select-none">☆</span>
                                                <span class="text-warning fs-1 user-select-none">☆</span>
                                                <span class="text-warning fs-1 user-select-none">☆</span>
                                                <span class="text-warning fs-1 user-select-none">☆</span>
                                            </div>
                                            <h5 class="text-center fs-3 text-warning-emphasis">Rate this Product</h5>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 col-md-8">
                                    <h1><a href="/shop/product/{{ $item->product->id }}/view" class="text-decoration-none">{{ $item->product->name }}</a></h1>
                                    <h4>Color: {{ $item->color_name }}</h4>
                                    @if( !$hasProductReview )
                                        <div class="form-group">
                                            <input type="hidden" name="order_item_id[]" value="{{ $item->id }}"/>
                                            <input type="hidden" name="rating[]" value="{{ old('rating') ? old('rating')[$counter]:null }}"/>
                                            <textarea name="review[]" class="form-control" rows="10" placeholder="Add your review">{{ old('review') ? old('review')[$counter]:null }}</textarea>
                                        </div>
                                        <?php $counter++ ?>
                                    @else
                                        <div>
                                            You have submitted your review for this product, to view the products and reviews please <a href="/shop/product/{{ $item->product->id }}/view#product-review" class="text-decoration-none">click here</a>.
                                        </div>
                                        <div class="text-truncate fs-5">
                                            <p>❝{{ $product_review->review }}❞</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    @endif
</div>

<script>
$(document).ready(function() {
    const product_rating_container = $('.product-rating')
    const selected_product_rating_container = $('.selected-product-rating')

    selected_product_rating_container.change((e) => {
        const container = $(e.target)
        const star = parseInt( container.data('star') )
        $('span', container).text('☆')
        $('span', container).slice(0, star).each(function(index, item) {
            const span_2 = $(item)
            span_2.text('★')
        })
    })
    selected_product_rating_container.trigger('change')

    $('span', product_rating_container).click((e) => {
        const span = $(e.target)
        const card_body = span.closest('.card-body')
        const star = parseInt( span.data('star') )
        const rating_input = $('input[name="rating[]"]', card_body)
        rating_input.val( star ).trigger('change')
    });

    $('input[name="rating[]"]').change((e) => {
        const input = $(e.target)
        const card_body = input.closest('.card-body')
        const star = input.val()
        $('.product-rating span', card_body).text('☆')
        $('.product-rating span', card_body).slice(0, star).each(function(index, item) {
            const span_2 = $(item)
            span_2.text('★')
        })
    })

    $('input[name="rating[]"]').trigger('change')
})
</script>
