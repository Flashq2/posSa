<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modeluserrole extends Model
{
    protected $table="user_roles";
    protected $primaryKey = 'code';
    public $incrementing = false;
    use HasFactory;
}
