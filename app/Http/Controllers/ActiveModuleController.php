<?php

namespace App\Http\Controllers;

use App\Services\ActiveModuleService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActiveModuleController extends Controller
{
    public function __construct(
        private readonly ActiveModuleService $activeModuleService
    ) {}

    // GET active-module/join/{module_id}
    public function join(Request $request, int $module_id): JsonResponse
    {
        if (!$request->user()) {
            return response()->json([
                'success' => false,
                'message' => 'Требуется авторизация',
            ], 401);
        }

        try {
            // Если в ActiveModule нет записи с module_id и со статусом STATUS_OPEN,
            // то создаём запись и добавляем пользователя к модулю
            $this->activeModuleService->joinUserToModule($request->user(), $module_id);

            return response()->json([
                'success' => true,
                'message' => 'Вы успешно записались на модуль',
            ]);
        } catch (Exception $e) {
            Log::error('Error ActiveModuleController::join() ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    // DELETE active-module/leave/{module_id}
    public function leave(Request $request, int $module_id): JsonResponse
    {
        // Проверка что авторизован
        if (!$request->user()) {
            return response()->json([
                'success' => false,
                'message' => 'Требуется авторизация',
            ], 401);
        }

        try {
            // Отсоединяем пользователя от модуля
            $this->activeModuleService->leaveUserFromModule($request->user(), $module_id);

            return response()->json([
                'success' => true,
                'message' => 'Вы успешно отписались от модуля',
            ]);
        } catch (Exception $e) {
            Log::error('Error ActiveModuleController::leave() ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
