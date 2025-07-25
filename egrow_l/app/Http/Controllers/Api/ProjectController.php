<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;


class ProjectController extends Controller
{


public function issuesSummary(Request $request, Project $project)
{
    $assignedTo = $request->query('assigned_to');

    $issues = $project->issues();

    return response()->json([
        'status' => 'success',
        'data' => [
            'project' => $project->name,
            'total_issues' => $issues->count(),
            'open_issues' => $issues->where('status', 'open')->count(),
            'assigned_to_issues' => $assignedTo ? $issues->where('assigned_to', $assignedTo)->count() : 0,
            'high_priority_unresolved' => $issues->where('priority', 'high')->where('status', '!=', 'closed')->count(),
        ]
    ]);
}

}

