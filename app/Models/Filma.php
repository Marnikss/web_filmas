<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Filma extends Model
{
    protected $fillable = [
        'name',
        'rezisors_id',
        'description',
        'price',
        'year',
    ];
    public function rezisors(): BelongsTo
    {
    return $this->belongsTo(Rezisori::class);
    }
}
