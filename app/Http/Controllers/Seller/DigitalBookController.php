<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\ElectronicBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DigitalBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $electronicBooks = ElectronicBook::paginate(3);
        return view('seller.books.digital.index', compact('electronicBooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seller.books.digital.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        return view('seller.books.digital.view', compact('electronicBook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $electronicBook = ElectronicBook::findOrFail($id);

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


        $electronicBook->book->update([
            'title' => $request->title,
            'author' => $request->author,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $index => $image) {

                $path = $image->store('images/books/digitale', 'public');

                if (isset($electronicBook->book->images[$index])) {
                    $electronicBook->book->images[$index]->update(['image' => $path]);
                } else {
                    $electronicBook->book->images()->create(['image' => $path]);
                }
            }

        }


        if ($request->hasFile('book_file')) {

            $filePath = $request->file('book_file')->store('files/books/pdf', 'public');
            $electronicBook->file = $filePath;

        }





        return redirect()->route('seller.books.show', $id)->with('success', 'Book updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
