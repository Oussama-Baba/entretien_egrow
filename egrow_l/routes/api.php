<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\IssueController;

Route::get('/projects/{project}/issues-summary', [ProjectController::class, 'issuesSummary']);
Route::get('/issues', [IssueController::class, 'index']);
