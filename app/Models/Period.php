<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = [
        'id', 'name', 'date_end'
    ];

    public function getDateEndAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setDateEndAttribute($value)
    {
        $this->attributes['date_end'] =  Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getStatus()
    {
        if ($this->getRawOriginal('date_end') >= now()) {
            return 1;
        }
        return 0;
    }

    public function getStatusHTMLAttribute()
    {
        $status = $this->getStatus();
        if ($status === 1) {
            return '<span class="badge badge-success">Đang diễn ra</span>';
        }
        return '<span class="badge badge-danger">Đã kết thúc</span>';
    }
}
