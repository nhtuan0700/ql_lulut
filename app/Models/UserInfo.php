<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $table = 'user_info';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name', 'gender', 'dob', 'phone_number', 'ward_id', 'user_id', 'card_id'
    ];

    public function getDobAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format(config('constants.date_format'));
        }
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat(config('constants.date_format'), $value)->format('Y-m-d');
    }

    public function ward() {
        return $this->belongsTo(Ward::class, 'ward_id');
    }
}
