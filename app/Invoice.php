<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable=['invoice_name','subtotal','tax','total'];
    
    public function items(){
        return $this->hasMany('App\Item','invoice_id','id');
    }
}
