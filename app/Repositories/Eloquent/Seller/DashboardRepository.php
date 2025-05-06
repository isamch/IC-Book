<?php

namespace App\Repositories\Eloquent\Seller;

use App\Models\ElectronicBook;
use App\Models\Order;
use App\Models\PhysicalBook;
use App\Repositories\Interfaces\Seller\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function getTotalDigitalBooks($sellerId)
    {
        return ElectronicBook::whereHas('book', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->count();
    }

    public function getTotalPhysicalBooks($sellerId)
    {
        return PhysicalBook::whereHas('book', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->count();
    }

    public function getTotalOrders($sellerId)
    {
        return Order::whereHas('electronicBook.book', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->count();
    }

    public function getTotalRevenue($sellerId)
    {
        return Order::whereHas('electronicBook.book', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->where('status', 'completed')->sum('total_price');
    }
}
