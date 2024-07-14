<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\ParentCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ParentCategoryResource;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $query = ParentCategory::query();

        if (!is_null($search)) {
            $query->where('name', "LIKE", "%$search%");
        }

        // Eager load the parent category relationship
        $query->with('child');

        return ParentCategoryResource::collection($this->paginated($query, $request));
    }
}
