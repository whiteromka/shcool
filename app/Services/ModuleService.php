<?php

namespace App\Services;

use App\Repositories\ModuleRepository;
use Illuminate\Support\Collection;

class ModuleService
{
    public function __construct(
        private readonly ModuleRepository $moduleRepository
    ) {}

    public function getBackModules(): Collection
    {
        return $this->moduleRepository->getByType('back');
    }

    /**
     * Получить коллекцию модулей со связью с активными со связью с записавшимися пользователями
     */
    public function getBackModulesWithActiveModulesAndUsers(): Collection
    {
        return $this->moduleRepository->getBackModulesWithActiveModulesAndUsers();
    }

    /**
     * Транкейтнуть modules и записать дефолтные данные
     */
    public function seedModules(array $modulesData): void
    {
        $this->moduleRepository->truncate();
        foreach ($modulesData as $moduleData) {
            $this->moduleRepository->create($moduleData);
        }
    }
}
