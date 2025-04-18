<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\ElectronicBook;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('buyer_id', $user->buyer->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);



        return view('buyer.digital-books.orders.order', compact('orders', 'user'));
    }


    public function show($id)
    {
        $user = Auth::user();
        $electronicBook = ElectronicBook::whereHas('orders', function ($query) use ($user) {
            $query->where('buyer_id', $user->buyer->id);
        })
            ->where('id', $id)
            ->firstOrFail();

        return view('buyer.digital-books.orders.view', compact('electronicBook', 'user'));
    }







    // preview book:
    public function preview($id)
    {
        try {
            $user = Auth::user();

            $ElectronicBook = ElectronicBook::findOrFail($id);

            if (!$this->checkIfAlreadyBuyBook($id)) {
                return redirect()->route('buyer.books.show', $id)->withErrors(['You need to Buy this book to access the preview.']);
            }


            return view('buyer.digital-books.preview', [
                'ElectronicBook' => $ElectronicBook,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('buyer.books.show', $id)->withErrors(['An error occurred while trying to preview the book.']);
        }
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
