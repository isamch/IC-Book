<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\ElectronicBook;
use Illuminate\Http\Request;

class DigitalBookController extends Controller
{

    public function index()
    {

        $electronicBooks = ElectronicBook::whereHas('book', function ($query) {
            $query->where('status', 1);
        })
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('buyer.digital-books.index', compact('electronicBooks'));
    }


    public function loadMore(int $offset)
    {



        $electronicBooks = ElectronicBook::whereHas('book', function ($query) {
            $query->where('status', 1);
        })
            ->orderBy('id', 'asc')
            ->skip(($offset))
            ->take(2)
            ->get();

        // dd($electronicBooks);

        return response()->json($electronicBooks);
    }
}
