<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UsersResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Hobby;

class UserController extends Controller
{
    //get user
    public function index()
    {
        $users = User::with('hobbies')->paginate(5);

        return UsersResource::collection($users);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt("password"),
        ]);
        $user->hobbies()->createMany($request->hobbies);

        return new UsersResource($user);
    }

    public function show(User $user)
    {
        return new UsersResource($user);
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

        return new UsersResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(
            ['message' => 'User deleted successfully'],
            204
        );
    }
}
