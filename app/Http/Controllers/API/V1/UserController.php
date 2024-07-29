<?php

namespace App\Http\Controllers\API\V1;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\V1\UserQuery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\V1\UserRequest;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\UserCollection;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $includeProfile = $request->query('includeProfile');
        $includeServices = $request->query('includeServices');

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
            $query->where('name', 'LIKE', "%$search%");
        }

        if ($includeProfile) {
            // Eager load the profile relationship
            $query->with('profile');
        }

        if ($includeServices) {
            $query->where('role', '=', 'Service Provider');
            // Eager load the services relationship
            $query->with('services');
        }

        // Paginate the results and append query params to pagination links
        $paginatedResults = $this->paginated($query, $request)->appends($request->query());

        // Return the results as a JSON response using the UserResource collection
        return new UserCollection($paginatedResults);
    }


    public function store(UserRequest $request)
    {
        $valid = $request->all();
        $valid['password'] = Hash::make($valid['password']);

        $newUser = new UserResource(User::create($valid));

        if ($newUser) {

            $token = $newUser->createToken(env('APP_URL'));

            return response()->json([
                'status' => 201,
                'message' => 'User created successfully',
                'user' => $newUser,
                'token' => $token->accessToken,
                'token_expires_in' => $token->token->expires_at->diffInSeconds(Carbon::now()),
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'User creation failed',
            ]);
        }
    }

    public function show(User $user, Request $request)
    {
        $includeProfile = $request->query('includeProfile');
        $includeServices = $request->query('includeServices');

        if ($includeServices) {
            $user->where('role', '=', 'Service Provider');
            // Eager load the services relationship
            $user->loadMissing('services');
        }
        if ($user) {
            if ($includeProfile) {
                // Eager load the profile relationship
                $user->load('profile');
            }

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

    public function update(UserRequest $request, $id)
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
