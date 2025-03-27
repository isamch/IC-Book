<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhysicalBook;
use Illuminate\Http\Request;

class MarketplaceBookController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny');

        $physicalBooks = PhysicalBook::paginate(3);
        return view('admin.marketplace.books.index', compact('physicalBooks'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $physicalBook = PhysicalBook::findOrFail($id);

        // $this->authorize('view', $physicalBook->book);

        return view('admin.marketplace.books.view', compact('physicalBook'));
    }


    /**
     * Toggle the active status of the specified resource.
     */
    public function toggleStatus($id)
    {
        $physicalBook = PhysicalBook::findOrFail($id);

        // $this->authorize('toggle');

        $physicalBook->book->status = !$physicalBook->book->status;

        $physicalBook->book->save();

        return redirect()->back()->with('success', 'Book status updated successfully.');
    }
}
