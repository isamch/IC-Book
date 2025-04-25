<?php

namespace App\Services\Seller;

use App\Models\ElectronicBook;
use App\Models\Order;
use App\Models\PhysicalBook;
use App\Repositories\Eloquent\Seller\DashboardRepository;

class DashboardService
{

    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }


    public function getTotalDigitalBooks($sellerId)
    {
        return $this->dashboardRepository->getTotalDigitalBooks($sellerId);
    }

    public function getTotalPhysicalBooks($sellerId)
    {
        return $this->dashboardRepository->getTotalPhysicalBooks($sellerId);
    }

    public function getTotalOrders($sellerId)
    {
        return $this->dashboardRepository->getTotalOrders($sellerId);
    }

    public function getTotalRevenue($sellerId)
    {
        return $this->dashboardRepository->getTotalRevenue($sellerId);
    }

}
