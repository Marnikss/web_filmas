<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategorija extends Model
{
    protected $table = 'kategorijas';

    protected $fillable = [
        'name',
        'description'
    ];

    public function filmas(): HasMany
    {
        return $this->hasMany(Filma::class);
    }
}
