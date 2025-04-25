<?php

namespace App\Repositories\Eloquent\Seller;

use App\Models\ElectronicBook;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Interfaces\Seller\DigitalBookInterface;
use Illuminate\Http\Request;


class DigitalBookRepository implements DigitalBookInterface
{

    public function getSellerElectronicBooks()
    {
        return ElectronicBook::whereHas('book', function ($query) {
            $query->where('seller_id', Auth::user()->seller->id);
        })
            ->orderBy('created_at', 'desc')
            ->paginate(3);
    }

    public function getSellerElectronicBookById($id)
    {
        return ElectronicBook::whereHas('book', function ($query) {
            $query->where('seller_id', Auth::user()->seller->id);
        })->findOrFail($id);
    }


    public function storeDigitalBook(Request $request)
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

        $bookFilePath = $request->file('book_file')->storeAs(
            'files/books/pdf',
            uniqid() . '_' . $request->file('book_file')->getClientOriginalName(),
            'public'
        );

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

        return $electronicBook;
    }


    public function updateSellerDigitalBook(Request $request, $id)
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

        $electronicBook = $this->getSellerElectronicBookById($id);

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

        return $electronicBook;
    }



    public function deleteSellerElectronicBook(int $id)
    {
        $electronicBook = $this->getSellerElectronicBookById($id);

        if (Storage::disk('public')->exists($electronicBook->file)) {
            Storage::disk('public')->delete($electronicBook->file);
        }

        $electronicBook->delete();
        $electronicBook->book->delete();

        return true;
    }
}
