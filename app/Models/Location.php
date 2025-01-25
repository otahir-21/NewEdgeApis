<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['title', 'route', 'zone_id'];


    public function zone()
{
    return $this->belongsTo(Zone::class);
}

}