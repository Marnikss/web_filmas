<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Filma extends Model
{
    public function rezisors(): BelongsTo
    {
    return $this->belongsTo(Rezisori::class);
    }
}
