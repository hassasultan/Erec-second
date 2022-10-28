<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Qst;
use App\Models\User;
use App\Models\QstAttempts;
use App\Models\QstToClasses;

class AccessToQst extends Model
{
    use HasFactory;
    protected $table = "access_to_qst";
    public $timestamps = false;
    protected $fillable = [
        "qst_no",
        "u_id",
        "org_id",
    ];
    public function qst()
    {
        return $this->belongsTo(Qst::class,'qst_no','number');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'u_id','u_id');
    }
    public function attempt()
    {
        return $this->belongsTo(QstAttempts::class,'u_id','u_id');
    }
    public function qstToClass()
    {
        return $this->belongsTo(QstToClasses::class,'qst_no','qst');
    }
}
