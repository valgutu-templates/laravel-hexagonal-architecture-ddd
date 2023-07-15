<?php

namespace App\ApplicationName\DataStore\User\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'password', 'email_confirmed'];
}
