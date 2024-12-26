<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $rules = [
        'start_at' => 'required|integer|min:0|max:23',
    ];

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            $exists = Booking::where('date', $model->date)
                ->where('start_at', $model->start_at)
                ->exists();

            if ($exists) {
                throw ValidationException::withMessages([
                    'start_at' => 'Booking pada waktu ini sudah ada.',
                ]);
            }

            if ($model->start_at && !$model->end_at) {
                $startHour = (int) $model->start_at;

                // Calculate end_at with proper time formatting and handling of 24-hour rollover
                $endHour = ($startHour + 1) % 24; // Handle 24-hour rollover
                $model->start_at = sprintf('%02d:00', $startHour);
                $model->end_at = sprintf('%02d:00', $endHour);
            }
        });
    }
}
