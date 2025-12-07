<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guards = [];

    public function createdBy(){
        return $this->belongsTo(Admin::class,'createdByAdmin_id');
    }
    

    public function updatedBy(){
        return $this->belongsTo(Admin::class,'updatedByAdmin_id');
    }
}
