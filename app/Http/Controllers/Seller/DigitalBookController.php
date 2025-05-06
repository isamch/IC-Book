<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\ElectronicBook;
use App\Services\Seller\DigitalBookService as SellerDigitalBookService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DigitalBookController extends Controller
{

    protected $digitalBookService;

    public function __construct(SellerDigitalBookService $digitalBookService)
    {
        $this->digitalBookService = $digitalBookService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $electronicBooks = $this->digitalBookService->getSellerElectronicBooks();
        return view('seller.books.digital.index', compact('electronicBooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Book::class);
        return view('seller.books.digital.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->authorize('create', Book::class);

        $electronicBook = $this->digitalBookService->storeDigitalBook($request);

        return redirect()->route('seller.books.show', $electronicBook->id)->with('success', 'Digital book created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $electronicBook = $this->digitalBookService->getSellerElectronicBookById($id);
        return view('seller.books.digital.view', compact('electronicBook'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $electronicBook = $this->digitalBookService->getSellerElectronicBookById($id);
        return view('seller.books.digital.edit', compact('electronicBook'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $electronicBook = $this->digitalBookService->updateSellerDigitalBook($request, $id);
        if ($electronicBook) {
            return redirect()->route('seller.books.show', $id)->with('success', 'Book updated successfully!');
        } else {
            return redirect()->route('seller.books.show', $id)->withErrors(['Failed to update the book.']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resultDelete = $this->digitalBookService->deleteSellerElectronicBook($id);
        if ($resultDelete) {
            return redirect()->route('seller.books.index')->with('success', 'Book deleted successfully!');
        } else {
            return redirect()->route('seller.books.index')->with('success', 'Failed to the Book!');
        }
    }
}
