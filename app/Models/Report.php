<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'report_status_id',
        'title',
        'description',
        'position'

    ];
}
