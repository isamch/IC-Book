<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DigitalBookService as AdminDigitalBookService;
use App\Services\DigitalBookService;
use Illuminate\Http\Request;

class DigitalBookController extends Controller
{
    protected $digitalBookService;

    public function __construct(AdminDigitalBookService $digitalBookService)
    {
        $this->digitalBookService = $digitalBookService;
    }


    public function index()
    {
        // $this->authorize('viewAny');

        $electronicBooks = $this->digitalBookService->getAllBooks();

        return view('admin.books.digital.index', compact('electronicBooks'));
    }


    public function show($id)
    {
        $electronicBook = $this->digitalBookService->getBookById($id);

        // $this->authorize('view', $electronicBook->book);

        return view('admin.books.digital.view', compact('electronicBook'));
    }

    public function toggleStatus($id)
    {
        $electronicBook = $this->digitalBookService->toggleBookStatus($id);

        return redirect()->back()->with('success', 'The status of the book "' . $electronicBook->book->title . '" by seller ' . $electronicBook->book->seller->name . ' has been updated successfully.');
    }
}
