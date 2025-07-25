<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
       use HasFactory;

    protected $fillable = [
        'project_id', 'title', 'description', 'status',
        'priority', 'assigned_to'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Scopes for filtering
    public function scopeFilter($query, $filters)
    {
        return $query
            ->when($filters['status'] ?? false, fn($q, $v) => $q->where('status', $v))
            ->when($filters['priority'] ?? false, fn($q, $v) => $q->where('priority', $v))
            ->when($filters['assigned_to'] ?? false, fn($q, $v) => $q->where('assigned_to', $v))
            ->when($filters['project_id'] ?? false, fn($q, $v) => $q->where('project_id', $v));
    }
}
