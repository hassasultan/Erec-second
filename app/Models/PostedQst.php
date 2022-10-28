<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostedQst extends Model
{
    use HasFactory;
    protected $table = "posted_qst";
    public $timestamps = false;
    protected $fillable = [
        "qst",
        "attempts",
        "start",
        "end",
        "class_id",
        "result",
        "submissions",
        "rhm",
        "forall",
        "u_id",
        "posted",
        "org_id",
        "avail",
        "start_month",
        "start_day",
        "start_hour",
        "finish_month",
        "finish_day",
        "finish_hour",
        "qtime",
        "delivery",
        "branching",
        "shuffle",
        "display",
        "shuffle_ans",
    ];
}
