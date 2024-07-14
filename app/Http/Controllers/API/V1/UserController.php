<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\V1\UserQuery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UserCollection;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $includeProfile = $request->query('includeProfile');

        $filter = new UserQuery();
        $queryItems = $filter->transform($request);

        // Start a query builder instance
        $query = User::query();

        // Exclude Admin users
        $query->where('role', '!=', 'Admin');

        if (count($queryItems) > 0) {
            $query->where($queryItems);
        }

        // if search has value
        if ($search) {
            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
        }

        if ($includeProfile) {
            // Eager load the profile relationship
            $query->with('profile');
        }

        // Paginate the results
        $paginatedResults = $this->paginated($query, $request);

        // Append query parameters to pagination links
        $paginatedResults->appends($request->query());

        // Return the results as a JSON response using the UserResource collection
        return new UserCollection($paginatedResults);
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

    public function show(User $user)
    {
        if ($user) {
            return response()->json([
                'status' => 200,
                'user' => new UserResource($user),
                'message' => "User found!"
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "User not found!"
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
