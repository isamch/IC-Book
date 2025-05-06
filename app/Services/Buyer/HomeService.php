<?php

namespace App\Services\Buyer;

use App\Models\ElectronicBook;

class HomeService
{


    public function getElectronicBookOfTheMonth()
    {
        return ElectronicBook::selectRaw('electronic_books.*, SUM(rating) as total_rating')
            ->join('reviews', 'electronic_book_id', '=', 'electronic_books.id')
            ->groupBy('electronic_books.id')
            ->orderBy('total_rating', 'desc')
            ->take(1)
            ->first();
    }

    public function getTopElectronicBooks()
    {
        return ElectronicBook::selectRaw('electronic_books.*, COALESCE(SUM(rating), 0) as total_rating')
            ->leftJoin('reviews', 'electronic_book_id', '=', 'electronic_books.id')
            ->leftJoin('books', 'books.id', '=', 'electronic_books.book_id')
            ->where('books.status', true)
            ->groupBy('electronic_books.id')
            ->orderBy('total_rating', 'desc')
            ->take(10)
            ->get();
    }
}
