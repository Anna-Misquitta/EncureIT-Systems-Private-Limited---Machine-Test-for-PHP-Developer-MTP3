<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMaster extends Model
{
    protected $table = 'user_master';

    protected $fillable = [
        'first_name',
        'last_name',
        'execution_time'
    ];
}
