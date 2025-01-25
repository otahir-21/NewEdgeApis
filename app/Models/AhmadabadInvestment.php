<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhmadabadInvestment extends Model
{
    use HasFactory;

    // Define the fillable attributes to allow mass assignment
    protected $fillable = [
        'intro_title', 'intro_title_ar',
        'intro_description', 'intro_description_ar',
        'intro_featured_img', 'benefits',
        'why_invest_title', 'why_invest_title_ar',
        'why_invest_description', 'why_invest_description_ar',
        'why_invest_featured_img', 'benefits2',
        'location1_title', 'location1_title_ar',
        'location1_link', 'location1_featured_img',
        'location2_title', 'location2_title_ar',
        'location2_link', 'location2_featured_img',
    ];

    // Cast the 'benefits' and 'benefits2' columns to arrays to handle JSON data
    protected $casts = [
        'benefits' => 'array',
        'benefits2' => 'array',
    ];

    // Optionally, you can add accessors and mutators here for custom transformations if needed.
}
