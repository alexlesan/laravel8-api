<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        "product_name", "barcode", "sku", "ean13", "asin", "isbn", "price", "stock"
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


