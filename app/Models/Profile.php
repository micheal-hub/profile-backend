<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'email',
        'age',
        'phone',
        'address',
        'gender',
        'profile_picture',
    ];
}
