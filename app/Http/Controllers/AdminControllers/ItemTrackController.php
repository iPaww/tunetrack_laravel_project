<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Orders;
use App\Http\Controllers\AdminControllers\BasePageController;

class ItemTrackController extends BasePageController
{
    public string $base_file_path = 'item_track.';

    public function index()
    {
        $orders = Orders::select('orders.id', 'orders.order_date', 'orders.payment_method', 'orders.status', 'orders.total_price', 'users.fullname')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->get();

        return $this->view_basic_page( $this->base_file_path . 'index', [
            'orders' => $orders,
        ]);
    }
}
