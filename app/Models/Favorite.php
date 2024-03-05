<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'medicine_user';
    protected $fillable = [
        'medicine_id',
        'user_id',
    ];
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
