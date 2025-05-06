<?php

namespace App\Repositories\Eloquent\Auth;

use App\Models\Buyer;
use App\Repositories\Interfaces\Auth\BuyerRepositoryInterface;


class BuyerRepository implements BuyerRepositoryInterface
{


    public function all()
    {
        return Buyer::all();
    }

    public function find($id)
    {
        return Buyer::findOrFail($id);
    }

    public function create(array $data)
    {
        return Buyer::create($data);
    }

    public function update($id, array $data)
    {
        $item = Buyer::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        return Buyer::destroy($id);
    }


}
