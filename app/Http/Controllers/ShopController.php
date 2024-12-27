<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use App\Models\Colors;
use App\Models\InstrumentCategory;
use App\Models\Inventory;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Products;
use App\Models\Supplies;
use App\Http\Controllers\BasePageController;

class ShopController extends BasePageController
{
    public string $page_title = "JCS Store";
    public string $base_file_path = 'shop.';
    public $order_statuses = [
        1 => 'Pending',
        2 => 'Delivery',
        3 => 'Delivered',
        4 => 'Cancelled',
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
                'products.*',
                'orders_item.*',
                Cart::raw('(SELECT name FROM colors where id=
                    (SELECT color_id FROM inventory where id=orders_item.inventory_id)
                ) as color_name'),
                Cart::raw('orders_item.id as order_item_id'),
                Cart::raw('products.id as product_id'),
            )
            ->where('order_id', $order_id)
            ->join('products', 'products.id', '=', 'orders_item.product_id')
            ->get();
        
        return $this->view_basic_page( $this->base_file_path . 'order_view', [
            'order' => $order,
            'items' => $order_item,
            'statuses' => $this->order_statuses,
        ]);
    }

    public function cart()
    {
        $this->page_title = 'Your Cart';
        $cart_items = Cart::select(
                'products.*',
                'cart.*',
                Cart::raw('(SELECT name FROM colors where id=
                    (SELECT color_id FROM inventory where id=cart.inventory_id)
                ) as color_name'),
                Cart::raw('cart.id as cart_id'),
                Cart::raw('products.id as product_id'),
            )
            ->where('user_id', session('id'))
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->orderBy('cart.created_at', 'desc')
            ->take(20)
            ->paginate();
        
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
        $form_inventory_id = $request->post('inventory');
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric',
            'inventory' => 'required',
        ], [
            'inventory.required' => 'Product color not selected, Please select a color!'
        ]);

        if ($validator->fails()) {
            return redirect("/shop/product/$product_id/view")
                ->withErrors($validator)
                ->withInput();
        }

        $condition = ['product_id' => $product_id, 'user_id' => session('id'), 'inventory_id' => $form_inventory_id];
        $oldData = Cart::select('quantity')->where($condition)->first();

        if ( empty($oldData) ) {
            Cart::create([
                'product_id' => $product_id,
                'user_id' => session('id'),
                'inventory_id' => $form_inventory_id,
                'quantity' => $form_quantity
            ]);
        } else {
            Cart::where('product_id', $product_id)
                ->where('user_id', session('id'))
                ->where('inventory_id', $form_inventory_id)
                ->update([
                    'product_id' => $product_id,
                    'user_id' => session('id'),
                    'inventory_id' => $form_inventory_id,
                    'quantity' => $oldData->quantity + $form_quantity
                ]);
        }

        return redirect("/shop/product/$product_id/view")
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

        return redirect("/shop/cart")
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

        $product_colors = Inventory::select('inventory.id', 'color_id', 'name', 'quantity')
            ->where('product_id', $item_id)
            ->join('colors', 'inventory.color_id', '=', 'colors.id')
            ->get();
        
        $productImage = asset(
            !empty($product['image']) ?
            'assets/images/inventory/uploads/' . $product['image']:
            'assets/images/inventory/uploads/default.png'
        );
        
        return $this->view_basic_page( $this->base_file_path . 'view_product', [
            'product' => $product,
            'productImage' => $productImage,
            'colors' => $product_colors,
        ]);
    }
}
