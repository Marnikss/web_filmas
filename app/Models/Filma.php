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
    public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'name' => $this->name,
            'description' => $this->description,
            'rezisori' => $this->rezisors->name,
            'kategorija' => ($this->kategorija ? $this->kategorija->name : ''),
            'price' => number_format($this->price, 2),
            'year' => intval($this->year),
            'image' => asset('images/' . $this->image),
        ];
    }
}
