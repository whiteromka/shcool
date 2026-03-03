<?php

namespace App\Http\Controllers;

use App\Models\BusinessRequest;
use Illuminate\Http\Request;

class BusinessRequestController extends Controller
{
    public function create()
    {
        return view('business-request.create');
    }

    /**
     * TODO переделать на кастомный request и перенести кастомную валидацию
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:11',
            'telegram' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
            'deadline' => 'nullable|date',
            'budget' => 'nullable|numeric',
//            'timestamp' => 'nullable|date',
        ]);

        BusinessRequest::query()->create($validated);

        return redirect()->route('businessRequest.create')
            ->with('success', 'Запрос успешно добавлен.');
    }
}
