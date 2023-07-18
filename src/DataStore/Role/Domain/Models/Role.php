<?php

namespace App\ApplicationName\DataStore\Role\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public $timestamps = true;

    protected $fillable = ['title', 'slug', 'default'];
}
