<?php

namespace App\Repositories;

use App\Models\Vacancy;
use Illuminate\Support\Collection;

class VacancyRepository
{
    public function getLatest(int $limit, int $offset = 0): Collection
    {
        return Vacancy::query()
            ->orderByDesc('published_at')
            ->orderByRaw('COALESCE(salary_to, salary_from, 0) DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    public function getLastPublishedAt(): ?string
    {
        return Vacancy::query()->latest('published_at')->value('published_at');
    }
}
