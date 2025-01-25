<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'route',
        'meta_title',
        'meta_description',
        'schema_markup',
        'seo',
        'banner_image'
    ];
    public function property_type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }
}