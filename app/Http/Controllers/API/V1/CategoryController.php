<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ParentCategoryResource;
use App\Models\ParentCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $includeChildren = $request->query('includeChildren');

        $query = ParentCategory::query();

        if (!is_null($search)) {
            $query->where('name', "LIKE", "%$search%");
        }

        if ($includeChildren) {
            // Eager load the parent category relationship
            $query->with('child');
        }

        return ParentCategoryResource::collection($this->paginated($query, $request)->appends($request->query()));
    }
}
