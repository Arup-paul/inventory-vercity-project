<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Supplier;
use App\Model\Unit;
use App\Model\Category;

class Product extends Model
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
}
