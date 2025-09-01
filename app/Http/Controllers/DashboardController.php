<?php

namespace App\Http\Controllers;

use App\Models\MessageTemplate;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
//        $orders = Order::query()
//            ->with(['user', 'items.product'])
//            ->latest()
//            ->limit(10)
//            ->paginate(10);
//        $recentTransactions = OrderItem::with(['order.user', 'product'])
//            ->latest()
//            ->take(10)
//            ->get();
//
//        $totalSalesCount = Order::count();
//        $totalRevenue = Order::sum('total_price');
//        $totalProfit = Order::sum('total_price') * 20 / 100;


        $totalCustomers = User::count();
        $totalTemplates = MessageTemplate::count();

        return view('admin.index', [
            'title' => 'داشبورد',
//            'orders' => $orders,
//            'recentTransactions' => $recentTransactions,
            'totalSalesCount' => 10,
            'totalRevenue' => 20,
            'totalTemplates' => 30,
            'totalCustomers' => $totalCustomers,
        ]);
    }
}

