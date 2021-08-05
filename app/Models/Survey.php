<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'color1', 'color2', 'color3', 'ip', 'country', 'useragent'];
}
