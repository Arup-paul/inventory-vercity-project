<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Customers;

class Payment extends Model
{
    protected $guarded =[];

    public function customer(){
        return $this->belongsTo(Customers::class,'customer_id','id');
    }
    
  
}