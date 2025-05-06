<?php

namespace App\Repositories\Eloquent;

use App\Models\Seller;

class SellerRepository
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
