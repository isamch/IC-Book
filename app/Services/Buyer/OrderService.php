<?php

namespace App\Services\Buyer;

use App\Models\Order;
use App\Models\ElectronicBook;
use Illuminate\Support\Facades\Auth;

class OrderService
{

    public function getUserOrders($user)
    {
        return Order::where('buyer_id', $user->buyer->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    public function show($user, $id)
    {
        return ElectronicBook::whereHas('orders', function ($query) use ($user) {
            $query->where('buyer_id', $user->buyer->id);
        })
            ->where('id', $id)
            ->firstOrFail();
    }




    // preview book:
    public function preview($id)
    {
        if (!$this->checkIfAlreadyBuyBook($id)) {
            return false;
        }
        return ElectronicBook::findOrFail($id);
    }



    private function checkIfAlreadyBuyBook($id)
    {
        $user = Auth::user();
        $hasBuyBook = Order::where('buyer_id', $user->buyer->id)
            ->where('electronic_book_id', $id)
            ->where('status', 'completed')
            ->exists();

        return $hasBuyBook;
    }
}
