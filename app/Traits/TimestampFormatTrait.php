<?php

namespace App\Traits;

use Carbon\Carbon;
/**
 * 
 */
trait TimestampFormatTrait
{
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format(config('constants.datetime_format'));
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format(config('constants.datetime_format'));
    }
}
