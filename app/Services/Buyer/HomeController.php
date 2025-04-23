<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\ElectronicBook;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function index()
    {

        $elecBookOfTheMonth = ElectronicBook::selectRaw('electronic_books.*, SUM(rating) as total_rating')
            ->join('reviews', 'electronic_book_id', '=', 'electronic_books.id')
            ->groupBy('electronic_books.id')
            ->orderBy('total_rating', 'desc')
            ->take(1)
            ->first();


        $topElecBooks = ElectronicBook::selectRaw('electronic_books.*, COALESCE(SUM(rating), 0) as total_rating')
            ->leftjoin('reviews', 'electronic_book_id', '=', 'electronic_books.id')
            ->leftjoin('books', 'books.id', '=', 'electronic_books.id')
            ->where('books.status', true)
            // ->whereHas('Book', function($query){
                //     $query->where('status', true);
                // })
            ->groupBy('electronic_books.id')
            ->orderBy('total_rating', 'desc')
            ->take(10)
            ->get();


        return view('buyer.home', compact('topElecBooks', 'elecBookOfTheMonth'));
    }
}
