<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrySetting extends Model
{
    use HasFactory;

    protected $fillable = ['entries_reports_sent'];
}
