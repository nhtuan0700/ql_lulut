<?php

namespace App\Models;

use App\Enum\RegistrationStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationSupport extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'period_id', 'status'
    ];

    
    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id');
    }

    public function getCreatedDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function detailGoods()
    {
        return $this->hasMany(RegistrationSupportDetail::class, 'registration_support_id')
            ->whereNull('money');
    }

    public function detailMoney()
    {
        return $this->hasOne(RegistrationSupportDetail::class, 'registration_support_id')
            ->whereNotNull('money');
    }

    public function getStatusHTMLAttribute()
    {
        switch ($this->status) {
            case RegistrationStatus::PROCESSING:
                return '<span class="text-warning">Đang xử lý</span>';
            case RegistrationStatus::FINISHED:
                return '<span class="text-success">Đã thành công</span>';
            case RegistrationStatus::CANCEL:
                return '<span class="text-danger">Đã hủy</span>';
        }
    }
}
