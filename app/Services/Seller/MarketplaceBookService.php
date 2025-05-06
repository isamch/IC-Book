<?php

namespace App\Services\Seller;

use App\Models\Book;
use App\Models\PhysicalBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class MarketplaceBookService
{
    public function getSellerPhysicalBooks()
    {
        return PhysicalBook::whereHas('book', function ($query) {
            $query->where('seller_id', Auth::user()->seller->id);
        })
            ->orderBy('created_at', 'desc')
            ->paginate(3);
    }




    public function getSellerPhysicalBookById(int $id)
    {
        return PhysicalBook::whereHas('book', function ($query) {
            $query->where('seller_id', Auth::user()->seller->id);
        })->findOrFail($id);
    }



    public function storePhysicalBook(Request $request)
    {

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

        return $physicalBook;
    }



    public function updatePhysicalBook(Request $request, string $id)
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



        $physicalBook = $this->getSellerPhysicalBookById($id);


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


        return $physicalBook;
    }


    public function deleteSellerPhysicalBook(int $id)
    {

        $physicalBook = $this->getSellerPhysicalBookById($id);

        $physicalBook->delete();
        $physicalBook->book->delete();

        return true;
    }
}
