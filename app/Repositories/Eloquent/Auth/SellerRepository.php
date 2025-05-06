<?php

namespace App\Repositories\Eloquent\Auth;

use App\Models\Seller;
use App\Repositories\Interfaces\Auth\SellerRepositoryInterface;

class SellerRepository implements SellerRepositoryInterface
{

    public function all()
    {
        return Seller::all();
    }

    public function find($id)
    {
        return Seller::findOrFail($id);
    }

    public function create(array $data)
    {
        return Seller::create($data);
    }

    public function update($id, array $data)
    {
        $item = Seller::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        return Seller::destroy($id);
    }



}
