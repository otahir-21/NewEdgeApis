<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'name_ar', 'route', 'icon'];

    // Relationship back to Project
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_amenity', 'amenity_id', 'project_id');
    }
}