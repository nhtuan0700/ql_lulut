<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $table = 'families';

    protected $fillable = [
        'owner_name', 'person_qty', 'holdhouse_id', 'ward_id', 'address'
    ];

    public function ward() {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    public function handovers() {
        return $this->hasMany(FamilyHandover::class, 'family_id');
    }
}
