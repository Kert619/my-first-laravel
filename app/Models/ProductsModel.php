<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable =  ["product_name", "category_id", "product_price", "product_stocks"];

    public function category(){
        return $this->belongsTo(CategoriesModel::class);
    }
}