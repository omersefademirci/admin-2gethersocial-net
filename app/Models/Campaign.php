<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Kampanyaya bağlı markayı alır
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Kampanyaya bağlı grubu alır
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
