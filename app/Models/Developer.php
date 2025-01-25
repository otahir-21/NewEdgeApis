<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $casts = [
        'project_id' => 'array',
    ];

    protected $fillable = ['name','banner_image', 'route', 'featured_img', 'experience', 'inner_page_image', 'description', 'brochure', 'project_id','seo','banner_image'];

    public function relatedProjects()
    {
        return $this->hasMany(RelatedProject::class);
    }

    public function seo()
    {
        return $this->hasOne(Seo::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'id', 'project_id'); // Define the relationship based on project_id
    }
}