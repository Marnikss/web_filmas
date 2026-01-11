<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rezisori extends Model
{
    protected $table = 'rezisori';
    public function filmas(): HasMany
    {
        return $this->hasMany(Filma::class);
    }
}
