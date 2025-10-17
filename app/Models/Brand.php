<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Bir markaya ait tüm grupları alır
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    // Bir markaya ait tüm kampanyaları alır
    public function campaigns()
    {
        return $this->hasManyThrough(Campaign::class, Group::class);
    }

    // Bir markaya bağlı gruplandırılmamış kampanyaları alır
    public function ungroupedCampaigns()
    {
        return $this->hasMany(Campaign::class)->whereNull('group_id');
    }
    
    public function restrictions()
    {
        return $this->hasMany(Restriction::class);
    }
}
