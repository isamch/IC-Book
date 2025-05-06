<?php

namespace App\Services\Admin;

use App\Models\ElectronicBook;

class DigitalBookService
{

    public function getAllBooks()
    {
        return ElectronicBook::paginate(3);
    }

    public function getBookById($id)
    {
        return ElectronicBook::findOrFail($id);
    }

    public function toggleBookStatus($id)
    {
        $electronicBook = ElectronicBook::findOrFail($id);
        $electronicBook->book->status = !$electronicBook->book->status;
        $electronicBook->book->save();

        return $electronicBook;
    }
}
