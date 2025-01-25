<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Zone_location extends Model
// {
//     protected $table = 'zones';

//     public function locations()
//     {
//         return $this->hasMany(Location::class);
//     }
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone_location extends Model
{
    protected $fillable = ['title', 'route'];

    public function locations()
    {
        return $this->hasMany(Location::class, 'zone_id');
    }
}