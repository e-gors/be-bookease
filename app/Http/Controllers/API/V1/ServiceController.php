<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ParentCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ServiceResource;
use App\Http\Resources\V1\ParentCategoryResource;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $includeChilds = $request->query('includeChilds');

        $query = ParentCategory::query();

        if (!is_null($search)) {
            $query->where('name', "LIKE", "%$search%");
        }

        if ($includeChilds) {
            // Eager load the parent category relationship
            $query->with('child');
        }
        
        return ParentCategoryResource::collection($this->paginated($query, $request));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $parent = ParentCategory::create($request->all());

        return new ParentCategoryResource($parent);
    }
    public function show(Service $service)
    {
        return new ServiceResource($service);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $service = Service::findOrFail($id);

        $service->update($request->all());

        return new ServiceResource($service);
    }
    public function delete(Request $request)
    {
        $service = Service::findOrFail($request->id);
        $service->delete();
        return response()->json(['message' => 'Service deleted successfully']);
    }
}
