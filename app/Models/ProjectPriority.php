<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPriority extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'time_span_id',
        'money_estimate_id',
        'manpower_id',
        'material_feasibility_id'
    ];
}
