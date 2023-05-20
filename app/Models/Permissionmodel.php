<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissionmodel extends Model
{
    protected $table="permissions";
    protected $primaryKey = 'code';
    public $incrementing = false;
    use HasFactory;
}
