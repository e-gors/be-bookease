<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email already used! Please use another one.'
            ]);
        } else {
            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'user_name' => 'required|string|unique:users,user_name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'role' => ['required', Rule::in(['Admin', 'Customer', 'Service Provider'])],
            ]);
    
            $newUser = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully!',
                'user' => $newUser,
            ]);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
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

    public function destory($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('auth_token')->accessToken;
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successfully!',
                    'user' => $user,
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password is incorrect!'
                ]);
            }
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Your provided email is not in our list!'
            ]);
        }
    }
}
