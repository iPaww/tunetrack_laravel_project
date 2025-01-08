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

        // Get order data
        $orders_data = Orders::select(Orders::raw('COUNT(*) as total_orders, SUM(total) AS total_sales'))
            ->whereIn('status', ['Ready to Pickup', 'processing', 'pending'])
            ->first();

        // Get total admin count using selectRaw to get the count
        $admin_data = User::selectRaw('COUNT(*) as total_admin')
            ->where('role', 1) // Ensure role is checked as 1 for admin
            ->first();

        // Get inventory data
        $inventory_data = Products::select(Products::raw('COUNT(*) AS total_instruments'))
            ->first();

        // Get cart data
        $cart_data = Cart::select(Cart::raw('COUNT(*) AS total_cart_items'))
            ->whereIn('user_id', [Cart::raw('(SELECT id FROM users)')])
            ->first();

        // Fetch Sales Data (Last 7 days - current week)
        $sales_data = Orders::selectRaw('DATE(created_at) as order_date, COUNT(*) as total_orders, SUM(total) as total_sales')
            ->groupBy('order_date')
            ->orderBy('order_date', 'desc')
            ->limit(7) // Last 7 days
            ->get();

        // Fetch Sales Data (Last 4 weeks - previous weeks)
        $previous_weeks_sales = Orders::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") as order_date, SUM(total) as total_sales')
            ->whereBetween('created_at', [now()->subWeeks(4), now()->subWeeks(1)])
            ->groupBy('order_date')
            ->orderBy('order_date', 'desc')
            ->get();

        // Fetch Sales Data (Current month)
        $monthly_sales = Orders::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") as order_date, SUM(total) as total_sales')
            ->whereMonth('created_at', '=', now()->month)
            ->whereYear('created_at', '=', now()->year)
            ->groupBy('order_date')
            ->orderBy('order_date', 'desc')
            ->get();

        // Calculate today's sales
        $today_sales = Orders::selectRaw('COUNT(*) as total_orders, SUM(total) as total_sales')
            ->whereDate('created_at', '=', today())
            ->first();

        // Calculate previous month's sales
        $previous_month_sales = Orders::selectRaw('COUNT(*) as total_orders, SUM(total) as total_sales')
            ->whereMonth('created_at', '=', now()->subMonth()->month)
            ->whereYear('created_at', '=', now()->subMonth()->year)
            ->first();

        // Ensure default values if no data is found for orders
        $orders_data['total_orders'] = $orders_data->total_orders ?? 0;
        $orders_data['total_sales'] = $orders_data->total_sales ?? 0;

        // Ensure default values if no data is found for admin count
        $admin_data = $admin_data ? $admin_data->total_admin : 0;

        // Ensure default values if no data is found for inventory
        $inventory_data['total_instruments'] = $inventory_data->total_instruments ?? 0;

        // Ensure default values if no data is found for cart data
        $cart_data['total_cart_items'] = $cart_data->total_cart_items ?? 0;

        // Prepare sales data for the bar graph (last 7 days)
        $sales_dates = $sales_data->pluck('order_date')->toArray();
        $sales_values = $sales_data->pluck('total_sales')->toArray();

        // Prepare data for the bar graph
        $today_sales_value = $today_sales->total_sales ?? 0;
        $previous_sales_value = array_sum($sales_values); // Sum of the last 7 days sales

        // Prepare previous weeks sales
        $previous_weeks_dates = $previous_weeks_sales->pluck('order_date')->toArray();
        $previous_weeks_sales_values = $previous_weeks_sales->pluck('total_sales')->toArray();

        // Prepare monthly sales
        $monthly_dates = $monthly_sales->pluck('order_date')->toArray();
        $monthly_sales_values = $monthly_sales->pluck('total_sales')->toArray();

        return $this->view_basic_page('index', [
            'orders_data' => $orders_data,
            'admin_data' => $admin_data,
            'inventory_data' => $inventory_data,
            'cart_data' => $cart_data,
            'sales_data' => $sales_data, // PSass sales data to the view
            'previous_month_sales' => [
                'total_orders' => $previous_month_sales->total_orders ?? 0,
                'total_sales' => $previous_month_sales->total_sales ?? 0,
            ], // Pass previous month sales data
            'labels' => ['Today\'s Sales', 'Previous Sales (7 Days)'], // Bar labels
            'sales' => [$today_sales_value, $previous_sales_value], // Bar values (sales for today and last 7 days)
            'previous_weeks_labels' => $previous_weeks_dates, // Correct variable for previous weeks
            'previous_weeks_sales' => $previous_weeks_sales_values, // Correct variable for previous weeks
            'monthly_labels' => $monthly_dates, // Correct variable for monthly sales
            'monthly_sales' => $monthly_sales_values, // Correct variable for monthly sales
        ]);
    }
    
}
