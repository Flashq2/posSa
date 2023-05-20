<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saleline extends Model
{
    protected $table="sales_lines";
     protected $primaryKey = 'id';
    public $incrementing = false;
    use HasFactory;
}
