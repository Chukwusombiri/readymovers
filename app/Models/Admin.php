<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens,Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\CanResetPassword;


class Admin extends Authenticatable implements CanResetPassword
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable, HasUuids, SoftDeletes;

    protected $guard = 'admin';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'admin_role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function approvedOrder(){
        return $this->hasMany(Order::class,'approvedByAdmin_id');
    }

    public function updatedOrder(){
        return $this->hasMany(Order::class,'updatedByAdmin_id');
    }

    public function createdFloor(){
        return $this->hasMany(Floor::class,'createdByAdmin');
    }

    public function updatedFloor(){
        return $this->hasMany(Floor::class,'updatedByAdmin');
    }

    public function createdCategory(){
        return $this->hasMany(Category::class,'createdByAdmin_id');
    }

    public function updatedCategory(){
        return $this->hasMany(Category::class,'updatedByAdmin_id');
    }

    public function createdItem(){
        return $this->hasMany(Item::class,'createdByAdmin_id');
    }

    public function updatedItem(){
        return $this->hasMany(Item::class,'updatedByAdmin_id');
    }

    /* public function activeSession(){
        return $this->hasOne()
    } */
}
