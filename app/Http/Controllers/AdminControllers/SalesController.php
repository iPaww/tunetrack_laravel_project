<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Orders;
use App\Http\Controllers\AdminControllers\BasePageController;

class SalesController extends BasePageController
{
    public string $base_file_path = 'sales.';

    public function index()
    {
        $order_dates = [];
        $order_counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $order_data = Orders::select(Orders::raw('COUNT(*) AS order_count'))
                ->where('order_date', '<', $date)
                // where('order_date', '<', date('Y-m-d', strtotime("-0 days")))
                // ->where('order_date', '>', date('Y-m-d', strtotime("-6 days")))
                ->whereIn('status', ['Ready to Pickup', 'processing', 'pending'])
                ->first();

            array_push( $order_dates, date('D', strtotime($date)) );
            array_push( $order_counts, $order_data['order_count']);
        }

        return $this->view_basic_page( $this->base_file_path . 'index', [
            'order_dates' => $order_dates,
            'order_counts' => $order_counts,
        ]);
    }
}
