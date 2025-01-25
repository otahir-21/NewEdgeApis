<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'posted_by',
        'title',
        'route',
        'long_description',
        'feature_image',
        'inner_page_img',
        'seo',
        'banner_image',
    ];
    protected $casts = [
        'seo' => 'array', // Cast the SEO column to an array
    ];
}