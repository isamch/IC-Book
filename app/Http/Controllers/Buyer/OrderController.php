<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\ElectronicBook;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Buyer\OrderService as BuyerOrderService;


class OrderController extends Controller
{


    protected $orderService;

    public function __construct(BuyerOrderService $orderService)
    {
        $this->orderService = $orderService;
    }


    public function index()
    {
        $user = Auth::user();
        $orders = $this->orderService->getUserOrders($user);
        return view('buyer.digital-books.orders.order', compact('orders', 'user'));
    }




    public function show($id)
    {
        $user = Auth::user();
        $electronicBook = $this->orderService->show($user, $id);
        return view('buyer.digital-books.orders.view', compact('electronicBook', 'user'));
    }





    // preview book:
    public function preview($id)
    {
        $ElectronicBook = $this->orderService->preview($id);

        if (!$ElectronicBook) {
            return redirect()->route('buyer.books.show', $id)->withErrors(['You need to Buy this book to access the preview.']);
        }
        return view('buyer.digital-books.preview', [
            'ElectronicBook' => $ElectronicBook,
        ]);
    }


}
