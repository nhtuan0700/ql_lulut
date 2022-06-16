<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyHandover extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_id', 'period_id', 'goods_id', 'qty', 'money'
    ];

    public function family()
    {
        return $this->belongsTo(Family::class, 'family_id');
    }

    public function goods() {
        return $this->belongsTo(Goods::class, 'goods_id');
    }
}
