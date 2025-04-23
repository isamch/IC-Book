<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\MarketplaceBookService as AdminMarketplaceBookService;
use App\Services\MarketplaceBookService;
use Illuminate\Http\Request;

class MarketplaceBookController extends Controller
{
    protected $marketplaceBookService;

    public function __construct(AdminMarketplaceBookService $marketplaceBookService)
    {
        $this->marketplaceBookService = $marketplaceBookService;
    }


    public function index()
    {
        // $this->authorize('viewAny');

        $physicalBooks = $this->marketplaceBookService->getAllBooks();

        return view('admin.marketplace.books.index', compact('physicalBooks'));
    }


    public function show($id)
    {
        $physicalBook = $this->marketplaceBookService->getBookById($id);

        // $this->authorize('view', $physicalBook->book);

        return view('admin.marketplace.books.view', compact('physicalBook'));
    }


    public function toggleStatus($id)
    {
        $physicalBook = $this->marketplaceBookService->toggleBookStatus($id);

        return redirect()->back()->with('success', 'Book status updated successfully.');
    }
}
