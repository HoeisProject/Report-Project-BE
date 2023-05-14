<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'start_date',
        'end_date'
    ];

    // TODO Timestamp using Carbon ??
    // protected $casts = [
    //     'start_date' => 'datetime:Y-m-d h:i:s',
    //     'end_date' => 'datetime:Y-m-d h:i:s',
    // ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
