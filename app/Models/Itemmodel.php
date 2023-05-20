<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Itemmodel extends Model
{
    protected $table="items";
     protected $primaryKey = "no";
    public $incrementing = false;

    // public function limit()
    // {
    //     return Str::limit($this->unit_price, 3 );
    // }
    use HasFactory;
}
