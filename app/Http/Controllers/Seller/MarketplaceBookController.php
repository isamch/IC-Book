<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\PhysicalBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\Seller\MarketplaceBookService as SellerMarketplaceBookService;


class MarketplaceBookController extends Controller
{

    protected $marketplaceBookService;

    public function __construct(SellerMarketplaceBookService  $marketplaceBookService)
    {
        $this->marketplaceBookService = $marketplaceBookService;
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $physicalBooks = $this->marketplaceBookService->getSellerPhysicalBooks();
        return view('seller.marketplace.books.index', compact('physicalBooks'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Book::class);

        return view('seller.marketplace.books.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->authorize('create', Book::class);

        $physicalBook = $this->marketplaceBookService->storePhysicalBook($request);

        return redirect()->route('seller.marketplace.books.show', $physicalBook->id)->with('success', 'Digital book created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $physicalBook = $this->marketplaceBookService->getSellerPhysicalBookById($id);
        return view('seller.marketplace.books.view', compact('physicalBook'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $physicalBook = $this->marketplaceBookService->getSellerPhysicalBookById($id);
        return view('seller.marketplace.books.edit', compact('physicalBook'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $physicalBook = $this->marketplaceBookService->updatePhysicalBook($request, $id);
        if ($physicalBook) {
            return redirect()->route('seller.marketplace.books.show', $id)->with('success', 'Book updated successfully!');
        } else {
            return redirect()->route('seller.marketplace.books.show', $id)->withErrors(['Failed to update the book.']);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resultDelete = $this->marketplaceBookService->deleteSellerPhysicalBook($id);
        if ($resultDelete) {
            return redirect()->route('seller.marketplace.books.index')->with('success', 'Book deleted successfully!');
        } else {
            return redirect()->route('seller.marketplace.books.index')->with('success', 'Failed to the Book!');
        }
    }
}
