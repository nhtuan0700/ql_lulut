<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationSupportDetail extends Model
{
    use HasFactory;

    protected $table = 'registration_support_detail';
    protected $fillable = [
        'registration_support_id', 'goods_id', 'goods_name', 'qty', 'money'
    ];

    public function goods() {
        return $this->belongsTo(Goods::class, 'goods_id');
    }

    public function registration() {
        return $this->belongsTo(RegistrationSupport::class, 'registration_support_id');
    }
}
