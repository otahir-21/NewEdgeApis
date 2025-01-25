<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table = 'forms';
    protected $fillable = ['first_name','property_for', 'last_name','email','company','phone', 'city_name','min_budget','max_budget','recordType','property_name','message'];
}