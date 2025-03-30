<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ElectronicBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DigitalBookController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $electronicBooks = $this->fetchBooks();

        return view('buyer.digital-books.index', compact('electronicBooks', 'categories'));
    }


    public function loadMore(Request $request, int $offset)
    {
        $electronicBooks = $this->fetchBooks($request, $offset);
        $view = view('buyer.digital-books.components.card', compact('electronicBooks'))->render();

        return response(['html' => $view], 200, ['Content-Type' => 'text/html']);
    }


    public function applyFilter(Request $request)
    {
        $electronicBooks = $this->fetchBooks($request);

        if ($request->expectsJson()) {
            $view = view('buyer.digital-books.components.card', compact('electronicBooks'))->render();
            return response(['html' => $view], 200, ['Content-Type' => 'text/html']);
        }

        $categories = Category::all();
        return view('buyer.digital-books.index', compact('electronicBooks', 'categories'));
    }


    /**
     * Fetch books with applied filters.
     */
    private function fetchBooks(?Request $request = null, int $offset = 0)
    {


        if ($request) {
            $rating = $request->input('rating', null);
        } else {
            $rating = null;
        }

        return  ElectronicBook::whereHas('book', function ($query) use ($request) {

            if ($request) {
                $search = strtolower($request->input('search'));
                $category = strtolower($request->input('category'));
                $price = $request->input('price');
                $rating = $request->input('rating', null);


                // Search Filter
                if (!empty($search)) {
                    $query->whereRaw('LOWER(title) LIKE ?', ["%$search%"])
                        ->orWhereRaw('LOWER(author) LIKE ?', ["%$search%"])
                        ->orWhereRaw('LOWER(description) LIKE ?', ["%$search%"]);
                }

                // Category Filter
                if (!empty($category) && $category !== 'all-categories') {

                    $categories = explode(',', $category);

                    $categories = array_map('strtolower', $categories);

                    $query->whereHas('categories', function ($categoryQuery) use ($categories) {
                        foreach ($categories as $category) {
                            $categoryQuery->orWhere(function ($query) use ($category) {
                                $query->whereRaw('LOWER(name) = ?', [$category]);
                            });
                        }
                    });
                }


                // Price Filter
                if (!empty($price) && $price !== 'all-prices') {
                    [$minPrice, $maxPrice] = explode('-', $price);
                    $query->whereBetween('price', [(int) $minPrice, (int) ($maxPrice === '999999' ? PHP_INT_MAX : $maxPrice)]);
                }
            }


            $query->where('status', 1);
        })
            ->selectRaw('electronic_books.*, COALESCE(AVG(rating), 0) as total_rating')
            ->leftJoin('reviews', 'electronic_book_id', '=', 'electronic_books.id')
            ->groupBy('electronic_books.id')
            ->when($rating, function ($query) use ($rating) {
                return $query->havingRaw('AVG(rating) >= ?', [$rating]);
            })
            ->orderBy('total_rating', 'desc')
            ->skip($offset)
            ->take(2)
            ->get();
    }
}
