<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory; // Don't forget to use the HasFactory trait

    protected $fillable = [
        'title', 'route', 'featured_img', 'price', 'range', 'zone_id', 'developer_id',
        'property_type_id', 'bath', 'bedroom', 'area', 'rera_no', 'description',
        'video_url', 'slider_image', 'gallery_image', 'project_status',
        'preleased_location', 'farmhouse_location', 'seo','roi',
            'tagline',
            'property_location',
            'company_type',
            'lease_duration',
            'inner_page_image',
            'location_id',
            'banner_image',
            'key_details',
            'amenities',
            'monthly_rent',
            'property_sub_type',
            'featured_property',
            'brochure',
            'video_thumbnail'
    ];

    protected $casts = [
        'featured_property' => 'boolean',
        'key_details'=>'array',
        'amenities'=>'array',
        'slider_image' => 'array',
        'gallery_image' => 'array',
        'seo' => 'array',
    ];

     // Relationships
     public function zone()
     {
         return $this->belongsTo(Zone::class);
     }

     public function developer()
     {
         return $this->belongsTo(Developer::class);
     }

     public function propertyType()
{
    return $this->belongsTo(PropertyType::class, 'property_type_id');
}

     public function keyDetails()
     {
         return $this->belongsToMany(KeyDetail::class, 'key_detail_project', 'project_id', 'key_detail_id');
     }

     public function amenities()
     {
         return $this->belongsToMany(Amenity::class, 'project_amenity', 'project_id', 'amenity_id');
     }
    public function location()
{
    return $this->belongsTo(Location::class);
}
}
