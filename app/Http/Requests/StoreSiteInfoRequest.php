<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiteInfoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'about.tagline' => 'required|string',
            'about.title' => 'required|string',
            'about.description' => 'required|string',
            'about.featured_image' => 'required|string',
            'counts' => 'array',
            'counts.*.value' => 'required|string',
            'counts.*.title' => 'required|string',
            'mission.title' => 'required|string',
            'mission.description' => 'required|string',
            'mission.featured_image' => 'required|string',
            'vision.title' => 'required|string',
            'vision.description' => 'required|string',
            'vision.featured_image' => 'required|string',
            'founder.title' => 'required|string',
            'founder.description' => 'required|string',
            'founder.featured_image' => 'required|string',
            'team' => 'array',
            'team.*.name' => 'required|string',
            'team.*.designation' => 'required|string',
            'team.*.featured_image' => 'required|string',
            'seo.meta_title' => 'required|string',
            'seo.meta_description' => 'required|string',
            'seo.schema_markup' => 'required|string',
        ];
    }
}