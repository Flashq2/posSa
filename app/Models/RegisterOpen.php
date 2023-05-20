<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterOpen extends Model
{
    protected $table="register_open";
    protected $primaryKey = 'id';
    public $incrementing = false;
    use HasFactory;
}
