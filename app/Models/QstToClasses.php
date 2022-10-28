<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QstToClasses extends Model
{
    use HasFactory;
    protected $table = "qst_to_classes";
    public $timestamps = false;
    protected $fillable = [
        "qst",
        "class_id",
        "type",
        "org_id",
    ];
}
