<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_id',
        'user_id',
        'report_statuses_id',
        'title',
        'description',
        'position'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    public function reportStatus(): BelongsTo
    {
        return $this->belongsTo(ReportStatus::class, 'report_statuses_id');
    }
}
