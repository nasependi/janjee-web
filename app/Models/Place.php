<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Place extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['field_count'];
    protected $routeKeyName = 'slug';

    protected $with = ['field'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($place) {
            if (empty($place->slug)) {
                $place->slug = Str::slug($place->name);
            }
        });

        static::updating(function ($place) {
            if (empty($place->slug)) {
                $place->slug = Str::slug($place->name);
            }
        });
    }

    public function getFieldCountAttribute()
    {
        return $this->field->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function field(){
        return $this->hasMany(Field::class,'place_id');
    }
}
