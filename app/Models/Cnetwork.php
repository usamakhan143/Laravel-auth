<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cnetwork extends Model
{
    use HasFactory;

    protected $table = 'cnetworks';

    public function account() {
        return $this->belongsTo('App\Models\backend\Account','account_id', 'id');
    }
}
