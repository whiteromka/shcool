<?php

namespace App\Http\Controllers;

use App\Helpers\IPFormatter;
use App\Models\Vacancy;
use Illuminate\Support\Facades\View;

class SiteController extends Controller
{
    // GET /
    public function index()
    {
        $vacancies = Vacancy::query()
            ->orderByDesc('created_at')
            ->orderByRaw('COALESCE(salary_to, salary_from, 0) DESC')
            ->offset(0)
            ->limit(6)
            ->get();
        $vacancies = $vacancies->all();

        $userIp = $_SERVER['REMOTE_ADDR'] ?? '127.01.0.1';
        $userIp = IPFormatter::format($userIp);
        View::share('userIp', $userIp);
        View::share('vacancies', $vacancies);

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
