<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    protected $fillable = [
        'user_id',
        'send_status',
        'payment_status',
    ];
    protected $appends=['user_name'];
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getUserNameAttribute(){
            return $this->user->name??null;
        }
    use HasFactory;
}
