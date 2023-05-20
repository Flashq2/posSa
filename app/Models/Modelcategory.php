<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelcategory extends Model
{
    protected $table="item_categorys";
    protected $primaryKey = 'code';
    public $incrementing = false;
    use HasFactory;
}
