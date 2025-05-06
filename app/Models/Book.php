<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'seller_id',
        'status',
    ];


    // relations:
    public function images()
    {
        return $this->hasMany(BookImage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function electronicBook()
    {
        return $this->hasOne(ElectronicBook::class);
    }

    public function physicalBooks()
    {
        return $this->hasOne(PhysicalBook::class);
    }
}
