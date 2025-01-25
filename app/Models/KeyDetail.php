<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyDetail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value', 'route', 'icon'];

    public function projects()
{
    return $this->belongsToMany(Project::class, 'key_detail_project', 'key_detail_id', 'project_id');
}

}