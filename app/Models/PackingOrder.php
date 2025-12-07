<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PackingOrder extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $fillable = ['order_refNo'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->refNo = "MM". $order->randomId() ."PUP";
        });       
    }

    public function randomId(){
        return rand(111111111,99999999);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class,'order_items');
    }

    public function approvedByAdmin(){
        return $this->belongsTo(Admin::class,'approvedByAdmin_id');
    }

    public function updatedByAdmin(){
        return $this->belongsTo(Admin::class,'updatedByAdmin_id');
    }

    public function dispatchedByAdmin(){
        return $this->belongsTo(Admin::class,'dispatchedByAdmin_id');
    }

    public function deliveredByAdmin(){
        return $this->belongsTo(Admin::class,'deliveredByAdmin_id');
    }

}
