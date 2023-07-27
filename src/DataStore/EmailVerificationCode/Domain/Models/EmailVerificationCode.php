<?php

namespace App\ApplicationName\DataStore\EmailVerificationCode\Domain\Models;

use App\ApplicationName\DataStore\User\Domain\Models\User;
use App\ApplicationName\Shared\Traits\TimestampsFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EmailVerificationCode extends Model
{
    use TimestampsFormat;

    protected $table = 'email_verification_codes';

    public $timestamps = true;

    protected $fillable = ['user_id', 'code', 'sent', 'confirmed', 'expires_at'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
