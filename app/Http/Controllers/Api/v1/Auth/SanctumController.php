<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SanctumController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
    }
}
