<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Bir gruba bağlı markayı alır
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Bir gruba bağlı tüm kampanyaları alır
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
