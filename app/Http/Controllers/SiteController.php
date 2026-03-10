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

        return view('site.index', [
            'userIp' => $userIp,
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
        $user = Auth::user()->load('activeModules');
        $userModuleIds = [];
        if ($user) {
            $userModuleIds = $user->activeModules->pluck('module_id')->toArray();
        }

        return view('site.back', [
            'modules' => $this->moduleService->getBackModules(),
            'userModuleIds' => $userModuleIds,
        ]);
    }

    // GET /site/gamedev
    public function gamedev()
    {
        return view('site.gamedev');
    }
}
