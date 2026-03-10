<?php

namespace App\Livewire;

use App\Services\ActiveModuleService;
use Exception;
use Livewire\Component;

class ModuleButton extends Component
{
    public int $moduleId;
    public bool $isUserJoined;

    public function toggle(): void
    {
        if (!auth()->check()) {
            redirect()->route('login');
            return;
        }

        $activeModuleService = app(ActiveModuleService::class);

        try {
            if ($this->isUserJoined) {
                $activeModuleService->leaveUserFromModule(auth()->user(), $this->moduleId);
            } else {
                $activeModuleService->joinUserToModule(auth()->user(), $this->moduleId);
            }

            $this->isUserJoined = !$this->isUserJoined;
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.module-button');
    }
}
