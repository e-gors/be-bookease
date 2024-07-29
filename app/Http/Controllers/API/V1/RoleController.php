<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RoleResource;
use App\Http\Resources\V1\RoleCollection;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $except = $request->query('role');
        $query = Role::query();

        if ($except) {
            $query->where('name', '!=', 'Admin')
                ->where('name', '!=', 'Super Admin');
        }

        return new RoleCollection($query->get());
    }

    public function store(Request $request)
    {
        return new RoleResource(Role::create($request->all()));
    }
}
