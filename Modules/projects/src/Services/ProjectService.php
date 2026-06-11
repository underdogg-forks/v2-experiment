<?php

namespace Modules\Projects\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Projects\Models\Project;

class ProjectService
{
    public function createProject(array $data): Project
    {
        return Project::query()->create($data);
    }

    public function updateProject(Project $project, array $data): Project
    {
        $project->update($data);

        return $project->fresh();
    }

    public function deleteProject(Project $project): bool
    {
        return (bool) $project->delete();
    }

    public function listForCompany(int $companyId): Collection
    {
        return Project::query()
            ->where('company_id', $companyId)
            ->with(['client'])
            ->orderBy('project_name')
            ->get();
    }
}
