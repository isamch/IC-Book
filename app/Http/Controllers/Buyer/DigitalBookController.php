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


    public function loadMore(Request $request, int $offset)
    {



        // $electronicBooks = ElectronicBook::with(['book.images'])
        //     ->whereHas('book', function ($query) {
        //         $query->where('status', 1);
        //     })
        //     ->orderBy('id', 'asc')
        //     ->skip(($offset))
        //     ->take(2)
        //     ->selectRaw('electronic_books.*, AVG(reviews.rating) as average_rating')
        //     ->leftJoin('reviews', 'reviews.electronic_book_id', '=', 'electronic_books.id')
        //     ->groupBy('electronic_books.id')
        //     ->get();


        // $electronicBooks = ElectronicBook::with(['book.images'])
        //     ->whereHas('book', function ($query) {
        //         $query->where('status', 1);
        //     })
        //     ->orderBy('id', 'asc')
        //     ->skip(($offset))
        //     ->take(2)
        //     ->get()
        //     ->map(function ($electronicBook) {
        //         $avgRating = $electronicBook->reviews->avg('rating');
        //         $electronicBook->argRating = number_format($avgRating, 2);
        //         unset($electronicBook->reviews);
        //         return $electronicBook;
        //     });


        $electronicBooks = ElectronicBook::whereHas('book', function ($query) {
            $query->where('status', 1);
        })
            ->orderBy('id', 'asc')
            ->skip(($offset))
            ->take(5)
            ->get();


        $view = view('buyer.digital-books.components.card', compact('electronicBooks'))->render();


        return response(['html'=> $view])->header('Content-Type', 'text/html');
    }


    public function filterBooks(Request $request){

        dd($request);


        if ($request->expectsJson()) {
            $view = view('buyer.digital-books.components.card', compact('electronicBooks'))->render();
            return response(['html'=> $view])->header('Content-Type', 'text/html');
        }

        return view('buyer.digital-books.index', compact('electronicBooks'));


    }

}
