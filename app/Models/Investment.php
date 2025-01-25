<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'intro_title',
        'intro_description',
        'intro_featured_img',
        'key_details',
        'expert_tips',
        'tips',
        'factors',
        'phases',
        'why_invest_title',
        'why_invest_description',
        'why_invest_featured_img',
        'offerings',
        'opportunity1_title',
        'opportunity1_featured_img',
        'opportunity2_title',
        'opportunity2_featured_img',
    ];

    protected $casts = [
        'key_details' => 'array',
        'expert_tips' => 'array',
        'tips' => 'array',
        'factors' => 'array',
        'phases' => 'array',
        'offerings' => 'array',
    ];

    public function toArray()
{
    $array = parent::toArray();

    // Decode JSON fields to return them as arrays
    $array['key_details'] = json_decode($this->key_details, true);
    $array['expert_tips'] = json_decode($this->expert_tips, true);
    $array['tips'] = json_decode($this->tips, true);
    $array['factors'] = json_decode($this->factors, true);
    $array['phases'] = json_decode($this->phases, true);
    $array['offerings'] = json_decode($this->offerings, true);

    return $array;
}

}