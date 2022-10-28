<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QstAttempts extends Model
{
    use HasFactory;
    protected $table = "qst_attempts";
    public $timestamps = false;
    protected $fillable = [
        "qst_no",
        "u_id",
        "attempts",
        "org_id",
        "start_time",
        "start_day",
        "start_month",
        "finish_time",
        "finish_day",
        "finish_month",
        "end",
        "resume",
    ];
}
