<?php

namespace App\Services\Admin;

use App\Models\PhysicalBook;

class MarketplaceBookService
{
    public function getAllBooks()
    {
        return PhysicalBook::paginate(3);
    }

    public function getBookById($id)
    {
        return PhysicalBook::findOrFail($id);
    }

    public function toggleBookStatus($id)
    {
        $physicalBook = PhysicalBook::findOrFail($id);

        $physicalBook->book->status = !$physicalBook->book->status;
        $physicalBook->book->save();

        return $physicalBook;
    }
}
