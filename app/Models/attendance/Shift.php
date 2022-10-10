<?php

namespace App\Models\attendance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'start_time',
        'end_time',
        'working_hours',
        'status'

    ];
}
