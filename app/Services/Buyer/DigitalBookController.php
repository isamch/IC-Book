<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ElectronicBook;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if ($offset > 1000) {
            return response()->json(['message' => 'Too many requests'], 429);
        }

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
                if (!empty($category)) {
                    $categories = explode(',', $category);

                    if (!in_array('all-categories', $categories)) {
                        $categories = array_map('strtolower', $categories);

                        $query->whereHas('categories', function ($categoryQuery) use ($categories) {
                            $categoryQuery->whereIn(DB::raw('LOWER(name)'), $categories);
                        });
                    }
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






    // other :

    public function show(int $id)
    {

        $electronicBook = ElectronicBook::with(['reviews' => function ($query) {
            $query->orderBy('rating', 'desc');
        }])->findOrFail($id);

        try {

            $this->authorize('viewBuyer', $electronicBook->book);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {

            return redirect()->route('buyer.books.index')->withErrors(['You are not authorized to view this book.']);
        }

        $hasRating = $this->hasRating($electronicBook);


        return view('buyer.digital-books.view', compact('electronicBook', 'hasRating'));
    }



    private function hasRating(ElectronicBook $electronicBook)
    {
        $buyer = Auth::user()->buyer;

        if (!$buyer) {
            return false;
        }

        return $electronicBook->reviews()
            ->where('buyer_id', $buyer->id)
            ->exists();
    }



    // createReview
    public function createReview(Request $request, int $id)
    {

        $request->validate([
            'selectedRating' => 'nullable|integer|between:1,5',
            'comment' => 'required|string|max:1000',
        ]);


        $electronicBook = ElectronicBook::findOrFail($id);

        if ($this->hasRating($electronicBook)) {
            return response()->json([
                'success' => false,
                'message' => 'You have already submitted a review for this book.',
            ], 400);
        }


        $review = $electronicBook->reviews()->create([
            'rating' => $request->selectedRating,
            'comment' => $request->comment,
            'electronic_book_id' => $id,
            'buyer_id' => Auth::user()->buyer->id,
        ]);


        return response()->json(['success' => true, 'review' => $review]);
    }













}
