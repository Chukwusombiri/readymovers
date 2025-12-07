<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class,'order_items');
    }

    public function createdByAdmin(){
        return $this->belongsTo(Admin::class,'createdByAdmin_id');
    }

    public function updatedByAdmin(){
        return $this->belongsTo(Admin::class,'updatedByAdmin_id');
    }
}
