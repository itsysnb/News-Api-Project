<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SanctumController extends ApiController
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        return $this->successResponse(UserResource::make($user), Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $checkpwd = checkPassword($request->password, $user->password);
        $token = $user->createToken('ysncode')->plainTextToken;
        return $this->successResponse([
            "user" => UserResource::make($user),
            "token" => $token,
        ]);
    }

    public function logout(LoginRequest $request)
    {
        $request->user()->tokens()->delete();
        return $this->successResponse('You are logout.');
    }
}
