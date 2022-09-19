<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function permission()
    {
    	return $this->belongsToMany('App\Models\backend\Permission', 'permission_roles');
    }
}
