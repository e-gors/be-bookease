<?php

namespace App\Http\Controllers\API\V1;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'status' => 200,
            'users' => $users
        ]);
    }

    public function login(Request $request)
    {
        try {
            if (auth()->attempt($request->only(['email', 'password']))) {
                $user = auth()->user();

                $token = $user->createToken(env('APP_URL'));

                return response()->json([
                    'code' => 200,
                    'access_token' => $token->accessToken,
                    'expires_in' => $token->token->expires_at->diffInSeconds(Carbon::now()),
                    'user' => new UserResource($user)
                ]);
            } else {
                abort(422, 'Invalid Credentials');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function store(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return response()->json([
                'status' => 400,
                'message' => 'Email already used! Please use another one.'
            ]);
        } else {
            $newUser = User::create([
                'first_name' => $request->given_name ? $request->given_name : null,
                'last_name' => $request->family_name ? $request->family_name : null,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $newUser->createToken(env('APP_URL'));

            return response()->json([
                'status' => 201,
                'message' => 'User created successfully!',
                'user' => $newUser,
                'token' => $token->accessToken
            ]);
        }
    }

    public function show(Request $request)
    {

        $id = $request->query('id');
        $user = User::findOrFail($id);

        if ($user) {
            return response()->json([
                'status' => 'success',
                'message' => 'User found!',
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found!',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully!',
            'user' => $user,
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->query('id');
        $user = User::findOrFail($id);

        if ($user) {
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully!',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found!',
            ]);
        }
    }
}
