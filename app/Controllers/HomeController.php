<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\BookService;
use App\Services\CategoryService;
use App\Services\CouponService;
use App\Services\InventoryService;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\ReportService;
use App\Services\ReviewService;
use App\Services\ShipmentService;
use App\Services\WishlistService;

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
        $reviewService = new ReviewService();
        $wishlistService = new WishlistService();
        $paymentService = new PaymentService();
        $shipmentService = new ShipmentService();

        $this->view('home/index', [
            'books' => $bookService->featured(),
            'categories' => $categoryService->all(),
            'kpi' => $reportService->kpi(),
            'recentOrders' => $orderService->recentCount(),
            'lowStock' => $inventoryService->lowStockCount(),
            'activeCoupons' => $couponService->activeCoupons(),
            'averageRating' => $reviewService->averageRating(),
            'wishlistTotal' => $wishlistService->popularCount(),
            'paymentMethods' => $paymentService->availableMethods(),
            'shipmentProviders' => $shipmentService->providers(),
        ]);
    }
}
