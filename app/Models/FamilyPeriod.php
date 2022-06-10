<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyPeriod extends Model
{
    use HasFactory;

    protected $table = 'family_period';

    protected $fillable = [
        'family_id', 'period_id', 'description', 'received_at', 'status'
    ];

    public function family() {
        return $this->belongsTo(Family::class, 'family_id');
    }

    public function period() {
        return $this->belongsTo(Period::class, 'period_id');
    }
}
