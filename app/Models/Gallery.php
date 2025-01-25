<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['alt_tag', 'img', 'pdf','video']; // Include 'pdf' here

    // If you're using timestamps, ensure these are present
    public $timestamps = true;

}
