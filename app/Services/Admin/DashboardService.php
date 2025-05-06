<?php

namespace App\Services\Admin;

use App\Models\PhysicalBook;
use App\Models\ElectronicBook;
use App\Models\Order;
use App\Models\User;

class DashboardService
{
    public function totalUsers()
    {
        $lastMonthUsers = User::whereMonth('created_at', now()->subMonth()->month)->count();
        $currentUsers = User::count();

        $userGrowth = 0;
        if ($lastMonthUsers > 0) {
            $userGrowth = round((($currentUsers - $lastMonthUsers) / $lastMonthUsers) * 100, 2);
        }

        return [$currentUsers, $userGrowth];
    }

    public function totalPhysicalBooks()
    {
        $lastMonthPhysicalBooks = PhysicalBook::whereMonth('created_at', now()->subMonth()->month)->count();
        $currentPhysicalBooks = PhysicalBook::count();

        $physicalBookGrowth = 0;
        if ($lastMonthPhysicalBooks > 0) {
            $physicalBookGrowth = round((($currentPhysicalBooks - $lastMonthPhysicalBooks) / $lastMonthPhysicalBooks) * 100, 2);
        }

        return [$currentPhysicalBooks, $physicalBookGrowth];
    }

    public function totalDigitalBooks()
    {
        $lastMonthDigitalBooks = ElectronicBook::whereMonth('created_at', now()->subMonth()->month)->count();
        $currentDigitalBooks = ElectronicBook::count();

        $digitalBookGrowth = 0;
        if ($lastMonthDigitalBooks > 0) {
            $digitalBookGrowth = round((($currentDigitalBooks - $lastMonthDigitalBooks) / $lastMonthDigitalBooks) * 100, 2);
        }

        return [$currentDigitalBooks, $digitalBookGrowth];
    }

    public function totalOrders()
    {
        $lastMonthOrders = Order::whereMonth('created_at', now()->subMonth()->month)->count();
        $currentOrders = Order::count();

        $ordersGrowth = 0;
        if ($lastMonthOrders > 0) {
            $ordersGrowth = round((($currentOrders - $lastMonthOrders) / $lastMonthOrders) * 100, 2);
        }

        return [$currentOrders, $ordersGrowth];
    }
}
