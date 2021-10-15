<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ProductImages;

class Product extends Model
{
   
    public $table = 'products';
    use SoftDeletes;
    
    protected $fillable = ['title', 'category_id', 'price','order'];
    
    public function productImages()
    {
        return $this->hasMany(ProductImages::class);
    }
    
}
