<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Cashier;
use App\Models\Customer;
use App\Models\Administrator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    public function administrator()
    {
        return $this->hasOne(Administrator::class);
    }
    public function cashier()
    {
        return $this->hasOne(Cashier::class);
    }
}
