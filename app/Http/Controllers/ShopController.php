<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Cart;
use App\Models\Colors;
use App\Models\InstrumentCategory;
use App\Models\Inventory;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Supplies;
use App\Http\Controllers\BasePageController;

class ShopController extends BasePageController
{
    public string $page_title = "JCS Store";
    public string $base_file_path = 'shop.';

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
        $order_items = Orders::where('user_id', session('id'))
            ->get();
        
        return $this->view_basic_page( $this->base_file_path . 'orders', [
            'items' => $order_items,
        ]);
    }

    public function cart()
    {
        $this->page_title = 'Your Cart';
        $cart_items = Cart::select('products.*', 'cart.*', Cart::raw('cart.id as cart_id'))
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
        $condition = ['product_id' => $product_id, 'user_id' => session('id')];
        $oldData = Cart::select('quantity')->find($condition);
        $form_quantity = $request->post('quantity');
        $form_inventory_id = $request->post('inventory');

        if ( count($oldData) <= 0 ) {
            Cart::create([
                'product_id' => $product_id,
                'user_id' => session('id'),
                'inventory_id' => $form_inventory_id,
                'quantity' => $form_quantity
            ]);
        } else {
            Cart::where('product_id', $product_id)
                ->where('user_id', session('id'))
                ->update([
                    'product_id' => $product_id,
                    'user_id' => session('id'),
                    'inventory_id' => $form_inventory_id,
                    'quantity' => $oldData->quantity + $form_quantity
                ]);
        }

        return redirect("/shop/product/$product_id/view")
            ->with('Product successfully added');
    }

    public function view_product( $item_id )
    {
        $product = Products::where('id', $item_id)
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
