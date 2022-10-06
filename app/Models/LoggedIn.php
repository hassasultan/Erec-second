<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoggedIn extends Model
{
    use HasFactory;
    protected $table = "logged_in";
    public $timestamps = false;
    protected $fillable = [
        "u_id",
        "u_type",
        "session_id",
        "log_time",
    ];
}
