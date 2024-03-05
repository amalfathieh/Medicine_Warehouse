<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'card_id',
        'medicine_name',
        'quantity',
    ];
    public function card()
    {
        return $this->belongsTo(Card::class);
    }
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
    use HasFactory;
}
