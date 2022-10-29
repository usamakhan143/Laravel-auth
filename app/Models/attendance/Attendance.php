<?php

namespace App\Models\attendance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [

        'in',
        'startTime',
        'atOffice',
        'day',
        'year',
        'month',
        'isHalfDay',
        'isLate',
        'out',
        'endTime',
        'workingHours',
        'isOvertime',
        'over_time',
        'account_id',
        'department_id',
        'team_id'

    ];

    public function account() {
        return $this->belongsTo('App\Models\backend\Account');
    }
}
