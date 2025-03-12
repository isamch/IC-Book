<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'status',
        'total_price',
        'buyer_id',
        'electronic_book_id',
    ];


    // relations:
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function electronicBook()
    {
        return $this->belongsTo(ElectronicBook::class, 'electronic_book_id');
    }

}
