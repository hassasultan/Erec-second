<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qst extends Model
{
    use HasFactory;
    protected $table = "qst";
    public $timestamps = false;
    protected $fillable = [
        "number",
        "name",
        "questions",
        "marks",
        "random_q",
        "random_order",
        "u_id",
        "type",
        "weight",
        "org_id",
        "branching",
    ];
}
