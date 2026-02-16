<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function loadMore(Request $request)
    {
        $offset = (int)$request->get('offset', 0);

        $vacancies = Vacancy::query()
            ->orderByDesc('created_at')
            ->orderByRaw('COALESCE(salary_to, salary_from, 0) DESC')
            ->offset($offset)
            ->limit(6)
            ->get();

        return response()->json([
            'html' => view('vacancy._items', ['vacancies' => $vacancies])->render(),
            'count' => $vacancies->count(),
        ]);
    }
}
