<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's convention
    protected $table = 'site_info';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'about',
        'counts',
        'mission',
        'vision',
        'founder',
        'team',
        'seo',
    ];

    // Cast the JSON fields to arrays
    protected $casts = [
        'about' => 'array',
        'counts' => 'array',
        'mission' => 'array',
        'vision' => 'array',
        'founder' => 'array',
        'team' => 'array',
        'seo' => 'array',
    ];
}