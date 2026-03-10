<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ActiveModuleService;
use App\Services\ModuleService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ActiveModuleController extends Controller
{
    public function __construct(
        private readonly ActiveModuleService $activeModuleService,
        private readonly ModuleService $moduleService
    ) {}

    // POST active-module/join/{module_id}
    public function join(Request $request, int $module_id): JsonResponse|View
    {
        if (!$request->user()) {
            return response()->json(['success' => false, 'message' => 'Требуется авторизация'], 401);
        }

        try {
            $this->activeModuleService->joinUserToModule($request->user(), $module_id);
            return $this->renderPhpBlocksComponent();
        } catch (Exception $e) {
            Log::error('Error ActiveModuleController::join() ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // POST active-module/leave/{module_id}
    public function leave(Request $request, int $module_id): JsonResponse|View
    {
        if (!$request->user()) {
            return response()->json(['success' => false, 'message' => 'Требуется авторизация'], 401);
        }

        try {
            $this->activeModuleService->leaveUserFromModule($request->user(), $module_id);
            return $this->renderPhpBlocksComponent();
        } catch (Exception $e) {
            Log::error('Error ActiveModuleController::leave() ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    /**
     * Рендерит компонент php-blocks с актуальными данными
     */
    private function renderPhpBlocksComponent(): View
    {
        /** @var User $user */
        $user = Auth::user()->load('activeModules');
        $userModuleIds = $user->activeModules->pluck('module_id')->toArray();

        return view('components.nexus.php-blocks', [
            'modules' => $this->moduleService->getBackModules(),
            'userModuleIds' => $userModuleIds,
        ]);
    }
}
