<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory,HasUuids;

    public $incrementing = false;

    protected $fillable = ['order_refNo'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_refNo = "MM". $order->randomId() ."ZS";
        });

        static::saving(function ($order) {
            $order->outstanding_fee = $order->quote_fee - $order->upfront_fee;
            if(auth('admin')->check()){
                $order->updatedByAdmin_id = auth('admin')->user()->id;
            }
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
