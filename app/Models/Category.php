<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'categories';
    
    public function createdBy(){
        return $this->belongsTo(Admin::class,'createdByAdmin_id');
    }
    
    public function updatedBy(){
        return $this->belongsTo(Admin::class,'updatedByAdmin_id');
    }

    public function items(){
        return $this->hasMany(Item::class,'category_id');
    }
}
