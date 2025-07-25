<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 use App\Models\Issue;


class IssueController extends Controller
{


public function index(Request $request)
{
    $filters = $request->only(['status', 'priority', 'assigned_to', 'project_id']);

    $issues = Issue::with('project')
        ->filter($filters)
        ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
        ->orderByDesc('created_at')
        ->paginate(10);

    return response()->json([
        'status' => 'success',
        'data' => $issues->map(function ($issue) {
            return [
                'id' => $issue->id,
                'title' => $issue->title,
                'status' => $issue->status,
                'priority' => $issue->priority,
                'assigned_to' => $issue->assigned_to,
                'created_at' => $issue->created_at->toDateTimeString(),
                'project_name' => $issue->project->name
            ];
        }),
        'meta' => [
            'total' => $issues->total(),
            'per_page' => $issues->perPage(),
            'current_page' => $issues->currentPage(),
        ]
    ]);
}

}
