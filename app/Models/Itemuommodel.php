<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itemuommodel extends Model
{
    protected $table="item_unit_of_measures";
     protected $primaryKey = "id";
    public $incrementing = false;
    use HasFactory;
}
