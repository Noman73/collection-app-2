<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    public function donor()
    {
        return $this->belongsTo(Donor::class,'donor_id','id');
    }
    public function rittik()
    {
        return $this->hasMany(RittikiRelation::class,'collection_id','id')->with('rittiki');
    }
    public function totalrittik()
    {
        return $this->hasMany(RittikiRelation::class,'collection_id','id');
    }
}
