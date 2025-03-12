<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'book_id',
    ];

    // relations:
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'electronic_book_id');
    }


}
