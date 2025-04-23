<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService as AdminDashboardService;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $dashboardService;

    public function __construct(AdminDashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        [$totalUsers, $userGrowth] = $this->dashboardService->totalUsers();
        [$totalPhysicalBooks, $physicalBookGrowth] = $this->dashboardService->totalPhysicalBooks();
        [$totalDigitalBooks, $digitalBookGrowth] = $this->dashboardService->totalDigitalBooks();
        [$totalOrders, $ordersGrowth] = $this->dashboardService->totalOrders();

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'userGrowth',
            'totalPhysicalBooks',
            'physicalBookGrowth',
            'totalDigitalBooks',
            'digitalBookGrowth',
            'totalOrders',
            'ordersGrowth'
        ));
    }
}
