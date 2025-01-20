<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Orders;
use Illuminate\Http\Request;

class BasePageController extends Controller
{
    public string $page_title = "TuneTrack";
    public string $base_file_path = '';

    public function view_basic_page(string $page, $params = [], ...$args)
    {
        $template = 'basic_page';
        if (view()->exists($this->base_file_path . 'template')) {
            $template = $this->base_file_path . 'template';
        }

        $cart_count = 0;
        $notifications = [];
        $unreadCount = 0;

        if (!empty(session('id'))) {
            $cart_count = Cart::where('user_id', session('id'))->count();
            $notifications = Orders::where('user_id', session('id'))->orderBy('id', 'desc',)->orderBy('is_read')->take(25)->get();
            $unreadCount = $notifications->where('is_read', false)->count(); // Count unread orders
        }

        return view($template, [
            'page_title' => $this->page_title,
            'page' => $page,
            'cart_count' => $cart_count,
            'notifications' => $notifications,
            'unreadCount' => $unreadCount, // Pass unread count to the view
            ...$params
        ], ...$args);
    }

    // Endpoint to mark notifications as read
    public function markNotificationsRead()
    {
        if (!empty(session('id'))) {
            Orders::where('user_id', session('id'))->where('is_read', false)->update(['is_read' => true]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'User not logged in'], 401);
    }
}
