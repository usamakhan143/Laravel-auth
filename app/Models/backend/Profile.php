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
        'status',
        'account_id'
        
    ];
    
}
