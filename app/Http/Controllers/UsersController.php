<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


//GET /users - список задач (index)
//GET /users/create - форма создания (create)
//POST /users - сохранение задачи (store)
//GET /users/{user} - просмотр задачи (show)
//GET /users/{user}/edit - форма редактирования (edit)
//PUT/PATCH /users/{user} - обновление задачи (update)
//DELETE /users/{user} - удаление задачи (destroy)
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->latest()->paginate(20);
        dd($users->items());
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'telegram' => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'Пользователь создан успешно.');
    }

    /** //GET /users/show/{user} - просмотр задачи (show)
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //return view('users.show', compact('user'));
        // Вариант 1: Всегда возвращать JSON
        return response()->json($user);

//        // Вариант 2: Скрыть поля
//        return response()->json($user->makeHidden(['password', 'remember_token']));
//
//        // Вариант 3: Только нужные поля
//        return response()->json([
//            'id' => $user->id,
//            'name' => $user->name,
//            'email' => $user->email,
//            'created_at' => $user->created_at
//        ]);
//
//        // Вариант 4: С дополнительной структурой
//        return response()->json([
//            'success' => true,
//            'data' => $user,
//            'message' => 'User retrieved successfully'
//        ]);
//
//        // Вариант 5: С кодом статуса
//        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'phone' => 'nullable|string|max:20',
            'telegram' => 'nullable|string|max:255',
            'username' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
        ]);

        // Если передан пароль, обновляем его
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6']);
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'Пользователь обновлен успешно.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Пользователь удален успешно.');
    }
}
