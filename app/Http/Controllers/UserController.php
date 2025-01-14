<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Hobby;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //index
    public function index(): View
    {
        $users = User::with('hobbies')->paginate(5);
        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function store(StoreUserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt("password"),
            ]);
            $user->hobbies()->createMany($request->hobbies);
        });

        return redirect()->route('users.index');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        DB::transaction(function () use ($request, $user) {
            $user->update([
                'name' => $request->name,
            ]);
            $user->hobbies()->delete();
            $user->hobbies()->createMany($request->hobbies);
        });

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
