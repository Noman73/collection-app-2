<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $fillable = ['ammount','collector_id','author_id','status'];
    public function collector()
    {
        return $this->belongsTo(User::class,'collector_id','id');
    }

    public function author()
    {
        return $this->belongsTo(User::class,'author_id','id');
    }
    
}
