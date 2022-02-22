<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Supplier;
use App\Model\Unit;
use App\Model\Category;
use App\Model\Product;

class Purchase extends Model
{
    protected $guarded =[];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
