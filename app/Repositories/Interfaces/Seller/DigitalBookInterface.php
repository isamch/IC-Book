<?php

namespace App\Repositories\Interfaces\Seller;

use Illuminate\Http\Request;


interface DigitalBookInterface
{

    public function getSellerElectronicBooks();

    public function getSellerElectronicBookById($id);

    public function storeDigitalBook(Request $request);

    public function updateSellerDigitalBook(Request $request, $id);

    public function deleteSellerElectronicBook(int $id);
}
