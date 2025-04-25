<?php

namespace App\Repositories\Interfaces\Seller;

interface DashboardRepositoryInterface
{
    public function getTotalDigitalBooks($sellerId);
    public function getTotalPhysicalBooks($sellerId);
    public function getTotalOrders($sellerId);
    public function getTotalRevenue($sellerId);
}
