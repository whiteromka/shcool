<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewStoreRequest;
use App\Models\Review;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(ReviewStoreRequest $request): JsonResponse
    {
        // Проверка авторизации
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'errors' => ['auth' => ['Требуется авторизация для оставления отзыва']],
            ], 403);
        }

        $validated = $request->validated();
        Review::query()->create([
            'user_id' => auth()->id(),
            'stars' => $validated['stars'],
            'modules_id' => $validated['modules_id'] ?? null,
            'message' => $validated['message'],
            'status' => Review::STATUS_NEW,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Отзыв успешно добавлен',
        ]);
    }
}
