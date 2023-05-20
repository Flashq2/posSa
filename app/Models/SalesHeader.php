<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesHeader extends Model
{
    protected $table="sales_headers";
    protected $primaryKey = 'id';
    public $incrementing = false;
    use HasFactory;
}
