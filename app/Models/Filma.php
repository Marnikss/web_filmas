<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Filma extends Model
{
    protected $fillable = [
        'name',
        'rezisors_id',
        'kategorija_id',
        'description',
        'price',
        'year',
        'display',
        'image',
    ];
    public function rezisors(): BelongsTo
    {
    return $this->belongsTo(Rezisori::class);
    }
    public function kategorija(): BelongsTo
    {
    return $this->belongsTo(Kategorija::class);
    }
}
