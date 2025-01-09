<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Cart;
use App\Models\Colors;
use App\Models\InstrumentCategory;
use App\Models\InventoryProducts;
use App\Models\InventorySupplies;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Products;
use App\Models\ProductReview;
use App\Models\Supplies;
use App\Http\Controllers\BasePageController;

class ShopController extends BasePageController
{
    public string $page_title = "JCS Store";
    public string $base_file_path = 'shop.';
    public $order_statuses = [
        1 => 'Pending',
        2 => 'Proccessing',
        3 => 'Delivered',
        4 => 'Cancelled',
    ];
    public $payment_methods = [
        1 => 'Cash',
        2 => 'Gcash'
    ];

    public function index()
    {
        $shop_items = Products::orderBy('created_at')
            ->orderBy('name')
            ->paginate(12);

        return $this->view_basic_page( $this->base_file_path . 'index', [
            'items' => $shop_items,
        ]);
    }

    public function orders()
    {
        $orders = Orders::where('user_id', session('id'))
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return $this->view_basic_page( $this->base_file_path . 'orders', [
            'orders' => $orders,
            'statuses' => $this->order_statuses,
        ]);
    }

    public function order_view( $order_id )
    {
        $order = Orders::where('id', $order_id)
            ->first();

        $order_item = OrderItems::select(
                'orders_item.*',
                OrderItems::raw('COUNT(inventory_products.id) as product_quantity'),
                OrderItems::raw('GROUP_CONCAT(inventory_products.serial_number) as serial_numbers'),
                OrderItems::raw('GROUP_CONCAT(colors.name) as color_names'),
            )
            ->where('order_id', $order_id)
            ->join('products', 'products.id', '=', 'orders_item.product_id')
            ->leftJoin(OrderItems::raw('inventory_products'), function (JoinClause $join) {
                    $join->on('orders_item.inventory_id', '=', 'inventory_products.id');
                    $join->on('products.product_type_id', '=', OrderItems::raw(1));
            })
            ->leftJoin(OrderItems::raw('inventory_supplies'), function (JoinClause $join) {
                $join->on('orders_item.inventory_id', '=', 'inventory_supplies.id');
                $join->on('products.product_type_id', '=', OrderItems::raw(2));
            })
            ->leftJoin('colors', function (JoinClause $join) {
                $join->on('colors.id', '=', 'inventory_supplies.color_id')
                    ->orOn('colors.id', '=', 'inventory_products.color_id');
            })
            ->groupBy('inventory_products.product_id', 'inventory_products.color_id')
            ->orderBy('products.name')
            ->orderBy('products.product_type_id')
            ->get();


        return $this->view_basic_page( $this->base_file_path . 'order_view', [
            'order' => $order,
            'items' => $order_item,
            'statuses' => $this->order_statuses,
        ]);
    }

    public function product_review( $order_id )
    {
        $order = Orders::where('id', $order_id)
            ->first();

        $items = OrderItems::select(
                'orders_item.*',
                OrderItems::raw('COUNT(inventory_products.id) as product_quantity'),
                OrderItems::raw('colors.name as color_name'),
            )
            ->where('order_id', $order_id)
            ->join('products', 'products.id', '=', 'orders_item.product_id')
            ->leftJoin(OrderItems::raw('inventory_products'), function (JoinClause $join) {
                    $join->on('orders_item.inventory_id', '=', 'inventory_products.id');
                    $join->on('products.product_type_id', '=', OrderItems::raw(1));
            })
            ->leftJoin(OrderItems::raw('inventory_supplies'), function (JoinClause $join) {
                $join->on('orders_item.inventory_id', '=', 'inventory_supplies.id');
                $join->on('products.product_type_id', '=', OrderItems::raw(2));
            })
            ->leftJoin('colors', function (JoinClause $join) {
                $join->on('colors.id', '=', 'inventory_supplies.color_id')
                    ->orOn('colors.id', '=', 'inventory_products.color_id');
            })
            ->groupBy('inventory_products.product_id', 'inventory_products.color_id')
            ->orderBy('products.name')
            ->orderBy('products.product_type_id')
            ->get();

        $review_count = ProductReview::where('order_id', $order_id)
            ->join('orders_item', 'orders_item.id', '=', 'product_review.order_item_id')
            ->count();

        return $this->view_basic_page( $this->base_file_path . 'product_review', compact(
            'order',
            'items',
            'review_count'
        ));
    }

    public function product_review_form($order_id, Request $request ): RedirectResponse
    {
        $form_quantity = $request->post('quantity');
        $form_color_id= $request->post('color');
        $validator = Validator::make($request->all(), [
            'order_item_id' => 'required|array',
            'order_item_id.*' => Rule::forEach(function ($value, string $attribute) use (&$order_id) {
                return [
                    'required',
                    'numeric',
                    'distinct',
                    Rule::exists('orders_item', 'id')->where('order_id', $order_id)
                ];
            }),
            'review' => 'required|array',
            'review.*' => Rule::forEach(function ($value, string $attribute) {
                    [, $count] = explode('.', $attribute);
                    return [ "required_with:rating.$count" ];
                }),
        ], [
            'order_item_id.*.exists' => 'Something went wrong on product #:position!',
            'review.*.required_with' => 'You did not put any review for product #:position!',
        ]);

        $user_id = session('id');

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach( $request->post('order_item_id') as $value ) {
            if(
                ProductReview::where('order_item_id', $value)
                    ->where('user_id', $user_id)
                    ->exists()
            ) {
                return back()
                    ->withErrors('You already submitted a review on of the products. Please refresh the page or contact support.')
                    ->withInput();
            }
        }

        $order_item_id_arr = $request->post('order_item_id');
        $review_arr = $request->post('review');
        $created = 0;
        foreach( $request->post('rating') as $index => $rating ) {
            if( empty($rating) ) {
                continue;
            }
            $order_item_id = $order_item_id_arr[$index];
            $review = $review_arr[$index];

            ProductReview::create([
                'rating' => $rating,
                'order_item_id' => $order_item_id,
                'review' => $review,
                'user_id' => $user_id,
            ]);
            $created++;
        }

        return back()
            ->with([
                'data' => ['You have succesfully added a review(s) for the product!'],
                'start_with' => $created,
            ])
            ->withInput();
    }


    public function cart()
    {
        $this->page_title = 'Your Cart';
        $cart_items = Cart::select(
                'products.*',
                'cart.*',
                Cart::raw('colors.name as color_name'),
                Cart::raw('cart.id as cart_id'),
                Cart::raw('products.id as product_id'),
            )
            ->where('user_id', session('id'))
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->join('colors', 'colors.id', '=', 'cart.color_id')
            ->orderBy('cart.created_at', 'desc')
            ->paginate(5);

        $total_price = Cart::where('user_id', session('id'))
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->sum(Cart::raw('quantity * price'));

        return $this->view_basic_page( $this->base_file_path . 'cart', [
            'items' => $cart_items,
            'total_price' => $total_price
        ]);
    }

    public function cart_add($product_id, Request $request ): RedirectResponse
    {
        $form_quantity = $request->post('quantity');
        $form_color_id= $request->post('color');
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric',
            'color' => 'required',
        ], [
            'color.required' => 'Product color not selected, Please select a color!'
        ]);

        if ($validator->fails()) {
            return redirect("/shop/product/$product_id/view")
                ->withErrors($validator)
                ->withInput();
        }

        $condition = ['product_id' => $product_id, 'user_id' => session('id'), 'color_id' => $form_color_id];
        $oldData = Cart::select('quantity')->where($condition)->first();

        if ( empty($oldData) ) {
            Cart::create([
                'product_id' => $product_id,
                'user_id' => session('id'),
                'color_id' => $form_color_id,
                'quantity' => $form_quantity
            ]);
        } else {
            Cart::where('product_id', $product_id)
                ->where('user_id', session('id'))
                ->where('color_id', $form_color_id)
                ->update([
                    'product_id' => $product_id,
                    'user_id' => session('id'),
                    'color_id' => $form_color_id,
                    'quantity' => $oldData->quantity + $form_quantity
                ]);
        }

        if( $request->has('check_out')) {
            return redirect('/shop/cart');
        }

        return back()
            ->with(['data' => ['Product successfully added to cart!']]);
    }

    public function cart_edit($cart_id, Request $request ): RedirectResponse
    {
        $form_quantity = $request->post('quantity');
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect("/shop/cart")
                ->withErrors($validator)
                ->withInput();
        }

        $condition = ['user_id' => session('id'), 'id' => $cart_id];
        $oldData = Cart::select('quantity')->where($condition)->first();

        if ( empty($oldData) ) {
            return redirect("/shop/cart")
                ->withErrors('Cart item does not exist')
                ->withInput();
        }
        Cart::where('user_id', session('id'))
            ->where('id', $cart_id)
            ->update([
                'quantity' => $form_quantity
            ]);

        return back()
            ->with(['data' => ['Cart item successfully updated!']]);
    }

    public function cart_remove($cart_id): RedirectResponse
    {
        Cart::where('user_id', session('id'))
            ->where('id', $cart_id)
            ->delete();

        return redirect("/shop/cart")
            ->with(['data' => ['Cart item successfully removed!']]);
    }

    public function view_product( $item_id )
    {
        $product = Products::select('*', Products::raw('(SELECT name FROM brands where id=products.brand_id) as brand_name'))
            ->where('id', $item_id)
            ->first();

        if( $product->product_type_id == 1 ) {
            $product_colors = InventoryProducts::select('color_id', 'name', InventoryProducts::raw('COUNT(product_id) as quantity'))
                ->groupBy('product_id', 'color_id')
                ->where('product_id', $item_id)
                ->where('taken', false)
                ->join('colors', 'inventory_products.color_id', '=', 'colors.id')
                ->get();
        } else if ( $product->product_type_id == 2 ) {
            $product_colors = InventorySupplies::select('color_id', 'name', 'quantity')
                ->where('product_id', $item_id)
                ->join('colors', 'inventory_supplies.color_id', '=', 'colors.id')
                ->get();
        }

        $productImage = asset(
            !empty($product['image']) ?
            'storage/app/public/shop' . $product['image']:
            'assets/images/inventory/uploads/default.png'
        );

        $multiplier = 5;
        $total_rating_count = ProductReview::join('orders_item', 'orders_item.id', '=', 'product_review.order_item_id')
            ->where('product_id', $item_id)
            ->count();

        $rating_arr = collect([]);
        $rating_count_arr = collect([]);
        for( $rating = 1; $rating <= 5; $rating ++ ) {
            $rating_count = ProductReview::join('orders_item', 'orders_item.id', '=', 'product_review.order_item_id')
                ->where('product_id', $item_id)
                ->where('rating', '=', $rating)
                ->count();
            $rating_arr->push( $rating_count * $rating );
            $rating_count_arr->push( $rating_count );
        }

        $modified_rating_arr = $rating_arr->map(function (int $item, int $key) use (&$multiplier) {
            return $item * $multiplier;
        });
        $rating_scores = $rating_count_arr->map(function (int $rating, int $key) use (&$total_rating_count) {
            $total = $total_rating_count > 0 ? $total_rating_count : 1;
            return [$rating, ($rating / $total) * 100];
        });
        $score_rating = $modified_rating_arr->sum();
        $total_rating = $total_rating_count * $multiplier;
        $product_rating = round($score_rating / ($total_rating > 0 ? $total_rating : 1), 1);

        $reviews = ProductReview::select('product_review.*')
            ->join('orders_item', 'orders_item.id', '=', 'product_review.order_item_id')
            ->where('product_id', $item_id)
            ->orderBy('rating', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $this->view_basic_page( $this->base_file_path . 'view_product', [
            'product' => $product,
            'productImage' => $productImage,
            'colors' => $product_colors,
            'reviews' => $reviews,
            'rating_scores' => $rating_scores,
            'product_rating' => $product_rating,
        ]);
    }

    public function cart_checkout(Request $request ): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required',
        ], [
            'payment_method.required' => 'You must select payment method'
        ]);
        $form_payment_method = $request->post('payment_method');

        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }

        $order_item_batch = collect([]);
        $product_inventory_batch = collect([]);
        $order_validation_error = collect([]);
        $user_id = session('id');

        if( empty( $user_id ) ) {
            $order_validation_error->push('Could not find user logged in!');
        }

        Cart::select(
                'products.*',
                'cart.*',
                Cart::raw('colors.name as color_name'),
                Cart::raw('cart.id as cart_id'),
                Cart::raw('products.id as product_id'),
            )
            ->where('user_id', $user_id)
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->join('colors', 'colors.id', '=', 'cart.color_id')
            ->chunk(50, function (Collection $cart_items) use (&$order_validation_error, &$product_inventory_batch, &$order_item_batch) {
                foreach( $cart_items as $card_item ) {
                    if ( $card_item->product_type_id == 1 ) {
                        $SerialInventory = InventoryProducts::select('id')
                            ->where('product_id', $card_item->product_id)
                            ->where('color_id', $card_item->color_id)
                            ->where('taken', false)
                            ->take($card_item->quantity)
                            ->get();
                        $number_of_stocks = count($SerialInventory);
                        if( $card_item->quantity > $number_of_stocks ) {
                            $order_validation_error->push("Sorry, item \"$card_item->name\" with variant of \"$card_item->color_name\" only has $number_of_stocks stock(s) left.");
                            return false;
                        }
                        foreach ( $SerialInventory as $serial ) {
                            $order_item_batch->push([
                                'product_id' => $card_item->product_id,
                                'inventory_id' => $serial->id,
                                'quantity' => 1,
                                'price' => $card_item->price,
                            ]);
                            $product_inventory_batch->push([ $serial->id, ['taken' => true] ]);
                        }
                    } else if ( $card_item->product_type_id == 2 ) {
                        $supplyInventory = InventorySupplies::select('id', 'quantity')
                            ->where('product_id', $card_item->product_id)
                            ->where('color_id', $card_item->color_id)
                            ->first();
                        if( $card_item->quantity > $supplyInventory->quantity ) {
                            $order_validation_error->push("Sorry, item \"$card_item->name\" with variant of \"$card_item->color_name\" only has $supplyInventory->quantity stock(s) left.");
                            return false;
                        }
                        $order_item_batch->push([
                            'product_id' => $card_item->product_id,
                            'inventory_id' => $supplyInventory->id,
                            'quantity' => $card_item->quantity,
                            'price' => $card_item->price,
                        ]);
                    }
                }
            });

        if( count( $order_validation_error ) > 0 ) {
            return back()
                ->withErrors($order_validation_error->all());
        }

        // Check if quantity is valid
        if( count( $order_item_batch ) < 1 ) {
            return back()
                ->withErrors('You do not have an item in your cart.');
        }

        $total_price = Cart::where('user_id', $user_id)
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->sum(Cart::raw('quantity * price'));

        $order_insert = Orders::create([
            'payment_method' => 'Cash',
            'status' => 1,
            'total' => $total_price,
            'user_id' => $user_id,
        ]);

        foreach ( $order_item_batch as $order_item ) {
            OrderItems::create([
                ...$order_item,
                'order_id' => $order_insert->id,
            ]);
        }
        foreach ( $product_inventory_batch as [$inventory_id, $inventory_item] ) {
            InventoryProducts::where('id', $inventory_id)
                ->update($inventory_item);
        }
        Cart::where('user_id', $user_id)->delete();

        return redirect("/shop/order/$order_insert->id/view");
    }
    public function searchItem(Request $request)
    {
        $query = $request->get('query'); // Get the search query from the input field

        if ($query) {
            $shop_items = Products::where('name', 'like', '%' . $query . '%') // Filter by product name
                ->orWhere('description', 'like', '%' . $query . '%') // Optional: Filter by description as well
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        } else {
            // Default: Show all products if no search query
            $shop_items = Products::orderBy('created_at', 'desc')->paginate(12);
        }

        return $this->view_basic_page($this->base_file_path . 'index', [
            'items' => $shop_items,
            'query' => $query,
        ]);
    }
}
