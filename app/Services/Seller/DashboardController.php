<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\ElectronicBook;
use App\Models\Order;
use App\Models\PhysicalBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function index()
    {
        $seller = Auth::user()->seller;

        $totalDigitalBooks = $this->getTotalDigitalBooks($seller->id);
        $totalPhysicalBooks = $this->getTotalPhysicalBooks($seller->id);
        $totalOrders = $this->getTotalOrders($seller->id);
        $totalRevenue = $this->getTotalRevenue($seller->id);

        return view('seller.dashboard.index', compact(
            'totalDigitalBooks',
            'totalPhysicalBooks',
            'totalOrders',
            'totalRevenue'
        ));
    }

    private function getTotalDigitalBooks($sellerId)
    {
        return ElectronicBook::whereHas('book', function ($bookQuery) use ($sellerId) {
            $bookQuery->where('seller_id', $sellerId);
        })->count();
    }

    private function getTotalPhysicalBooks($sellerId)
    {
        return PhysicalBook::whereHas('book', function ($bookQuery) use ($sellerId) {
            $bookQuery->where('seller_id', $sellerId);
        })->count();
    }

    private function getTotalOrders($sellerId)
    {
        return Order::whereHas('electronicBook', function ($electronicBookQuery) use ($sellerId) {
            $electronicBookQuery->whereHas('book', function ($bookQuery) use ($sellerId) {
                $bookQuery->where('seller_id', $sellerId);
            });
        })
            ->count();
    }

    private function getTotalRevenue($sellerId)
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
