<?php

namespace App\Repositories;

use App\Models\ActiveModule;
use Illuminate\Database\Eloquent\Collection;

class ActiveModuleRepository
{
    public function getAll(): Collection
    {
        return ActiveModule::query()->get();
    }

    public function getById(int $id): ?ActiveModule
    {
        return ActiveModule::query()->find($id);
    }

    public function getByModuleId(int $moduleId): ?ActiveModule
    {
        return ActiveModule::query()
            ->where('module_id', $moduleId)
            ->first();
    }

    public function getByModuleIdAndStatus(int $moduleId, string $status): ?ActiveModule
    {
        return ActiveModule::query()
            ->where('module_id', $moduleId)
            ->where('status', $status)
            ->first();
    }

    public function create(array $data): ActiveModule
    {
        return ActiveModule::query()->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $activeModule = ActiveModule::query()->find($id);
        if (!$activeModule) {
            return false;
        }

        return $activeModule->update($data);
    }

    public function delete(int $id): bool
    {
        $activeModule = ActiveModule::query()->find($id);
        if (!$activeModule) {
            return false;
        }

        return $activeModule->delete();
    }
}
