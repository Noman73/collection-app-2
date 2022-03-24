<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rittiky extends Model
{
    use HasFactory;

    public function ammount()
    {
        return $this->hasMany(RittikiRelation::class,'rittiki_id','id');
    }
    public function pays()
    {
        return $this->hasMany(RittikiPay::class,'rittiki_id','id');
    }
}
