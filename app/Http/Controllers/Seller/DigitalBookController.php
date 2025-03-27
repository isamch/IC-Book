<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\ElectronicBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DigitalBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $electronicBooks = ElectronicBook::whereHas('book', function ($query) {
            $query->where('seller_id', Auth::user()->seller->id);
        })->paginate(3);


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

        $request->validate([
            'images' => 'required|array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,svg,avif|max:2048',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:10|max:1000',
            'book_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);


        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'price' => $request->price,
            'seller_id' => Auth::user()->seller->id,
        ]);


        $bookFilePath = $request->file('book_file')->storeAs('files/books/pdf', uniqid() . '_' . $request->file('book_file')->getClientOriginalName(), 'public');


        $electronicBook = ElectronicBook::create([
            'file' => $bookFilePath,
            'book_id' => $book->id,
        ]);


        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images/books/digitale', 'public');
                $book->images()->create([
                    'image' => $imagePath,
                    'book_id' => $book->id,
                ]);
            }
        }

        return redirect()->route('seller.books.show', $electronicBook->id)->with('success', 'Digital book created successfully.');
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $electronicBook = ElectronicBook::findOrFail($id);

        try {

            $this->authorize('view', $electronicBook->book);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {

            return redirect()->back()->withErrors(['You are not authorized to view this book.']);
        }

        return view('seller.books.digital.view', compact('electronicBook'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $electronicBook = ElectronicBook::findOrFail($id);

        try {

            $this->authorize('update', $electronicBook->book);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return redirect()->back()->withErrors(['You are not authorized to edit this book.']);
        }

        return view('seller.books.digital.edit', compact('electronicBook'));
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
            'book_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);


        $electronicBook = ElectronicBook::findOrFail($id);

        try {

            $this->authorize('update', $electronicBook->book);

        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return redirect()->back()->withErrors(['You are not authorized to update this book.']);
        }

        $electronicBook->book->update([
            'title' => $request->title,
            'author' => $request->author,
            'price' => $request->price,
            'description' => $request->description,
        ]);


        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $index => $image) {

                if ($index < 4 && $electronicBook->book->images->count() <= 4) {
                    $path = $image->store('images/books/digitale', 'public');

                    if (isset($electronicBook->book->images[$index])) {
                        $electronicBook->book->images[$index]->update(['image' => $path]);
                    } else {
                        $electronicBook->book->images()->create(['image' => $path]);
                    }
                }
            }
        }


        if ($request->hasFile('book_file')) {
            $filePath = $request->file('book_file')->storeAs('files/books/pdf', uniqid() . '__' . $request->file('book_file')->getClientOriginalName(), 'public');

            $electronicBook->update(['file' => $filePath]);
        }


        return redirect()->route('seller.books.show', $id)->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $electronicBook = ElectronicBook::findOrFail($id);

        $this->authorize('delete', $electronicBook->book);


        if (Storage::disk('public')->exists($electronicBook->file)) {
            Storage::disk('public')->delete($electronicBook->file);
        }

        $electronicBook->delete();
        $electronicBook->book->delete();

        return redirect()->route('seller.books.index')->with('success', 'Book deleted successfully!');
    }
}
