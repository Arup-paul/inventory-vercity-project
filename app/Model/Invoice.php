<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Payment;
use App\Model\Customers;
use App\Model\InvoiceDetail;

class Invoice extends Model
{
    protected $guarded =[];

    public function payment(){
        return $this->belongsTo(Payment::class,'id','invoice_id');
    }

    public function invoice_details(){
        return $this->hasMany(InvoiceDetail::class,'invoice_id','id');
    }
   
}
