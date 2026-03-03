<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    public function create()
    {
        return view('review.create');
    }

    public function store(ReviewRequest $request)
    {
        Review::query()->create($request->validated());

        return redirect()->route('review.create')
            ->with('success', 'Отзыв добавлен.');
    }
}
