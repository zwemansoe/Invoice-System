<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable=['invoice_name','item_name','count_item','price','total'];
}
