<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Cart;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Supplies;
use App\Models\User;
use App\Http\Controllers\AdminControllers\BasePageController;

class AdminController extends BasePageController
{
    public function index()
    {
        $this->page_title = 'TuneTrack | Admin Dashboard';

        $orders_data = Orders::select(Orders::raw('COUNT(*) as total_orders, SUM(total) AS total_sales'))
            ->whereIn('status', ['Ready to Pickup', 'processing', 'pending'])
            ->first();
        
        $admin_data = User::select(User::raw('COUNT(*) AS total_admin'))
            ->where('role', 'admin') // TODO FIXME: This should be an integer
            ->first();
        
        $inventory_data = Products::select(Products::raw('COUNT(*) AS total_instruments'))
            ->first();
        
        $cart_data = Cart::select(Cart::raw('COUNT(*) AS total_cart_items'))
            ->whereIn('user_id', [Cart::raw('(SELECT id FROM users)')])
            ->first();
        
        if( empty( $orders_data ) ) {
            $orders_data['total_orders'] = 0;
            $orders_data['total_sales'] = 0;
        }
        if( empty( $admin_data ) ) {
            $admin_data['total_admin'] = 0;
        }
        if( empty( $inventory_data ) ) {
            $inventory_data['total_instruments'] = 0;
        }
        if( empty( $cart_data ) ) {
            $cart_data['total_cart_items'] = 0;
        }
        
        return $this->view_basic_page('index', [
            'orders_data' => $orders_data,
            'admin_data' => $admin_data,
            'inventory_data' => $inventory_data,
            'cart_data' => $cart_data,
        ]);
    }
}
