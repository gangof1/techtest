<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name', 'description', 'date'];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'date_timestamp' => $this->getDateTimestamp(),
        ];
    }


    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }

    private function getDateTimestamp()
    {
        if ($this->date instanceof \DateTime) {
            return $this->date->getTimestamp();
        }
        return strtotime($this->date);
    }
}
