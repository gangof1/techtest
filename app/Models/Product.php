<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    protected $hidden = ['pivot'];

    protected $appends = ['quantity'];

    public function getQuantityAttribute()
    {
        return $this->pivot ? $this->pivot->quantity : null;
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
