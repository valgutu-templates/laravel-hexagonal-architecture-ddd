<?php

namespace App\ApplicationName\DataStore\User\Domain\Models;

use App\ApplicationName\DataStore\AccessToken\Domain\Models\EmailVerificationCode;
use App\ApplicationName\DataStore\Role\Domain\Models\Role;
use App\ApplicationName\Shared\Traits\TimestampsFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use TimestampsFormat;

    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'password', 'email_confirmed', 'role_id'];

    // relationships
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function accessToken(): HasMany
    {
        return $this->hasMany(EmailVerificationCode::class, 'user_id', 'id');
    }
}
