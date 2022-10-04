<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    public function roles()
    {
    	return $this->belongsToMany('App\Models\backend\Role','account_roles');
    }

    public function profile() {
    	return $this->hasOne('App\Models\backend\Profile','account_id');
    }
}
