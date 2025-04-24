<?php

namespace App\Services\Seller;

use App\Models\ElectronicBook;
use App\Models\Order;
use App\Models\PhysicalBook;

class DashboardService
{
    public function getTotalDigitalBooks($sellerId)
    {
        return ElectronicBook::whereHas('book', function ($bookQuery) use ($sellerId) {
            $bookQuery->where('seller_id', $sellerId);
        })->count();
    }

    public function getTotalPhysicalBooks($sellerId)
    {
        return PhysicalBook::whereHas('book', function ($bookQuery) use ($sellerId) {
            $bookQuery->where('seller_id', $sellerId);
        })->count();
    }

    public function getTotalOrders($sellerId)
    {
        return Order::whereHas('electronicBook', function ($electronicBookQuery) use ($sellerId) {
            $electronicBookQuery->whereHas('book', function ($bookQuery) use ($sellerId) {
                $bookQuery->where('seller_id', $sellerId);
            });
        })->count();
    }

    public function getTotalRevenue($sellerId)
    {
        return Order::whereHas('electronicBook', function ($electronicBookQuery) use ($sellerId) {
            $electronicBookQuery->whereHas('book', function ($bookQuery) use ($sellerId) {
                $bookQuery->where('seller_id', $sellerId);
            });
        })
            ->where('status', 'completed')
            ->sum('total_price');


    }
}
