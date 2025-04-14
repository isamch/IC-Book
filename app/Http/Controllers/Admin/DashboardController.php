<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhysicalBook;
use App\Models\ElectronicBook;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {
        [$totalUsers, $userGrowth] = $this->totalUsers();
        [$totalPhysicalBooks, $physicalBookGrowth] = $this->totalPhysicalBooks();
        [$totalDigitalBooks, $digitalBookGrowth] = $this->totalDigitalBooks();
        [$totalOrders, $ordersGrowth] = $this->totalOrders();


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



    // get analys:

    // Total Users
    private function totalUsers()
    {
        $lastMonthUsers = User::whereMonth('created_at', now()->subMonth()->month)->count();
        $currentUsers = User::count();

        $userGrowth = 0;
        if ($lastMonthUsers > 0) {
            $userGrowth = (($currentUsers - $lastMonthUsers) / $lastMonthUsers) * 100;
        }

        return [$currentUsers, $userGrowth];
    }


    // Total Users
    private function totalPhysicalBooks()
    {

        $lastMonthPhysicalBooks = PhysicalBook::whereMonth('created_at', now()->subMonth()->month)->count();
        $currentPhysicalBooks = PhysicalBook::count();

        $physicalBookGrowth = 0;
        if ($lastMonthPhysicalBooks > 0) {
            $physicalBookGrowth = (($currentPhysicalBooks - $lastMonthPhysicalBooks) / $lastMonthPhysicalBooks) * 100;
        }

        return [$currentPhysicalBooks, $physicalBookGrowth];
    }


    // Total Users
    private function totalDigitalBooks()
    {
        $lastMonthDigitalBooks = ElectronicBook::whereMonth('created_at', now()->subMonth()->month)->count();
        $currentDigitalBooks = ElectronicBook::count();

        $digitalBookGrowth = 0;
        if ($lastMonthDigitalBooks > 0) {
            $digitalBookGrowth = (($currentDigitalBooks - $lastMonthDigitalBooks) / $lastMonthDigitalBooks) * 100;
        }

        return [$currentDigitalBooks, $digitalBookGrowth];
    }



    // Total Users
    private function totalOrders()
    {
        $lastMonthOrders = Order::whereMonth('created_at', now()->subMonth()->month)->count();
        $currentOrders = Order::count();

        $ordersGrowth = 0;
        if ($lastMonthOrders > 0) {
            $ordersGrowth = (($currentOrders - $lastMonthOrders) / $lastMonthOrders) * 100;
        }

        return [$currentOrders, $ordersGrowth];
    }
}
