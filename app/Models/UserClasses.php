<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClasses extends Model
{
    use HasFactory;
    protected $table = "users_classes";
    public $timestamps = false;
    protected $fillable = [
        "u_id",
        "class_id",
        "org_id",
    ];
}
