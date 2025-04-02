<?php


namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PhysicalBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarketplaceBookController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $locations = PhysicalBook::pluck('location')->unique();
        $physicalBooks = $this->fetchBooks();

        return view('buyer.marketplace-books.index', compact('physicalBooks', 'categories', 'locations'));
    }


    public function loadMore(Request $request, int $offset)
    {

        if ($offset > 1000) {
            return response()->json(['message' => 'Too many requests'], 429);
        }

        $physicalBooks = $this->fetchBooks($request, $offset);

        $view = view('buyer.marketplace-books.components.card', compact('physicalBooks'))->render();

        return response(['html' => $view], 200, ['Content-Type' => 'text/html']);
    }

    public function applyFilter(Request $request)
    {
        $physicalBooks = $this->fetchBooks($request);

        if ($request->expectsJson()) {
            $view = view('buyer.marketplace-books.components.card', compact('physicalBooks'))->render();
            return response(['html' => $view], 200, ['Content-Type' => 'text/html']);
        }

        $categories = Category::all();
        $locations = PhysicalBook::pluck('location')->unique();
        return view('buyer.marketplace-books.index', compact('physicalBooks', 'categories', 'locations'));
    }


    /**
     * Fetch books with applied filters.
     */
    private function fetchBooks(?Request $request = null, int $offset = 0)
    {
        $search = $request ? strtolower($request->input('search')) : null;
        $category = $request ? strtolower($request->input('category')) : null;
        $price = $request ? $request->input('price') : null;
        $location = $request ? $request->input('location') : null;

        // dd($request);

        return PhysicalBook::whereHas('book', function ($query) use ($search, $category, $price) {

            // Search Filter
            if ($search) {
                $query->whereRaw('LOWER(title) LIKE ?', ["%$search%"])
                    ->orWhereRaw('LOWER(author) LIKE ?', ["%$search%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%$search%"]);
            }

            // Category Filter
            if ($category && $category !== 'all-categories') {

                $categories = explode(',', $category);


                $categories = array_map('strtolower', $categories);

                $query->whereHas('categories', function ($categoryQuery) use ($categories) {

                    $categoryQuery->whereIn(DB::raw('LOWER(name)'), $categories);
                });
            }


            // Price Filter
            if ($price && $price !== 'all-prices') {
                [$minPrice, $maxPrice] = explode('-', $price);
                $query->whereBetween('price', [(int) $minPrice, (int) ($maxPrice === '999999' ? PHP_INT_MAX : $maxPrice)]);
            }

            $query->where('status', 1);
        })
            ->when($location, function ($query) use ($location) {

                if (!empty($location) && $location !== 'All-location') {
                    $query->whereRaw('LOWER(location) = ?', [strtolower($location)]);
                }
            })
            ->orderBy('updated_at', 'desc')
            ->skip($offset)
            ->take(2)
            ->get();
    }
















    // get view book:
    public function show(int $id)
    {

        $physicalBook = PhysicalBook::findOrFail($id);

        try {

            $this->authorize('viewBuyer', $physicalBook->book);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {

            return redirect()->route('buyer.marketplace.books.index')->withErrors(['You are not authorized to view this book.']);
        }

        return view('buyer.marketplace-books.view', compact('physicalBook'));
    }




}
