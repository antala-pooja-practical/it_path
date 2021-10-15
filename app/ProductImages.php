<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;

class ProductImages extends Model
{
   
    public $table = 'product_images';
    use SoftDeletes;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
