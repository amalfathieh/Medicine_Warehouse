<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Catogary extends Model
{
    use HasFactory;

    protected $fillable = [
        'catogary',
    ];

    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }
}
