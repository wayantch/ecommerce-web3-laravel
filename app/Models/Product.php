<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'image',
    ];

    // Menyusun URL gambar yang benar
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => asset('storage/images/' . $image), // URL harus dimulai dengan 'storage/' dan bukan 'public/storage/'
        );
    }
}
