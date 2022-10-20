<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewUserClasses extends Model
{
    use HasFactory;
    protected $table = "class_users";
    public $timestamps = false;
    protected $fillable = [
        "u_id",
        "class_id",
        "org_id",
    ];
}
