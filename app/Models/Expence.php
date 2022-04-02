<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expence extends Model
{
    use HasFactory;

    public function expence_area()
    {
        return $this->belongsTo(ExpenceArea::class,'exp_id','id');
    }
}
