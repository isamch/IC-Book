<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalBook extends Model
{
    use HasFactory;
    // 'book_id',
    protected $fillable = [
        'location',
        'book_id',
    ];


    // relations:
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

}
