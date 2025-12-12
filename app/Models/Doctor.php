<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Doctor extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'doctor_id';

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'department',
    ];

    protected $hidden = [
        'password',
    ];
}
