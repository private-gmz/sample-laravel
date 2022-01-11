<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AttributesVal;

class Attributes extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function values()
    {
    	return $this->hasMany(AttributesVal::class,'attribute_id','id');
    }

}
