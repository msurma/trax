<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property \DateTime $date
 * @property float $miles
 * @property int $car_id
 * @property int $user_id
 */
class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'miles',
        'car_id',
        'user_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
