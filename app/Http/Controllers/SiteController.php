<?php

namespace App\Http\Controllers;

use App\Helpers\IPFormatter;
use App\Services\VacancyService;

class SiteController extends Controller
{
    public function __construct(
        private readonly VacancyService $vacancyService
    ) {}

    // GET /
    public function index()
    {
        $vacancies = $this->vacancyService->getLatest();
        $userIp = IPFormatter::format(request()->ip() ?? '127.0.0.1');

        return view('site.index', [
            'vacancies' => $vacancies,
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
        return view('site.back');
    }

    // GET /site/gamedev
    public function gamedev()
    {
        return view('site.gamedev');
    }
}
