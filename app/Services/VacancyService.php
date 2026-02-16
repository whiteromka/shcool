<?php

namespace App\Services;

use App\Repositories\VacancyRepository;
use Illuminate\Support\Collection;

class VacancyService
{
    public function __construct(
        private readonly VacancyRepository $vacancyRepository
    ) {}

    public function getLatest(): Collection
    {
        return $this->vacancyRepository->getLatest(6);
    }
}
