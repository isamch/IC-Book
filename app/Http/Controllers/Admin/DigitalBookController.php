<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ElectronicBook;
use Illuminate\Http\Request;

class DigitalBookController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny');

        $electronicBooks = ElectronicBook::paginate(3);

        return view('admin.books.digital.index', compact('electronicBooks'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $electronicBook = ElectronicBook::findOrFail($id);
        $this->authorize('view', $electronicBook->book);

        return view('admin.books.digital.view', compact('electronicBook'));
    }


    /**
     * Toggle the active status of the specified resource.
     */
    public function toggleStatus($id)
    {
        $electronicBook = ElectronicBook::findOrFail($id);

        $this->authorize('toggle');

        $electronicBook->book->status = !$electronicBook->book->status;

        $electronicBook->book->save();

        return redirect()->back()->with('success', 'The status of the book "' . $electronicBook->book->title . '" by seller ' . $electronicBook->book->seller->name . ' has been updated successfully.');
    }


}
