<?php

namespace App\Services\Seller;

use App\Models\Book;
use App\Models\ElectronicBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Seller\DigitalBookRepository;

class DigitalBookService
{

    protected $digitalBookRepository;

    public function __construct(DigitalBookRepository $digitalBookRepository)
    {
        $this->digitalBookRepository = $digitalBookRepository;
    }


    public function getSellerElectronicBooks()
    {
        return $this->digitalBookRepository->getSellerElectronicBooks();
    }


    public function getSellerElectronicBookById($id)
    {
        return $this->digitalBookRepository->getSellerElectronicBookById($id);
    }


    public function storeDigitalBook(Request $request)
    {
        return $this->digitalBookRepository->storeDigitalBook($request);
    }


    public function updateSellerDigitalBook(Request $request, $id)
    {
        return $this->digitalBookRepository->updateSellerDigitalBook($request, $id);
    }


    public function deleteSellerElectronicBook(int $id)
    {
        return $this->digitalBookRepository->deleteSellerElectronicBook($id);
    }
}
