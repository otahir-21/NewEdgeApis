<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyForm extends Model
{
    use HasFactory;
    protected $table = 'property_forms';

    protected $fillable = ['first_name', 'last_name', 'company' , 'phone' , 'city_name','property_for', 'email','property', 'min_budget','max_budget','message'];

}