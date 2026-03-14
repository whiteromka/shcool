<?php

namespace App\Http\Controllers;

use App\Helpers\IPFormatter;
use App\Models\User;
use App\Services\ModuleService;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function __construct(
        private readonly ModuleService $moduleService
    ) {}

    // GET /
    public function index()
    {
        $userIp = IPFormatter::format(request()->ip() ?? '127.0.0.1');

        /** @var User|null $user */
        $user = auth()->user();
        $activeModules = [];
        if ($user) {
            $user->load('activeModules.module');
            $activeModules = $user->activeModules->pluck('module.name', 'module.id')->toArray();
        }

        return view('site.index', [
            'userIp' => $userIp,
            'activeModules' => $activeModules,
        ]);
    }

    // GET /site/front
    public function front()
    {
        return view('site.front');
    }

    // GET /site/back
    public function back()
    {
        /** @var User $user */
        $user = Auth::user();
        $userModuleIds = [];
        if ($user) {
            $user->load('activeModules');
            $userModuleIds = $user->activeModules->pluck('module_id')->toArray();
        }

        return view('site.back', [
            'modules' => $this->moduleService->getBackModulesWithActiveModulesAndUsers(),
            'userModuleIds' => $userModuleIds,
        ]);
    }

    // GET /site/gamedev
    public function gamedev()
    {
        return view('site.gamedev');
    }
}
