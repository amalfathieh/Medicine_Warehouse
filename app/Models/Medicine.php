<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function catogary()
        {
            return $this->belongsTo(Catogary::class);
        }

    public function orders()
        {
            return $this->hasMany(Order::class);
        }

    public function users()
    {
        return $this->belongsToMany(User::class, 'medicine_user');
    }
}
