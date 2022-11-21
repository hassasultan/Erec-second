<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QstScore extends Model
{
    use HasFactory;
    protected $table = "qst_scores";
    public $timestamps = false;
    protected $fillable = [
        "u_id",
        "qst",
        "mark",
        "marked",
        "bonus",
        "org_id",
    ];
    public function qst()
    {
        return $this->belongsTo(Qst::class,'qst','number');
    }
}
