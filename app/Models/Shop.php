<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
    ];

    public function user(): BelonsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reservation(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
