<?php

namespace App\Models;

use App\Traits\TimestampFormatTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable, TimestampFormatTrait;

    protected $fillable = [
        'title', 'content', 'images'
    ];

    // slug auto update by title
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImagesAttribute($value)
    {
        if (!is_null($value)) {
            $array = array_map(function ($item) {
                return asset('storage/' . $item);
            }, json_decode($value));
        } else {
            $array = [];
        }
        return $array;
    }

    public function setImagesAttribute($value)
    {
        return $this->attributes['images'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
