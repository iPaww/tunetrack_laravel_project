<style>
.product-rating {
    span {
        cursor: pointer;
        transition: 0.2s;
    }

    span:hover {
        filter: brightness(50%);
    }
    
    span:has(~ span:hover) {
        filter: brightness(50%);
    }
}

</style>

<div class="container align-items-center min-vh-100 py-5">
    <h1 class="text-center fs-1"><b>Write Review</b></h1>
    @if (count($items) == 0)
    <div class="alert alert-warning" role="alert">
        Error occured no item(s) found.
    </div>
    @else
        <form class="d-inline" action="/shop/order/{{ $order->id }}/product-review" method="POST">
            @csrf <!-- {{ csrf_field() }} -->
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