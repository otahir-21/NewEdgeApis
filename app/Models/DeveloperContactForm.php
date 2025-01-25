<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperContactForm extends Model
{
    use HasFactory;
    protected $table = 'developer_contact_forms';
    protected $fillable = ['first_name', 'last_name','phone','email','message'];
}