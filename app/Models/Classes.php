<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table = "classes";
    public $timestamps = false;
    protected $fillable = [
        "class_name",
        "org_id",
        "session_id",
        "institution_id",
    ];
}
