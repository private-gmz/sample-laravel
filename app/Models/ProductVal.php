<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    }

    public function val(){
    	return $this->belongsTo(AttributesVal::class,'val_id','id');
    }
}
