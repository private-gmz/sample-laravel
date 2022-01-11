<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributesVal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function attribute(){
    	return $this->belongsTo(Attributes::class,'attribute_id','id');
    }
}
