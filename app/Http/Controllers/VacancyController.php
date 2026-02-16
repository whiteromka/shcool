<?php

namespace App\Http\Controllers;

use App\Services\VacancyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function __construct(
        private readonly VacancyService $vacancyService
    ) {}

    /**
     * Проверяет нужно ли подтянуть свежие вакансии с hh.ru.
     * Если нужно стянуть, то сохраняет их в БД.
     * Возвращает последние актуальные вакансии.
     *
     * @return JsonResponse
     */
    public function check(): JsonResponse
    {
        $vacancies = $this->vacancyService->checkAndGetLatest();
        $html = view('vacancy._items', ['vacancies' => $vacancies])->render();

        return response()->json([
            'html' => $html,
            'count' => $vacancies->count(),
        ]);
    }

    public function loadMore(Request $request): JsonResponse
    {
        $offset = (int)$request->get('offset', 0);
        $vacancies = $this->vacancyService->getLatest($offset);
        $html = view('vacancy._items', ['vacancies' => $vacancies])->render();

        return response()->json([
            'html' => $html,
            'count' => $vacancies->count(),
        ]);
    }
}
