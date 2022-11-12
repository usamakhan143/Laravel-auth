<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    public function roles() {
    	return $this->belongsToMany('App\Models\backend\Role','account_roles');
    }

    public function profile() {
    	return $this->hasOne('App\Models\backend\Profile','account_id');
    }

    public function shifts() {
    	return $this->belongsToMany('App\Models\attendance\Shift','account_shifts');
    }

    public function attendances() {
        return $this->hasMany('App\Models\attendance\Attendance','account_id', 'id');
    }
    
    public function networks() {
        return $this->hasMany('App\Models\Cnetwork','account_id', 'id');
    }
}
