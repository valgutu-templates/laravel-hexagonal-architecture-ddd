<?php

namespace App\ApplicationName\DataStore\AccessToken\Domain\Models;

use App\ApplicationName\DataStore\User\Domain\Models\User;
use App\ApplicationName\Shared\Traits\TimestampsFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AccessToken extends Model
{
    use TimestampsFormat;

    protected $table = 'access_tokens';

    public $timestamps = true;

    protected $fillable = ['user_id', 'access_token', 'expires_at'];

    // relationships
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
