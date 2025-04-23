<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\PhysicalBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MarketplaceBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $physicalBooks = PhysicalBook::whereHas('book', function ($query) {
            $query->where('seller_id', Auth::user()->seller->id);
        })->paginate(3);

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

        $request->validate([
            'images' => 'required|array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,svg,avif|max:2048',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:10|max:1000',
            'location' => 'required|string|min:3|max:255',
        ]);


        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'price' => $request->price,
            'seller_id' => Auth::user()->seller->id,
        ]);

        $physicalBook = PhysicalBook::create([
            'location' => $request->location,
            'book_id' => $book->id,
        ]);



        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images/books/physical', 'public');
                $book->images()->create([
                    'image' => $imagePath,
                    'book_id' => $book->id,
                ]);
            }
        }

        return redirect()->route('seller.marketplace.books.show', $physicalBook->id)->with('success', 'Digital book created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $physicalBook = PhysicalBook::findOrFail($id);
        try {

            $this->authorize('view', $physicalBook->book);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return redirect()->back()->withErrors(['You are not authorized to view this book.']);
        }
        return view('seller.marketplace.books.view', compact('physicalBook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $physicalBook = PhysicalBook::findOrFail($id);

        try {

            $this->authorize('update', $physicalBook->book);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return redirect()->back()->withErrors(['You are not authorized to edit this book.']);
        }

        return view('seller.marketplace.books.edit', compact('physicalBook'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $request->validate([
            'images' => 'nullable|array|max:4',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,svg,avif|max:2048',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:10|max:1000',
            'location' => 'required|string|min:3|max:255',
        ]);



        $physicalBook = PhysicalBook::findOrFail($id);

        try {

            $this->authorize('update', $physicalBook->book);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return redirect()->back()->withErrors(['You are not authorized to update this book.']);
        }

        $physicalBook->book->update([
            'title' => $request->title,
            'author' => $request->author,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $physicalBook->update([
            'location' => $request->location,
        ]);



        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $index => $image) {

                if ($index < 4 && $physicalBook->book->images->count() <= 4) {
                    $path = $image->store('images/books/physical', 'public');

                    if (isset($physicalBook->book->images[$index])) {
                        $physicalBook->book->images[$index]->update(['image' => $path]);
                    } else {
                        $physicalBook->book->images()->create(['image' => $path]);
                    }
                }
            }
        }


        return redirect()->route('seller.marketplace.books.show', $id)->with('success', 'Book updated successfully!');




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $physicalBook = PhysicalBook::findOrFail($id);

        $this->authorize('delete', $physicalBook->book);

        $physicalBook->delete();
        $physicalBook->book->delete();

        return redirect()->route('seller.marketplace.books.index')->with('success', 'Book deleted successfully!');
    }

}
