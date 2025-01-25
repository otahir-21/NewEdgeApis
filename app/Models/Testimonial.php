<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'type',
        'name',
        'designation',
        'user_img',
        'review',
        'video_url'
    ];

}