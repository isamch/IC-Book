<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'electronic_book_id',
        'buyer_id',
    ];


    // relations:
    public function electronicBook()
    {
        return $this->belongsTo(ElectronicBook::class, 'electronic_book_id');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }



}
