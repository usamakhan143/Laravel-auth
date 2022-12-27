<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [

        'identityNumber',
        'hireDate',
        'gender',
        'designation',
        'status',
        'account_id'
        
    ];

    public function account() {
    	return $this->belongsTo('App\Models\backend\Account','account_id');
    }
    
}
