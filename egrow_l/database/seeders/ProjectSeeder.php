<?php

namespace Database\Seeders;

use App\Models\Project;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $statuses = ['open', 'in_progress', 'resolved', 'closed'];
    $priorities = ['low', 'medium', 'high'];
    $assignees = ['johndoe', 'janedoe', 'admin', null];

    Project::factory(5)->create()->each(function ($project) use ($statuses, $priorities, $assignees) {
        for ($i = 0; $i < 10; $i++) {
            $project->issues()->create([
                'title' => 'Issue ' . Str::random(5),
                'description' => 'Random issue content',
                'status' => $statuses[array_rand($statuses)],
                'priority' => $priorities[array_rand($priorities)],
                'assigned_to' => $assignees[array_rand($assignees)],
            ]);
        }
    });
}
}
