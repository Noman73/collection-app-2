<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RittikiPay extends Model
{
    use HasFactory;
    public function rittiki()
    {
        return $this->belongsTo(Rittiky::class,'rittiki_id','id');
    }
}
