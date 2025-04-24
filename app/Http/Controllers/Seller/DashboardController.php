<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Services\Seller\DashboardService as SellerDashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{

    protected $dashboardService;

    public function __construct(SellerDashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $seller = Auth::user()->seller;

        $totalDigitalBooks = $this->dashboardService->getTotalDigitalBooks($seller->id);
        $totalPhysicalBooks = $this->dashboardService->getTotalPhysicalBooks($seller->id);
        $totalOrders = $this->dashboardService->getTotalOrders($seller->id);
        $totalRevenue = $this->dashboardService->getTotalRevenue($seller->id);

        return view('seller.dashboard.index', compact(
            'totalDigitalBooks',
            'totalPhysicalBooks',
            'totalOrders',
            'totalRevenue'
        ));
    }
}
