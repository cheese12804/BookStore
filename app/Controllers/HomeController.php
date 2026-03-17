<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\BookService;
use App\Services\CategoryService;
use App\Services\CouponService;
use App\Services\InventoryService;
use App\Services\OrderService;
use App\Services\ReportService;

class HomeController extends Controller
{
    public function index(): void
    {
        $bookService = new BookService();
        $categoryService = new CategoryService();
        $orderService = new OrderService();
        $inventoryService = new InventoryService();
        $couponService = new CouponService();
        $reportService = new ReportService();

        $this->view('home/index', [
            'books' => $bookService->featured(),
            'categories' => $categoryService->all(),
            'kpi' => $reportService->kpi(),
            'recentOrders' => $orderService->recentCount(),
            'lowStock' => $inventoryService->lowStockCount(),
            'activeCoupons' => $couponService->activeCoupons(),
        ]);
    }
}
