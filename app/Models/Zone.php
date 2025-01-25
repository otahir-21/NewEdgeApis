<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Zone extends Model
{
    use HasFactory; // Include the HasFactory trait for factory support

    protected $fillable = ['title', 'route'];

    // Define a one-to-many relationship with the Location model
    public function locations()
    {
        return $this->hasMany(related: Location::class);
    }

}