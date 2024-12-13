<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Instruments;
use App\Models\InstrumentCategory;
use App\Models\Orders;
use App\Models\Supplies;
use App\Http\Controller as BaseController;

class ShopController extends Controller
{
    private string $page_title = "JCS Store";
    private string $base_file_path = 'shop.';
    
    private function view_basic_page( string $page, $params = [], ...$args )
    {
        return view( $this->base_file_path . 'template', [ 
            'page_title' => $this->page_title,
            'page' => $page,
            'fullname' => 'Guest',
            ...$params 
        ], ...$args );
    }

    public function index()
    {
        $shop_items = Instruments::orderBy('name')
            ->take(10)
            ->get();

        return $this->view_basic_page( $this->base_file_path . 'index', [
            'items' => $shop_items,
        ]);
    }

    public function orders()
    {
        $order_items = Orders::where('user_id', 1) // TODO FIXME: user id to current loggedin user
            ->get();
        
        return $this->view_basic_page( $this->base_file_path . 'orders', [
            'items' => $order_items,
        ]);
    }

    public function cart()
    {
        $this->page_title = 'Your Cart';
        $cart_items = Cart::where('user_id', 0) // TODO FIXME: user id to current loggedin user
            ->orderBy('added_at', 'desc')
            ->take(10)
            ->get();
        
        $total_price = Cart::select('(quantity * price) as sub_total')
            ->where('user_id', 0) // TODO FIXME: user id to current loggedin user
            ->join('instrument_models', 'cart.model_id', '=', 'instrument_models.model_id')
            ->sum(Cart::raw('quantity * price'));
        
        return $this->view_basic_page( $this->base_file_path . 'cart', [
            'items' => $cart_items,
            'total_price' => $total_price
        ]);
    }

    public function view_product( $category, $item_id )
    {
        return $this->view_basic_page( $this->base_file_path . 'view_product');
    }
}
