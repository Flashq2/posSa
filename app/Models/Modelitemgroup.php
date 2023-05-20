<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelitemgroup extends Model
{
    protected $table="item_groups";
    protected $primaryKey = 'code';
    public $incrementing = false;
    use HasFactory;
}
