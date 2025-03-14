<?php

namespace App\Repositories;

use App\Models\Buyer;

class BuyerRepository
{

    public function create(array $data)
    {
        return Buyer::create($data);
    }


}
