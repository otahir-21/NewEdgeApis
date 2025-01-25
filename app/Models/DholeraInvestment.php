<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DholeraInvestment extends Model
{
    use HasFactory;

    protected $fillable = [
        'intro_title', 'intro_description', 'intro_featured_img',
        'location1_title', 'location1_link', 'location1_featured_img',
        'location2_title', 'location2_link', 'location2_featured_img',
        'advantages', 'industries_title', 'industries_description',
        'plan_title', 'plan_description', 'plan_featured_img',
        'planList', 'dmic_title', 'dmic_description', 'dmic_featured_img',
        'dmicList', 'airport_title', 'airport_description', 'airport_featured_img',
        'advantage_title', 'advantage_description', 'expectations',
        'sectors', 'benefits', 'investors'
    ];

    protected $casts = [
        'advantages' => 'array',
        'planList' => 'array',
        'dmicList' => 'array',
        'expectations' => 'array',
        'sectors' => 'array',
        'benefits' => 'array',
        'investors' => 'array',
    ];
}
