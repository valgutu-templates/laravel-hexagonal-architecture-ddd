<?php

namespace App\ApplicationName\Shared\Traits;

use Carbon\Carbon;

trait TimestampsFormat
{
    public function getCreatedAtAttribute($date): string
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($date): string
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }
}
