<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $table = 'user_info';

    protected $fillable = [
        'name', 'gender', 'dob', 'phone_number', 'ward_id', 'user_id', 'card_id'
    ];
}
